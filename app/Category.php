<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable; //Ссылки вместо id, выглядит более понятнее

    protected $fillable = ['title'];

    public function posts() {
        return $this->hasMany(Post::class); //одна категория может иметь много постов
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
