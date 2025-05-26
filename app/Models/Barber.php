<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function procedures()
    {
        return $this->hasMany(Procedure::class);
    }
}
