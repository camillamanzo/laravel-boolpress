<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'date', 'content', 'category_id', 'user_id'];

    public function getFormattedDate($column, $format = 'd-m-Y H:i:s' )
    {
        return Carbon::create($this->$column)->format($format);
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }
}
