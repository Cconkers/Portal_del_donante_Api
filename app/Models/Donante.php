<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donante extends Model
{
    use HasFactory;
    protected $fillable = [
        'NombreColaborador', 
        'ApellidosColaborador',
        'NIFtitular', 
        'email', 
        'password',
        'confirm_password',
        'localidad',
        'Cdigo_Postal',
        'Cuota',
        'Mvil',
        'telefono2',
        'EMail',
    ];
}
