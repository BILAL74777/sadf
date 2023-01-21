<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\AddTask;
use App\Mail\WeeklyReport;
use Mail;
use App\Models\Collector;
use Illuminate\Support\Str;
class sendWeeklyReport extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'weekly:mail_report';
   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Weekly report send to Manager';
   /**
    * Create a new command instance.
    *
    * @return void
    */
   public function __construct()
   {
       parent::__construct();
   }
   /**
    * Execute the console command.
    *
    * @return int
    */
    public function handle()
    {
    $collection = Collector::where('id','969ac208-9adc-4c1f-a9bf-95c290419fc3')->first();
    // process for customize email sending...
    $Email = Setting::where('type', 'weekly_report_email_section')->first();
    if($Email)
    {
        $email_record = json_decode($Email->value);

        $email_description = $email_record[0]->description;
        $company = $collection->company;
        $amount = $collection->amount;
        
        $amount_var = array('${AMOUNT}');
        $amount_array =  array($amount);
        $company_var = array('${COMPANY}');
        $company_array = array($company);
    
        $adjusted_amount = str_replace($amount_var, $amount_array, $email_description);
        $customised_email = str_replace($company_var, $company_array, $adjusted_amount);
         
    }
    
    $url = url('/');
     $token = Str::random(64);
     $link = $url . '/check-company/' . $collection->id;
    
     $dataforEmail = [
        'email_send' => $link, 
        'customised_email' => $customised_email, 
    ];

   
    $user_email = 'billhssn777@gmail.com';
    $mail_subject = 'This email has been sent from the system.';

    Mail::send('Emails.collection-email', $dataforEmail, function ($message) use ($user_email, $mail_subject) {

        $message->to($user_email)->subject($mail_subject);

    });
}
}
