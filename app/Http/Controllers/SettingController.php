<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Setting;
use App\Models\Participant;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Seo; 
use App\Models\Uploads;
use DB;
use File;

class SettingController extends Controller
{
     public function index(){
        return Inertia::render('Backend/Setting/Index');
    }

    public function setting_add(){
        return Inertia::render('Backend/Setting/Create');
    }

     public function setting_edit($id){
        return Inertia::render('Backend/Setting/Update',[
            'settingId' => $id
        ]);
    }

     public function setting(Request $request){
        return Setting::all();
    }

    public function setting_store(Request $request){
         if($request['type'] == 'site'){

            $request->validate([
                'site_name' => 'required',
                'type' => 'required'
            ]);

            $array = array('site_name'=>$request->site_name);
            $value = json_encode($array); 

          if($request->id == ""){

            $Setting = new Setting;
            $Setting->id = Str::orderedUuid();

        }else{
             $Setting = Setting::findOrFail($request->id); 
        }
            $Setting->type = $request->type;
            $Setting->value = $value;
            $Setting->save();

            return back(303);

         }else if($request['type'] == 'AboutUs'){

         

             $request->validate([
                'paragraph1' => 'required',
                'paragraph2' => 'required',
                'type' => 'required',
            ]);
            
            $array = array('paragraph1'=>$request->paragraph1,'paragraph2'=>$request->paragraph2);
            $value = json_encode($array); 

            if($request->id == ""){
                $Setting = new Setting;
                $Setting->id = Str::orderedUuid();
            }else{
                $Setting = Setting::findOrFail($request->id); 
            }
             
            $Setting->type = $request->type;
            $Setting->value = $value;
            $Setting->save();
            return back(303);

         }else if($request['type'] == 'Footerlinks'){
            
             $request->validate([
                'contents' => 'required',
                'link' => 'required',
                'type' => 'required'
            ]);
                     
            $array = array('contents'=>$request->content,'link'=>$request->link);
            $value = json_encode($array);  
           
            $Setting = new Setting;
            $Setting->id = Str::orderedUuid();
            $Setting->type = $request->type;
            $Setting->value = $value;
            $Setting->save();


            return $value;
            
         }

    }


    public function setting_show($id){
        $portfolio = Setting::findOrFail($id);
        return $portfolio;
    }

    public function setting_update(Request $request){
        $request->validate([
            'name'       => 'required|string|max:255',
            'image'      => 'nullable|mimes:jpg,png',
            'category'   => 'required|string|max:255',
            'link'       => 'required|string|max:255',         
        ]);

        $Setting = Setting::findOrFail($request->id);
        $Setting->name = $request->name;

        if ($request->image) {
            // Deleting the old image
            Storage::delete($Portfolio->image);
            
            $Setting->image = $request->image->store('portfolioImages');
        }
            $Setting->category = $request->category;
            $Setting->link = $request->link;
            $Setting->save();
    
            return back(303);
    }


     public function setting_delete($id){
        $Setting = Setting::findOrFail($id);
        // Deleting the image
        Storage::delete($Setting->image);
        $Setting->delete();
        return back(303);
    }



    
    public function SiteName()
    {
      $data =  Setting::where('type','site')->first();
      return json_decode($data);

    }

    public function AboutUs()
    {
      $data =  Setting::where('type','AboutUs')->first();
      return json_decode($data);

    }

    public function Footerlinks()
    {
      $data =  Setting::where('type','Footerlinks')->get();
      return json_decode($data);

    }

    public function external_website_index()
    {
        return Inertia::render('Backend/ExternalWebsite/Create');
    }

    public function seo_store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'keywords' => 'required',
            'description' => 'required',

        ]);
        $Exist_seo = $seo_exist = DB::table('seo')->first();

        if ($Exist_seo) {

            $seo_exist = DB::table('seo')->first();
            $Seo = Seo::findOrFail($seo_exist->id);

        } else {

            $Seo = new Seo;
            $Seo->id = Str::orderedUuid();

        }

        $Seo->title = $request->title;
        $Seo->keyword = $request->keywords;
        $Seo->description = $request->description;

        if ($request->file('image')) {
            if ($Seo->image) {
                Storage::delete($Seo->image);
                Storage::disk('real_public')->delete($Seo->image);
            }
            $Seo->image = $request->file('image')->store('SeoImage');
        }
        $Seo->save();
        return 'success';
    }

    public function seo()
    {
        // $seo = Seo::all();
        $seo = DB::table('seo')->first();
        $seo->image = get_storage_url($seo->image);
        return $seo;
    }

    public function website_name_store(Request $request)
    {

        $request->validate([
            'website_name' => 'required|string|max:255',
        ]);

        if ($request->website_name) {
            $website_name = Setting::where('type', 'website_name')->first();
            if (!$website_name) {
                $website_name = new Setting;
                $website_name->id = Str::orderedUuid();
            }

            $website_name->type = 'website_name';
            $website_name->value = $request->website_name;
            $website_name->save();

        }
    }

    public function website_name_fetch()
    {
        $website_name = Setting::where('type', 'website_name')->first();
        return $website_name;
    }

    public function hero_store(Request $request)
    {

        $request->validate([
            'hero_title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($request->hero_title) {
            $hero_title_array = [];

            $hero_title_array[] = [
                'title' => $request->hero_title,
                'description' => $request->description,
            ];

            $hero = Setting::where('type', 'hero_section')->first();
            if (!$hero) {
                $hero = new Setting;
                $hero->id = Str::orderedUuid();
            }

            $hero->type = 'hero_section';
            $hero->value = json_encode($hero_title_array);
            $hero->save();

        }
    }
    public function hero_fetch()
    {
         
        $hero = Setting::where('type', 'hero_section')->first();
         
        return $hero;
    }


    

    // the below code is for Email 
    public function welcome_email()
    {
        return Inertia::render('Backend/Emails/Welcome');
    }

    public function welcome_email_store(Request $request)
    {

        if ($request->dataProperty) {
            $email_data_array = [];

            $email_data_array[] = [
                'description' => $request->dataProperty,
            ];

            $Email = Setting::where('type', 'email_section')->first();
            if (!$Email) {
                $Email = new Setting;
                $Email->id = Str::orderedUuid();
            }

            $Email->type = 'email_section';
            $Email->value = json_encode($email_data_array);
            $Email->save();

        }
    }
    public function welcome_email_fetch()
    {
        $Email = Setting::where('type', 'email_section')->first();

        return $Email;
    }
   
    public function test_email()
    {
        
        $Email = Setting::where('type', 'email_section')->first();
        $email_test = json_decode($Email->value);

        $email_test = $email_test[0]->description;
        $user = "Arqam";
 
        $healthy = array('${USER}');
        $yummy = array($user);
        
        $email_test = str_replace($healthy, $yummy, $email_test);
         

        return view('TestEmail', compact('email_test'));
    }

    // Reset password email functions

    
    public function Reset_password_email()
    {
        return Inertia::render('Backend/Emails/ResetPassword');
    }

    public function Reset_password_email_fetch()
    { 
        $Email = Setting::where('type', 'reset_password_email_section')->first();

        return $Email;
    }
    public function reset_password_email_store(Request $request)
    {

        if ($request->dataProperty) {
            $email_data_array = [];

            $email_data_array[] = [
                'description' => $request->dataProperty,
            ];

            $Email = Setting::where('type', 'reset_password_email_section')->first();
            if (!$Email) {
                $Email = new Setting;
                $Email->id = Str::orderedUuid();
            }

            $Email->type = 'reset_password_email_section';
            $Email->value = json_encode($email_data_array);
            $Email->save();

        }
    }

    // Collection email functions    
    public function collection_email()
    {
        return Inertia::render('Backend/Emails/Collection');
    }

    public function collection_email_fetch()
    { 
        $Email = Setting::where('type', 'collection_email_section')->first();

        return $Email;
    }
    public function collection_email_store(Request $request)
    {

        if ($request->dataProperty) {
            $email_data_array = [];

            $email_data_array[] = [
                'description' => $request->dataProperty,
            ];

            $Email = Setting::where('type', 'collection_email_section')->first();
            if (!$Email) {
                $Email = new Setting;
                $Email->id = Str::orderedUuid();
            }

            $Email->type = 'collection_email_section';
            $Email->value = json_encode($email_data_array);
            $Email->save();

        }
    }

    // weekly_report email functions    
    public function weekly_report_email()
    {
        $subscribers = Participant::where('event_id', '!=' ,'')->pluck('participant_name','id');
        $subscribers_ids = Participant::where('event_id', '!=' ,'')->pluck('event_id');
        $subscriber = Event::whereIn('id',$subscribers_ids)->pluck('title', 'id');
        
         
        // in the list the Mailing List id will be zero (0)
        // $subscriber->push("Mailing list");
         
        return Inertia::render('Backend/Emails/WeeklyReport', ['events_subscribers' => $subscriber]);
        
    }

    public function weekly_report_email_fetch()
    { 
        $Email = Setting::where('type', 'weekly_report_email_section')->first();

        return $Email;
    }
    public function weekly_report_email_store(Request $request)
    {

        if ($request->dataProperty) {
            $email_data_array = [];

            $email_data_array[] = [
                'description' => $request->dataProperty,
            ];

            $Email = Setting::where('type', 'weekly_report_email_section')->first();
            if (!$Email) {
                $Email = new Setting;
                $Email->id = Str::orderedUuid();
            }

            $Email->type = 'weekly_report_email_section';
            $Email->value = json_encode($email_data_array);
            $Email->save();

        }
    }


    // carousel 

    public function carousel_store(Request $request)
    {
        $existing_text = Setting::where('type', 'carousel_text')->first();

        $carousel_array = [];
        if ($existing_text) {
            $existing_carousel = json_decode($existing_text->value, true);
            foreach ($existing_carousel as $record) {
                $carousel_array[] = [
                    'image_id' => $record['image_id'],
                    'description' => $record['description'],
                ];
            }
            $existing_text->delete();
        }
        // $request->validate([
        //     'image' => 'required|image',
        // ]);
        $data = substr($request->image, strpos($request->image, ',') + 1);
        $data = base64_decode($data);

        $upload_ids = [];

        $existing_text = new Setting;
        $existing_text->id = Str::orderedUuid();

        $data = substr($request->image, strpos($request->image, ',') + 1);
        $data = base64_decode($data);

        $image_name_with_path = 'CarouselImages/' . Str::random(40) . '.png';
        Storage::disk('public')->put($image_name_with_path, $data);

        $Upload = new Uploads;
        $Upload->file_original_name = $image_name_with_path;

        $Upload->extension = 'png';
        // $Upload->file_size = $file->getSize();
        $Upload->type = 'image/png';
        $Upload->file_name = $image_name_with_path;

        $Upload->save();

        $carousel_array[] = [
            'image_id' => $Upload->id,
            'description' => "",
        ];

        $existing_text->type = 'carousel_text';
        $existing_text->value = json_encode($carousel_array);
        $existing_text->save();

        return 'success';

    }
    public function carousel_text_update(Request $request)
    {
        // dd($request);
        $existing_text = Setting::where('type', 'carousel_text')->first();

        // the data existing in database
        $existing_record = (array) json_decode($existing_text->value);
        $existing_images_ids = [];
        foreach ($existing_record as $machine1) {
            $existing_images_ids[] = $machine1->image_id;
        }

        // The requested data coming from the front side
        $requested_record = (array) json_decode($request->text_list);
        $requested_images_ids = [];
        foreach ($requested_record as $machine2) {
            $requested_images_ids[] = $machine2->image_id;
        }

        // the below line code is for to confirm the deleted record id
        $removed_image = array_diff($existing_images_ids, $requested_images_ids);

        // the below check (if) used to remove the image from the folder and from the upload db table
        if ($removed_image) {
            $Uploaded = Uploads::where('id', $removed_image)->first();
            Storage::delete($Uploaded->file_name);
            $Uploaded->delete();
        }

        // below code is used to adjust the new record and remove the existing record
        $carousel_array = [];
        if ($existing_text) {
            $exit_record = json_decode($request->text_list, true);

            foreach ($exit_record as $abc) {
                $carousel_array[] = [
                    'image_id' => $abc['image_id'],
                    'description' => $abc['description'],
                ];
            }
            $existing_text->delete();
        }

        $existing_text = new Setting;
        $existing_text->id = Str::orderedUuid();

        $existing_text->type = 'carousel_text';
        $existing_text->value = json_encode($carousel_array);
        $existing_text->save();

        return 'success';

    }
    public function carousel_text_fetch()
    {
        $carousels = Setting::where('type', 'carousel_text')->first();
        if ($carousels) {

            $carousel_decoded_record = (array) json_decode($carousels->value);
            foreach ($carousel_decoded_record as $record) {

                $uploaded_image = Uploads::where('id', $record->image_id)->first();
                

                if ($uploaded_image) {
                    
                    $record->image = get_storage_url($uploaded_image->file_name);
                }

            }
            return $carousel_decoded_record;
        }
    }

    // front end
    public function carousel_fetch()
    {
       
        $carousels = Setting::where('type', 'carousel_text')->first();
        
        
        if ($carousels != null && $carousels != '') {
 
            $carousel_decoded_record = (array) json_decode($carousels->value);
            foreach ($carousel_decoded_record as $record) {

                $uploaded_image = Uploads::where('id', $record->image_id)->first();

                if ($uploaded_image) {
                    $record->image = get_storage_url($uploaded_image->file_name);
                }

            }
            return $carousel_decoded_record;
        }
    }



}
