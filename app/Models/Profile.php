<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public static $Etudiant = 1;
    public static $Teacher = 2;


    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'date_de_naissance',
        'phone',
        'adresse',
        'villeId',
        'image',
        'type_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Omit the second parameter if you're following convention
    }
}
