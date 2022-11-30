<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
