<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Memorize extends Model
{
    protected $fillable = ['student_id', 'hizb', 'fraction', 'review'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
