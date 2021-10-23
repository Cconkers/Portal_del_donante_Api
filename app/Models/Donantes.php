<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donantes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'lastName',
        'direccion',
        'selectorPais',
        'provincia',
        'poblacion',
        'cp',
        'cuotaManual',
        'cuota',
        'tipoCuota',
        'phoneNumber',
        'phoneNumber2',
        'nameBank',
        'iban',
    ];
}