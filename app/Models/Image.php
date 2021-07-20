<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Image extends Model
{
    use HasFactory;

    protected $table = "images";

    protected $guarded = [];

    protected $visible = ['img_url'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
