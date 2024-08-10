<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Category;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'description',
        'image',
        'price',
        'additional_info',
        'category_id',
        'subcategory_id'
    ];
    public function category()
    {
    	return $this->hasOne(Category::class,'id','category_id');
    }
}
