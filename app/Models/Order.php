<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'menu_id', 'quantity', 'total_amount'];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
