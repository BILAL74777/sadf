<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsEmailScheduled extends Model
{
    use HasFactory;
    public $incrementing=false;
    protected $table = 'events_email_scheduled';
}
