<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [''];

    /*======== generate slug ===========*/
    // public function setNameAttribute($value)
    // {
    //     $this->attributes['title'] = $value;
    //     $this->attributes['slug'] = str_slug($value);
    // }

}
