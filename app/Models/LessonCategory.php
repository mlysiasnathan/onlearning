<?php

namespace App\Models;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LessonCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'cat_id';

    protected $fillable = [
        'cat_name',
        'cat_img',
        'cat_description',
        'created_at',
        'updated_at',
    ];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'cat_id', 'cat_id');
    }

}
