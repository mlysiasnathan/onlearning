<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $primaryKey = 'quiz_id';

    protected $fillable = [
        'question',
        'correct_ans',
        'ans_1',
        'ans_2',
        'ans_3',
        'ans_4',
    ];

}
