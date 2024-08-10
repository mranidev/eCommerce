<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Subcategory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name',
        'slug',
        'description',
        'image'
    ];

    public function subcategory(){
    	return $this->hasMany(Subcategory::class);
    }


}
