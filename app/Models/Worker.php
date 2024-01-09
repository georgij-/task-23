<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function shifts(): HasMany
    {
        return $this->hasMany(Shift::class);
    }

    public function totalPay()
    {
        $shifts = $this->shifts()->get();

        $totalHours = $shifts->sum('hours');
        $totalRate = $shifts->sum('rate');

        return round((($totalRate * $totalHours) / 100), 2);
    }

    public function averagePay()
    {
        $shifts = $this->shifts()->get();

        $avgRate = $shifts->sum('rate') / $shifts->count() / 100;

        return round($avgRate, 2);
    }

    public function lastFive()
    {
        return $this->shifts()->orderBy('paid_at', 'desc')->take(5)->get();
    }
}
