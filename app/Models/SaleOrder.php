<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Sale;

class SaleOrder extends Model
{
    use HasFactory;

    protected $table = "sale_orders";

    protected $guarded = [];

    protected $visible = [
        'id',
        'date',
        'payment_method',
        'total_price',
        'billing_info',
        'shipping_info',
        'sales'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
