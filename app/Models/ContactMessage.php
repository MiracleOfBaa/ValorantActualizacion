<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    // Si la tabla en la base de datos no sigue el plural, define el nombre de la tabla
    protected $table = 'contact_messages';

    // Definir los campos que son asignables en masa (fillable)
    protected $fillable = ['name', 'email', 'message'];
}
