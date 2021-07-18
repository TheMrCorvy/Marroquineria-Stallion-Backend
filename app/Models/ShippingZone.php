<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ShippingMethod;

class ShippingZone extends Model
{
    use HasFactory;

    protected $table = "shipping_zones";

    protected $guarded = [];

    public function shipping_methods()
    {
        return $this->belongsTo(ShippingMethod::class);
    }
}
