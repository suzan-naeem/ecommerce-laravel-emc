<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id ', 'name_ar', 'name_en', 'desc_ar', 'desc_en', 'price', 'display',
        'deliverable'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function images()
    {
        return $this->hasMany(ProductImage::class );
    }

   

  

    
   
}
