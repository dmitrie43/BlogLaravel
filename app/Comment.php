<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post() {
        return $this->belongsTo(Post::class); //Комменты принадлежат к посту
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id'); //Коммент относится к автору
    }

    public function allow() {
        $this->status = 1;
        $this->save();
    }

    public function noAllow() {
        $this->status = 0;
        $this->save();
    }

    public function toggleStatus() {
        if ($this->status == 0) {
            return $this->allow();
        }
        return $this->noAllow();
    }

    public function remove() {
        $this->delete();
    }
}
