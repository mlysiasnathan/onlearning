<?php

namespace App\Models;

use App\Models\Quiz;
use App\Models\LessonPdf;
use App\Models\LessonVideo;
use App\Models\LessonCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $primaryKey = 'les_id';

    protected $fillable = [
        'les_name',
        'les_price',
        'les_img',
        'cat_id',
        'les_content',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the lessonPdfs for the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lesson_pdfs(): HasMany
    {
        return $this->hasMany(LessonPdf::class, 'les_id', 'les_id');
    }

        /**
     * Get all of the lessonVideos for the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lesson_videos(): HasMany
    {
        return $this->hasMany(LessonVideo::class, 'les_id', 'les_id');
    }

    /**
     * Get the quiz associated with the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function quiz(): HasOne
    {
        return $this->hasOne(Quiz::class, 'les_id', 'les_id');
    }

    /**
     * Get the lessonCategory that owns the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lesson_category(): BelongsTo
    {
        return $this->belongsTo(LessonCategory::class, 'cat_id', 'cat_id');
    }
}
