<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonVideo extends Model
{
    use HasFactory;

    protected $primaryKey = 'vid_id';

    protected $fillable = [
        'vid_file',
        'vid_name',
        'les_id'
    ];
}
