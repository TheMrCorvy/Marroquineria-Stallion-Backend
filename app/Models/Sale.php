<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SaleOrder;

class Sale extends Model
{
    use HasFactory;

    protected $table = "sales";

    protected $guarded = [];

    protected $visible = ['id', 'sale_order_id', 'title', 'product_id', 'unit_price', 'amount', 'sale_order'];

    public function sale_order()
    {
        return $this->belongsTo(SaleOrder::class);
    }
}
