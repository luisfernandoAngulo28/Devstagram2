<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    // esto es lo que se llenaran en la tabla el modelo
    protected $fillable=[
        'user_id',
        'follower_id'
    ];
}
