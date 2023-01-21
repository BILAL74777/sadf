<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CalenderEventController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StepsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ScheduledEmailsController;
use Models\User; 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 

Route::post('/login', [HomeController::class, 'login_user'])->name('api.login');
Route::post('/missing/translations/store', [LanguageController::class, 'missing_translations_store'])->name('api.missing-translations.store');
Route::post('/forgot-password', [HomeController::class, 'forgot_password'])->name('api.forgot-password');
Route::post('/reset-password', [HomeController::class, 'reset_password'])->name('api.reset-password');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [HomeController::class, 'logout_user'])->name('api.logout');
    
        // Emali testing
        // customized emails routes starts
        Route::post('/welcome/email/store', [SettingController::class, 'welcome_email_store'])->name('api.welcome.email.store');
        Route::get('/welcome/email/fetch', [SettingController::class, 'welcome_email_fetch'])->name('api.welcome.email.fetch');

        Route::get('/reset/email/fetch', [SettingController::class, 'Reset_password_email_fetch'])->name('api.reset.email.fetch');
        Route::post('reset/password/email/store', [SettingController::class, 'reset_password_email_store'])->name('api.reset.password.email.store');

        Route::get('/collection/email/fetch', [SettingController::class, 'collection_email_fetch'])->name('api.collection.email.fetch');
        Route::post('collection/email/store', [SettingController::class, 'collection_email_store'])->name('api.collection.email.store');

        Route::get('/weekly-report/email/fetch', [SettingController::class, 'weekly_report_email_fetch'])->name('api.weekly-report.email.fetch');
        Route::post('weekly-report/email/store', [SettingController::class, 'weekly_report_email_store'])->name('api.weekly-report.email.store');

        Route::get('/countries/pluck', [CompanyController::class, 'countries_pluck'])->name('api.countries.pluck');
        Route::get('/states/pluck/{country_id}', [CompanyController::class, 'states_pluck'])->name('api.states.pluck');
        Route::get('/cities/pluck/{state_id}', [CompanyController::class, 'cities_pluck'])->name('api.cities.pluck');
        Route::get('/companies/pluck/', [CompanyController::class, 'companies_pluck'])->name('api.companies.pluck');
        // customized emails routes ends

        // languages
        Route::get('/languages', [LanguageController::class, 'languages'])->name('api.languages');
        Route::post('/languages/store', [LanguageController::class, 'languages_store'])->name('api.languages.store');
        Route::get('/languages/show/{id}', [LanguageController::class, 'languages_show'])->name('api.languages.show');
        Route::post('/languages/update', [LanguageController::class, 'languages_update'])->name('api.languages.update');
        Route::delete('/languages/delete/{id}', [LanguageController::class, 'languages_delete'])->name('api.languages.delete');
        Route::post('/translations/show', [LanguageController::class, 'translations'])->name('api.translations.show');
        Route::post('/translations/store', [LanguageController::class, 'translations_store'])->name('api.translations.store');
        Route::post('/translations/search', [LanguageController::class, 'translations_search'])->name('api.translations.search');
        // changing default language
        Route::post('/make/default/language', [LanguageController::class, 'make_default_language'])->name('api.make.default.language');
        Route::get('/languages/data', [LanguageController::class, 'languages_data'])->name('api.languages.data');
        // load countries
        Route::get('/countries', [LanguageController::class, 'countries'])->name('api.countries');


         
        // Company Apis
        Route::get('/fetch/company', [CompanyController::class, 'companies'])->name('api.fetch.company');
        Route::post('/company/store', [CompanyController::class, 'store'])->name('api.company.store');
        Route::delete('/company/delete/{id}', [CompanyController::class, 'delete'])->name('api.company.delete');
        Route::get('/company/show/{id}', [CompanyController::class, 'show'])->name('api.company.show');
        Route::post('/company/update', [CompanyController::class, 'update'])->name('api.company.update');
        
        
        // Quiz Apis
        // Route::get('/fetch/company', [CompanyController::class, 'companies'])->name('api.fetch.company');
        Route::post('/quiz/store', [QuizController::class, 'store'])->name('api.quiz.store');
        // Route::delete('/company/delete/{id}', [CompanyController::class, 'delete'])->name('api.company.delete');
        // Route::get('/company/show/{id}', [CompanyController::class, 'show'])->name('api.company.show');
        // Route::post('/company/update', [CompanyController::class, 'update'])->name('api.company.update');


        
        // Contact Apis
        Route::get('/fetch/contact', [ContactController::class, 'contacts'])->name('api.fetch.contact');
        Route::post('/contact/store', [ContactController::class, 'store'])->name('api.contact.store');
        Route::delete('/contact/delete/{id}', [ContactController::class, 'delete'])->name('api.contact.delete');
        Route::get('/contact/show/{id}', [ContactController::class, 'show'])->name('api.contact.show');
        Route::post('/contact/update', [ContactController::class, 'update'])->name('api.contact.update');

        // Lesson Apis
        Route::get('/fetch/lesson', [LessonController::class, 'lessons'])->name('api.fetch.lesson');
        Route::post('/lesson/store', [LessonController::class, 'store'])->name('api.lesson.store');
        Route::delete('/lesson/delete/{id}', [LessonController::class, 'delete'])->name('api.lesson.delete');
        Route::get('/lesson/show/{id}', [LessonController::class, 'show'])->name('api.lesson.show');
        Route::post('/lesson/update', [LessonController::class, 'update'])->name('api.lesson.update');
        // Route::get('/fetch/lesson/update/{lesson_id}', [LessonController::class, 'fetch_details'])->name('api.fetch.lesson.details');
        // LESSON STEPS ROUTES
        Route::post('/step/store', [StepsController::class, 'store'])->name('api.step.store');
        // Route::get('/fetch/lesson/step/{lesson_id}', [StepsController::class, 'lesson_steps_fetch'])->name('api.fetch.lesson.step');

        //  STEPS Questions ROUTES
        Route::post('/step/question', [StepsController::class, 'step_questions_store'])->name('api.step.question.store');

        // Customer  Apis
        Route::get('/fetch/customer', [CustomerController::class, 'customers'])->name('api.fetch.customer');
        Route::post('/customer/store', [CustomerController::class, 'store'])->name('api.customer.store');
        Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete'])->name('api.customer.delete');
        Route::get('/customer/show/{id}', [CustomerController::class, 'show'])->name('api.customer.show');
        Route::post('/customer/update', [CustomerController::class, 'update'])->name('api.customer.update');
        
        // address Apis
        Route::get('/fetch/address', [AddressController::class, 'addresses'])->name('api.fetch.address');
        Route::post('/address/store', [AddressController::class, 'store'])->name('api.address.store');
        Route::delete('/address/delete/{id}', [AddressController::class, 'delete'])->name('api.address.delete');
        Route::get('/address/show/{id}', [AddressController::class, 'show'])->name('api.address.show');
        Route::post('/address/update', [AddressController::class, 'update'])->name('api.address.update');
         
        // task Apis
        Route::get('/fetch/task', [TaskController::class, 'tasks'])->name('api.fetch.task');
        Route::post('/task/store', [TaskController::class, 'store'])->name('api.task.store');
        Route::delete('/task/delete/{id}', [TaskController::class, 'delete'])->name('api.task.delete');
        Route::get('/task/show/{id}', [TaskController::class, 'show'])->name('api.task.show');
        Route::post('/task/update', [TaskController::class, 'update'])->name('api.task.update');

        // unit Apis
        Route::get('/fetch/unit', [UnitController::class, 'units'])->name('api.fetch.unit');
        Route::post('/unit/store', [UnitController::class, 'store'])->name('api.unit.store');
        Route::delete('/unit/delete/{id}', [UnitController::class, 'delete'])->name('api.unit.delete');
        Route::get('/unit/show/{id}', [UnitController::class, 'show'])->name('api.unit.show');
        Route::post('/unit/update', [UnitController::class, 'update'])->name('api.unit.update');

        // Events Apis
       
        // Route::post('/event/store', [CalenderEventController::class, 'event_process'])->name('api.event.store');
        // Route::post('/event/remove', [CalenderEventController::class, 'remove'])->name('api.event.remove');
        // Route::post('/event/update', [CalenderEventController::class, 'update'])->name('api.event.update');
        // Route::delete('/event/delete/{id}', [CalenderEventController::class, 'delete'])->name('api.event.delete');
        // // Route::get('/unit/show/{id}', [UnitController::class, 'show'])->name('api.unit.show');
        // Route::post('/event/update', [CalenderEventController::class, 'update'])->name('api.event.update');
        // Events Apis
        Route::post('/events/index/search/fetch', [EventController::class, 'events_fetch'])->name('api.index.events.fetch');
        Route::post('/events/store', [EventController::class, 'calendar_events_store'])->name('api.events.store');
        Route::delete('/events/delete/{id}', [EventController::class, 'events_delete'])->name('api.events.delete');
        Route::delete('/events/image/delete/{id}', [EventController::class, 'events_image_delete'])->name('api.events.image.delete');
        Route::delete('/events/catalog/delete/{id}', [EventController::class, 'events_catalog_delete'])->name('api.events.catalog.delete');
        Route::get('/events/show/{id}', [EventController::class, 'events_show'])->name('api.events.show');
        Route::post('/events/update', [EventController::class, 'events_update'])->name('api.events.update');
        Route::post('/events/search', [EventController::class, 'events_search'])->name('api.event.search');

        Route::post('/events/download', [EventController::class, 'events_download'])->name('api.events.download');

        Route::post('/status/changer', [EventController::class, 'status_changer'])->name('api.events.status.change');


        Route::get('/calendar/events/fetch', [EventController::class, 'calendar_events_fetch'])->name('api.calendar.events.fetch');
        Route::post('/calendar/events/store', [EventController::class, 'calendar_events_store'])->name('api.calendar.event.store');
        Route::post('/calendar/events/update', [EventController::class, 'calendar_events_update'])->name('api.calnedar.events.update');
        Route::get('/event/details/fetch/{id}', [EventController::class, 'event_details_fetch'])->name('api.event-details-fetch');

        // User Apis
        Route::get('/fetch/user', [UserController::class, 'users'])->name('api.fetch.user');
        Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('api.user.delete');
        Route::get('/user/show/{id}', [UserController::class, 'show'])->name('api.user.show');
        Route::post('/user/update', [UserController::class, 'update'])->name('api.user.update');

        // User Profile Apis
        Route::get('/profile/show/{id}', [UserController::class, 'profile_show'])->name('api.profile.show');
        Route::post('/profile/update', [UserController::class, 'profile_update'])->name('api.profile.update');
         
         // Collector Apis
         Route::get('/fetch/collector', [CollectorController::class, 'collectors'])->name('api.fetch.collector');
         Route::post('/collector/store', [CollectorController::class, 'store'])->name('api.collector.store');
         Route::delete('/collector/delete/{id}', [CollectorController::class, 'delete'])->name('api.collector.delete');
         Route::get('/collector/show/{id}', [CollectorController::class, 'show'])->name('api.collector.show');
         Route::post('/collector/update', [CollectorController::class, 'update'])->name('api.collector.update');
         
         // Training Apis
         Route::get('/fetch/training', [TrainingController::class, 'trainings'])->name('api.fetch.training');
         Route::post('/training/store', [TrainingController::class, 'store'])->name('api.training.store');
         Route::delete('/training/delete/{id}', [TrainingController::class, 'delete'])->name('api.training.delete');
         Route::get('/training/show/{id}', [TrainingController::class, 'show'])->name('api.training.show');
         Route::post('/training/update', [TrainingController::class, 'update'])->name('api.training.update');
         
         Route::get('/api.trainings_for_certificates_details_fetch/{id}', [TrainingController::class, 'trainings_for_certificates_details_fetch'])->name('api.trainings_for_certificates_details_fetch');
         Route::get('/api/downloadPdf', [TrainingController::class, 'pdfTrainings'])->name('api.downloadPdf');
         
         
         Route::post('/emails/send/to/subscribers', [ScheduledEmailsController::class, 'email_send'])->name('api.emails.send.to.subscribers');
         
         //  s cheduled emails ...
         Route::get('/fetch/scheduled/emails', [ScheduledEmailsController::class, 'fetch_schedulred_emails'])->name('api.fetch.scheduled.emails');
         
         Route::delete('/scheduled/emails/delete/{id}', [ScheduledEmailsController::class, 'delete'])->name('api.scheduled.emails.delete');
         
         Route::get('/scheduled/emails/show/{id}', [ScheduledEmailsController::class, 'show'])->name('api.scheduled.emails.show');
         
         Route::post('/scheduled/emails/update', [ScheduledEmailsController::class, 'update'])->name('api.scheduled.emails.update');
        

});

 

 
 
   
 
Route::get('/front_end/languages/data', [LanguageController::class, 'frontend_languages_data'])->name('api.front_end.languages.data');

// Below routes are for Website/front 
Route::post('/contacts/store', [ContactController::class, 'contact_store'])->name('api.contacts.store');
Route::get('/services', [HomeController::class, 'services'])->name('api.services');
Route::get('/team', [HomeController::class, 'team'])->name('api.team');
Route::get('/faqs', [HomeController::class, 'faq'])->name('api.faqs');
Route::get('/clients', [HomeController::class, 'client'])->name('api.clients');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('api.portfolio');
Route::get('/portfolios/fetch/{id}', [HomeController::class, 'portfolio_fetch'])->name('api.portfolios.fetch');
Route::get('/portfolioMobileApp', [HomeController::class, 'portfolioMobileApp'])->name('api.portfolioMobileApp');
Route::get('/portfolioWebApp', [HomeController::class, 'portfolioWebApp'])->name('api.portfolioWebApp');
Route::get('/hero/frontpage', [SettingController::class, 'hero_fetch'])->name('api.fetch.hero');
Route::get('/front-end/fetch/carousel', [SettingController::class, 'carousel_fetch'])->name('api.fetch.carousel');
  
Route::get('/active/events/fetch', [EventController::class, 'active_events_fetch'])->name('api.active-events.fetch');

Route::post('/role/registration', [EventController::class, 'role_registration'])->name('api.role.registeration');



// front end changing default language
Route::post('/user/default/language', [LanguageController::class, 'make_frontend_default_language'])->name('api.user.default.language');

// below routes is for userRegisteration from the website front end

Route::post('/user.register',[HomeController::class, 'user_register'])->name('api.user.register');
Route::post('/normal-users-registery-talents', [UserController::class, 'normal_users_registery_talents_store'])->name('api.normal-users-registery-talents');
Route::post('/director/project-batches', [ShowRoomController::class,'project_batches'])->name('api.director.project-batches');

// adding here for auth problems
Route::get('/fetch/events', [CalenderEventController::class, 'events'])->name('api.fetch.events');

// sending email from quiz form
Route::post('/quiz/apply', [QuizController::class, 'apply'])->name('api.quiz.apply');
 //  quiz stepper
 Route::get('/get/quiz', [LessonController::class, 'lessons'])->name('api.get.quiz');
 Route::get('/fetch/lesson/step/{lesson_id}', [StepsController::class, 'lesson_steps_fetch'])->name('api.fetch.lesson.step');
 Route::get('/fetch/lesson/update/{lesson_id}', [LessonController::class, 'fetch_details'])->name('api.fetch.lesson.details');
