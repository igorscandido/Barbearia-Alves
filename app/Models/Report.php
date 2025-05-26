<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_da',
        'semana',
        'nome',
        'total_procedimentos',
        'total_procedimentos_pagos',
        'proceds_n_pagos',
        'valor_total_pago',
        'valor_medio_pago'
    ];
}
