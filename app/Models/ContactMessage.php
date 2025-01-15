<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'contact_messages';  // Nombre de la tabla

    protected $fillable = [
        'name',
        'email',
        'message',
        'created_at',
    ];

    /**
     * Obtener todos los mensajes de contacto.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllMessages()
    {
        return self::all();
    }

    /**
     * Obtener un mensaje de contacto por su ID.
     *
     * @param int $id
     * @return \App\Models\ContactMessage|null
     */
    public static function getMessageById($id)
    {
        return self::find($id);
    }

    /**
     * Crear un nuevo mensaje de contacto.
     *
     * @param array $data
     * @return \App\Models\ContactMessage
     */
    public static function createMessage(array $data)
    {
        return self::create($data);
    }

    /**
     * Filtrar mensajes de contacto por nombre.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getMessagesByName($name)
    {
        return self::where('name', 'LIKE', '%' . $name . '%')->get();
    }

    /**
     * Filtrar mensajes de contacto por correo electrónico.
     *
     * @param string $email
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getMessagesByEmail($email)
    {
        return self::where('email', 'LIKE', '%' . $email . '%')->get();
    }

    /**
     * Filtrar mensajes de contacto por fecha de creación.
     *
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getMessagesByDate($date)
    {
        return self::whereDate('created_at', $date)->get();
    }
}
