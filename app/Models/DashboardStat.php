<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'previous_period_percentage',
        'icon',
        'color',
        'progress_bar_color',
    ];
}
