<?php
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CalenderEventController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StepsController;
use App\Http\Controllers\ScheduledEmailsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  
Route::get('/test', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home'); 
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/forgotPassword', [HomeController::class, 'forgotPassword'])->name('forgotPassword');
Route::get('/password-reset/{token?}', [HomeController::class, 'resetPasswordVue']);
Route::get('/verify-email/{token?}', [HomeController::class, 'verify_email']);
Route::get('/access-stepper/{token?}', [LessonController::class, 'access_lessons']);



Route::get('/bilal/{id}', [CollectorController::class, 'bilal'])->name('bilal');


// Route::get('/welcome-email', [SettingController::class, 'welcome_email'])->name('welcome.email');
 
 

 
Route::middleware(['auth:sanctum'])->group(function () {
  

    // email test
    Route::get('/bill', [SettingController::class, 'test_email'])->name('bill');
    Route::get('/welcome-email', [SettingController::class, 'welcome_email'])->name('welcome.email');
    Route::get('/reset/password/email', [SettingController::class, 'Reset_password_email'])->name('reset-password-email');
    Route::get('/collection/email', [SettingController::class, 'collection_email'])->name('collection-email');
    Route::get('/weekly-report/email', [SettingController::class, 'weekly_report_email'])->name('weekly-report-email');
    
    
    Route::get('/abc', function(){
        return view('TestEmail');
    })->name('abc');
    

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/admin-profile', [TalentController::class, 'profile'])->name('profile');


    // Companies Routes
    Route::get('/company', [CompanyController::class, 'index'])->name('company');
    Route::get('/company/add', [CompanyController::class, 'add'])->name('company.add');
    Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
    // Contact Routes
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/contact/add', [ContactController::class, 'add'])->name('contact.add');
    Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
    // Lesson Routes
    Route::get('/lesson', [LessonController::class, 'index'])->name('lesson');
    Route::get('/lesson/add', [LessonController::class, 'add'])->name('lesson.add');
    Route::get('/lesson/edit/{id}', [LessonController::class, 'edit'])->name('lesson.edit');
    Route::get('/lesson/details/{id}', [LessonController::class, 'details'])->name('lesson.details');
    

    // steps Routes
    Route::get('/step/add/{lesson_id}', [StepsController::class, 'index'])->name('step.add');
    Route::get('/step/question/add/{step_id}/{lesson_id}', [StepsController::class, 'step_question_add'])->name('step.question.add');
     
    // Crew Routes
    Route::get('/crew', [CrewController::class, 'index'])->name('crew');
    Route::get('/crew/add', [CrewController::class, 'add'])->name('crew.add');
    Route::get('/crew/edit/{id}', [CrewController::class, 'edit'])->name('crew.edit');
    
     // languages Routes
     Route::get('/languages', [LanguageController::class, 'index'])->name('languages');
     Route::get('/languages/add', [LanguageController::class, 'languages_add'])->name('languages.add');
     Route::get('/languages/edit/{id}', [LanguageController::class, 'languages_edit'])->name('languages.edit');
     Route::get('/translations/show/{id}', [LanguageController::class, 'translations_show'])->name('translations.show');
 

    // users Routes
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('/customer/add', [CustomerController::class, 'add'])->name('customer.add');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    
    // Address Routes
    Route::get('/address', [AddressController::class, 'index'])->name('address');
    Route::get('/address/add', [AddressController::class, 'add'])->name('address.add');
    Route::get('/address/edit/{id}', [AddressController::class, 'edit'])->name('address.edit');
    
    // Task Routes
    Route::get('/task', [TaskController::class, 'index'])->name('task');
    Route::get('/task/add', [TaskController::class, 'add'])->name('task.add');
    Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    
    // Unit Routes
    Route::get('/unit', [UnitController::class, 'index'])->name('unit');
    Route::get('/unit/add', [UnitController::class, 'add'])->name('unit.add');
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    // Users Routes
    Route::get('/user', [UserController::class, 'index'])->name('user'); 
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    // Profile Routes
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    
    // Chart Routes
    Route::get('/chart', [HomeController::class, 'chart_testing'])->name('chart'); 
    Route::get('/pie', [HomeController::class, 'pie_testing'])->name('pie'); 
    

    // Collectors Routes
    Route::get('/collector', [CollectorController::class, 'index'])->name('collector');
    Route::get('/collector/add', [CollectorController::class, 'add'])->name('collector.add');
    Route::get('/collector/edit/{id}', [CollectorController::class, 'edit'])->name('collector.edit');
    Route::get('/send-collection/email/{collection_id}', [CollectorController::class, 'collection_email_send'])->name('send-collection.email');
    Route::get('/check-company/{collection_id}', [CollectorController::class, 'check_company'])->name('check-company');

    // Collectors Routes
    Route::get('/training', [TrainingController::class, 'index'])->name('training');
    Route::get('/training/add', [TrainingController::class, 'add'])->name('training.add');
    Route::get('/training/edit/{id}', [TrainingController::class, 'edit'])->name('training.edit');
    // Route::get('/send-collection/email/{collection_id}', [TrainingController::class, 'collection_email_send'])->name('send-collection.email');
    // Route::get('/check-company/{collection_id}', [TrainingController::class, 'check_company'])->name('check-company');
    Route::get('/trainings_for_certificates', [TrainingController::class, 'trainings_for_certificates'])->name('trainings_for_certificates');
    Route::get('/trainings_for_certificates/details/{id}', [TrainingController::class, 'trainings_for_certificates_details'])->name('trainings_for_certificates.details');
    Route::get('/trainings_for_certificates/pdf/{id}', [TrainingController::class, 'createCertificatePDF'])->name('trainings_for_certificates.pdf');
    
    // Quizs Routes
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::get('/quiz/add', [QuizController::class, 'add'])->name('quiz.add');
    
    // CalenderEvent API
    Route::get('/calender', [CalenderEventController::class, 'index'])->name('calender');
    Route::get('/file-download', [CalenderEventController::class, 'pdf'])->name('file.download.index');

    // CalenderEvent API
    Route::get('/calendar', [EventController::class, 'index'])->name('calendar');
    Route::get('/file-download', [EventController::class, 'pdf'])->name('file.download.index');

        // Events Routes
        Route::get('/events', [EventController::class, 'events_index'])->name('events');
        Route::get('/events/add', [EventController::class, 'events_add'])->name('events.add');
        Route::get('/events/edit/{id}', [EventController::class, 'events_edit'])->name('events.edit');
        Route::get('/events/show/{id}', [EventController::class, 'events_show'])->name('events.show');
        Route::get('/event/details/{id}', [EventController::class, 'events_details'])->name('event.details');
    
        // external website links 
        Route::get('/external-website', [SettingController::class, 'external_website_index'])->name('external-website');


        // Seo
    Route::get('/seo', [SettingController::class, 'seo'])->name('api.seo');
    //  Route::get('/seo', [HomeController::class, 'seo'])->name('seo');
    Route::post('/seo/store', [SettingController::class, 'seo_store'])->name('api.seo.store');
    //  About
    Route::post('/hero/store', [SettingController::class, 'hero_store'])->name('api.hero.store');
    Route::get('/fetch/hero', [SettingController::class, 'hero_fetch'])->name('api.fetch.hero');
    Route::post('/website-name/store', [SettingController::class, 'website_name_store'])->name('api.website-name.store');
    Route::get('/fetch/website-name', [SettingController::class, 'website_name_fetch'])->name('api.fetch.website-name');

    // carousel 
    Route::post('/carousel/store', [SettingController::class, 'carousel_store'])->name('api.carousel.store');
    
    Route::post('/carousel/text/store', [SettingController::class, 'carousel_text_store'])->name('api.carousel.text.store');
    Route::post('/carousel/text/update', [SettingController::class, 'carousel_text_update'])->name('api.carousel.update');
    Route::get('/admin/fetch/carousel/text', [SettingController::class, 'carousel_text_fetch'])->name('api.admin.carousel.text.fetch');

    // scheduled emails 
    Route::get('/sheduled/email/index', [ScheduledEmailsController::class, 'index'])->name('sheduled.email.index');
    Route::get('/sheduled/email/edit/{id}', [ScheduledEmailsController::class, 'edit'])->name('scheduled.emails.edit');

});
 

 // From Front-end user register and login
 Route::get('register', [HomeController::class, 'user_register_form'])->name('register');
 Route::get('/users-login', [UserController::class, 'users_login_form'])->name('users-login');

   

 Route::get('/save_order/{amount}/{company}/{collection_id}/{status}/{email}/{name}/{payer_id}/{trans_id}', [CollectorController::class,'submit_order'])->name('save_order');
 Route::get('/save_order_from_email/{amount}/{company}/{collection_id}/{status}/{email}/{name}/{payer_id}/{trans_id}', [CollectorController::class,'email_side_payment_submit'])->name('save_order_from_email');
//  Route::get('/save_order/{donations}/{company}/{collection_id}', [CollectorController::class,'submit_order'])->name('save_order');

// front end lessons quizzes attempting 
Route::get('/user/lesson/details/{id}/{email?}', [LessonController::class, 'user_lesson_details'])->name('user.lesson.details');