<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'pet_type_id', 'breed', 'sex', 'dob', 'description', 'photo', 'status'
    ];

    // Definir la relación con el modelo PetType
    public function petType()
    {
        return $this->belongsTo(PetType::class);
    }
}