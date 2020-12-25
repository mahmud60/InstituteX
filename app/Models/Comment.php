<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function getUsername()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function hasCommentFromUser($commentid, $userid)
    {
        return $this->where(['user_id' => $userid,'id' => $commentid])->count() > 0;
    }
}
