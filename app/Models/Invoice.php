<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'invoice_number', 'amount'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->hasOneThrough(User::class, Order::class, 'id', 'id', 'order_id', 'customer_id');
    }

    public function merchant()
    {
        return $this->hasOneThrough(User::class, Menu::class, 'id', 'id', 'menu_id', 'merchant_id');
    }
}
