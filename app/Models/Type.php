<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    /**
     * Méthode pour la relation avec User.
     *
     */
    public function User()
    {
        return $this->hasMany('App\Models\User');
    }
}
