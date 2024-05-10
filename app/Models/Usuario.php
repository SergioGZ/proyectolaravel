<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nick',
        'nombre',
        'apellidos',
        'email',
        'password',
        'imagen_avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


}
