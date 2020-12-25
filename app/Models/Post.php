<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Post extends Model
{
    use HasFactory;

    public function getUsername()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function getComments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id');
    }


    public function hasPostFromUser($postid, $userid)
    {
        return $this->where(['user_id' => $userid,'id' => $postid])->count() > 0;
    }

    public function numberOfComments()
    {
        return $this->hasMany('App\Models\Comment','post_id');
    }
}
