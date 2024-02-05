<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_img', 'name', 'slug', 'parent_id','menu_cate'];

    /*======== generate slug ===========*/
    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = $value;
    //     $this->attributes['slug'] = str_slug($value);
    // }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status',1);
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id')->select('id', 'name');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'name');
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
