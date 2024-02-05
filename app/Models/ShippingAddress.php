<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shippingCharge()
    {
        return $this->belongsTo(DeliveryCharge::class, 'delivery_charge_id');
    }
}
