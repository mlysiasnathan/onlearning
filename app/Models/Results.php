<?php

namespace App\Models;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Results extends Model
{
    use HasFactory;

    protected $primaryKey = 'res_id';

    protected $fillable = [
        'score',
    ];

    /**
     * Get the lesson that owns the Results
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'les_id', 'les_id');
    }
}
