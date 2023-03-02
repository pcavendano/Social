<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'adresse', 'phone', 'villeId', 'date_de_naisance',
        'email'
    ];

    public function blogHasUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function blogHasCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'categorys_id');
    }


}
