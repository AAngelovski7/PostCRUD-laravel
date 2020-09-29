<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    //Table Name
    protected $table = 'posts';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User'); // post has relation with user and belongs to that user
    }
}
