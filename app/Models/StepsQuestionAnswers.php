<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepsQuestionAnswers extends Model
{
    use HasFactory;
    public $incrementing=false;
    protected $table = 'step_questions_and_answers';
}
