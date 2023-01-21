<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class LanguageController extends Controller
{
    public function index()
    {
        return Inertia::render('Backend/Language/Index');
    }

    public function languages()
    {
        return Language::all();
    }

    public function languages_add()
    {
        $countries = Country::pluck('name', 'iso2');
        return Inertia::render('Backend/Language/Create', [
            'countries' => $countries,
        ]);
    }

    public function countries()
    {
        return Country::pluck('name', 'iso2');
    }

    public function languages_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|max:50',
        ]);

        $language = new Language;
        $language->id = Str::orderedUuid();
        $language->name = $request->name;
        $language->code = $request->code;
        $language->save();

        return back(303);
    }

    public function languages_edit($id)
    {
        return Inertia::render('Backend/Language/Update', [
            'language_id' => $id,
        ]);
    }

    public function frontend_languages_data() {
        return Language::all();
    }


    public function languages_show($id)
    {
        return Language::findOrFail($id);
    }

    public function languages_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|max:50',
        ]);

        $language = Language::findOrFail($request->id);
        $language->name = $request->name;
        $language->code = $request->code;
        $language->save();

        return back(303);
    }

    public function languages_delete($id)
    {
        $language = Language::findOrFail($id);
        // deleting the translations of this language
        Translation::where('lang', $language->code)->delete();

        $language->delete();
        return back(303);
    }

    public function languages_data()
    { 
        dd("tetsintg");
        return Language::pluck('name', 'code');
    }
    

    public function make_frontend_default_language(Request $request)
    {  
        $request->validate([
            'default_language' => 'required|string|max:255',
        ]);

        $language = Language::where('code', $request->default_language)->firstOrFail();
      
        if ($language) {
            session(['default_language' => $language->code]);
        }

        return 'success';
    }

    

    public function translations_show($id)
    {

        // update missing language keys here from main language
        $language = Language::findOrFail($id);
        $main_lang = 'US';
        $main_lang_translations = Translation::where('lang', $main_lang)->get();

        foreach ($main_lang_translations as $main_lang_translation) {
            $translation = Translation::where('lang_key', $main_lang_translation->lang_key)->where('lang', $language->code)->first();

            if ($translation == null) {
                $translation = new Translation;
                $translation->id = Str::orderedUuid();
                $translation->lang = $language->code;
                $translation->lang_key = $main_lang_translation->lang_key;
                $translation->lang_value = $main_lang_translation->lang_key;
                $translation->save();
            }
        }

        return Inertia::render('Backend/Language/Translations', [
            'language_id' => $id,
        ]);
    }

    public function translations(Request $request)
    {
        $language = Language::where('id', $request->language_id)->first();

        $translations = Translation::where('lang', $language->code)->paginate(50);
        return $translations;
    }

    public function translations_store(Request $request)
    {
        $language = Language::findOrFail($request->language_id);

        foreach ($request->values as $key => $value) {
            $translation_def = Translation::where('lang_key', $key)->where('lang', $language->code)->first();
            if ($translation_def == null) {
                $translation_def = new Translation;
                $translation_def->id = Str::orderedUuid();
                $translation_def->lang = $language->code;
                $translation_def->lang_key = $key;
                $translation_def->lang_value = $value;
                $translation_def->save();
            } else {
                $translation_def->lang_value = $value;
                $translation_def->save();
            }
        }

        return back(303);
    }

    public function missing_translations_store(Request $request)
    {
        $setting = Setting::where('type', 'default_language')->first();
        $default_lang = 'US';
        $translation_def = Translation::where('lang', $default_lang)->where('lang_key', $request->value)->first();
        if ($translation_def == null) {

            // adding for the main language
            $translation_def = new Translation;
            $translation_def->id = Str::orderedUuid();
            $translation_def->lang = $default_lang;
            $translation_def->lang_key = $request->value;
            $translation_def->lang_value = $request->value;
            $translation_def->save();

            // adding for the current language
            $translation_def = new Translation;
            $translation_def->id = Str::orderedUuid();
            $translation_def->lang = $setting->value;
            $translation_def->lang_key = $request->value;
            $translation_def->lang_value = $request->value;
            $translation_def->save();
        }
    }

    public function translations_search(Request $request)
    {
        $language = Language::findOrFail($request->language_id);

        $translations = Translation::where('lang', $language->code)
            ->where('lang_key', 'like', '%' . $request->search . '%')->paginate(50);

        return $translations;
    }

    public function translate(Request $request)
    {
        $lang = 'br';
        $key = $request->value;

        $translation_def = Translation::where('lang', $lang)->where('lang_key', $key)->first();
        if ($translation_def == null) {
            $translation_def = new Translation;
            $translation_def->id = Str::orderedUuid();
            $translation_def->lang = $lang;
            $translation_def->lang_key = $key;
            $translation_def->lang_value = $key;
            $translation_def->save();
        }

        //Check for session lang
        $translation_locale = Translation::where('lang_key', $key)->where('lang', $lang)->first();
        if ($translation_locale != null) {
            return $translation_locale->lang_value;
        } else {
            return $translation_def->lang_value;
        }
    }

    public function make_default_language(Request $request)
    {
        $request->validate([
            'default_language' => 'required|string|max:255',
        ]);

        $setting = Setting::where('type', 'default_language')->first();

        if (!$setting) {
            $setting = new Setting;
            $setting->id = Str::orderedUuid();
            $setting->type = 'default_language';
        }

        $setting->value = $request->default_language;
        $setting->save();

        return back(303);
    }

     

}
