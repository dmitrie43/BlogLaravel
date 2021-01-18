<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    public function removeImage() {
        if ($this->image != null) {
            Storage::delete('uploads/' . $this->image);
        }
        $this->delete();
    }

    public function addImage($image)
    {
        if ($image == null) {
            return;
        }
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function getImage() {
        $path = '/storage/app/uploads/';
        if ($this->image == null) {
            return $path.'no-image.png';
        }
        return $path.$this->image;
    }
}


