<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcedureType extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'valor', 'barber_id'];

    public function barber()
    {
        return $this->belongsTo(User::class, 'barber_id');
    }
}
