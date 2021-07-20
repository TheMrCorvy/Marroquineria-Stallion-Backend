<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ShippingZone;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $table = "shipping_methods";

    protected $guarded = [];

    protected $visible = ['id', 'method', 'shipping_zones'];

    public function shipping_zones()
    {
        return $this->hasMany(ShippingZone::class);
    }
}
