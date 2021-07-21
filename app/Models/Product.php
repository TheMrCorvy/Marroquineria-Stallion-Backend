<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Image;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $guarded = [];

    protected $visible = ['title', 'id', 'description', 'price', 'stock', 'brand', 'type', 'images', 'discount'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
