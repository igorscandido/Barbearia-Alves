<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'link', 'gerado_em', 'procedure_id'];

    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }
}
