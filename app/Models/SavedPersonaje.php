<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedPersonaje extends Model
{
    use HasFactory;

    protected $fillable = ['personaje_id', 'user_id'];
}
