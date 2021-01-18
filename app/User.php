<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use \Storage;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public static function add($fields) {
        $user = new static;
        $user->fill($fields);
        $user->save();
        return $user;
    }

    public function edit($fields) {
        $this->fill($fields); //name, email

        $this->save();
    }

    public function generatePassword($password) {
        if ($password != null) {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove() {
        $this->removeAvatar();
        $this->delete();
    }

    public function uploadAvatar($image)
    {
        if ($image == null) {
            return;
        }
        $this->removeAvatar();
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->avatar = $filename;
        $this->save();
    }

    public function removeAvatar() {
        if ($this->avatar != null) {
            Storage::delete('uploads/' . $this->avatar);
        }
    }

    public function getImage() {
        $path = '/storage/app/uploads/';
        if ($this->avatar == null) {
            return $path.'no-image.png';
        }
        return $path.$this->avatar;
    }

    public function makeAdmin() {
        $this->is_admin = 1;
        $this->save();
    }

    public function makeNormal() {
        $this->is_admin = 0;
        $this->save();
    }

    public function toggleAdmin() {
        if($this->is_admin == 1) {
            return $this->makeNormal();
        }
        return $this->makeAdmin();
    }

    public function banned() {
        $this->status = 1;
        $this->save();
    }

    public static function isAdmin()
    {
        $authUser = Auth::user();
        $isAdmin = false;
        if ($authUser) {
            $id = $authUser->getAuthIdentifier();
            $user = self::find($id);
            $isAdmin = $user->is_admin == 1 ? true : false;
        }
        return $isAdmin;
    }

    public function notBanned() {
        $this->status = 0;
        $this->save();
    }

    public function toggleBan($value) {
        if($value == null) {
            return $this->notBanned();
        }
        return $this->Banned();
    }
}
