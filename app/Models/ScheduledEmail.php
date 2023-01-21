<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledEmail extends Model
{
    use HasFactory;
    public $incrementing=false;
    protected $table = 'scheduled_emails';
}
