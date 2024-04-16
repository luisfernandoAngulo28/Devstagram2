<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //un post le pertenece a un usuario
    //relacion de uno a uno
    public function user()
    {
        // este trae todo los capos de la tabla post
        //--return $this->belongsTo(User::class);
        //este especifica
        return $this->belongsTo(User::class)->select(['name','username']);
        /* name: "Barry Allen",
        username: "barry",
        
        */
    }
    // relacion de uno a muchos
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
    
    public function likes() 
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user) 
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
