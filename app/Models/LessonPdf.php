<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonPdf extends Model
{
    use HasFactory;

    protected $primaryKey = 'pdf_id';

    protected $fillable = [
        'pdf_file',
    ];
}
