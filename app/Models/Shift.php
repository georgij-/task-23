<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shift extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }
}
