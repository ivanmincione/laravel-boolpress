<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable =["title", "type", "description", "content", "slug", "category_id" ]; //add category_id

    public function category() {
        return $this->belongsTo('App\Category'); // mappo la cartella secondaria
    }
}
