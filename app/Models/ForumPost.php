<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    /*
    protected $table = 'Forum';
    protected $primaryKey = "forum_id";  forums  id
    */

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'categorys_id'
    ];

    public function forumHasUser(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function forumHasCategory(){
        return $this->hasOne('App\Models\Category', 'id', 'categorys_id');
    }

    /*public function selectUser(){
        return $this->Select(DB::raw('concat(fistname, " ", lastName) as name'))
                ->join('users', 'users.id', '=', 'user_id')
                ->get();
    }*/
}
