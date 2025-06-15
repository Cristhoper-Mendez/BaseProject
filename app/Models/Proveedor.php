<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

   
    protected $table = 'Proveedor'; 

    public $timestamps = false;

    // Campos que se pueden llenar con create()
    protected $fillable = ['nombre', 'empresa', 'contacto', 'rol'];
}
