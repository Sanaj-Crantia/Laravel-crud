<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'image',
        'description'
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(){
        return asset('uploads/'.$this->image);
    }
}
