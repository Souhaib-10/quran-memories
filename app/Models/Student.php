<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = ['id', 'name', 'date', 'completions', 'starting_surah'];
    public function memorizes(): HasMany
    {
        return $this->hasMany(Memorize::class);
    }
}
