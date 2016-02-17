<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    /**
     * Get the user that owns the comment.
     *
     */
    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the post that owns the comment.
     *
     */
    public function user() 
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * Get the parent comment that owns the comment.
     *
     */
    public function parentComment() 
    {
        return $this->belongsTo('App\Comment');
    }

    /**
     * Get the child comment that belongs to the parent comment.
     *
     */
    public function childComment() 
    {
        return $this->belongsTo('App\Comment');
    }
}
