<?php

namespace App\Models;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LessonCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'cat_id';

    protected $fillable = [
        'cat_name',
        'cat_img',
        'cat_description',
    ];

}
