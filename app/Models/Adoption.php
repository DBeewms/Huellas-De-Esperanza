<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'pet_id', 'status'
    ];

    // Definir la relación con el modelo Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    // Definir la relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}