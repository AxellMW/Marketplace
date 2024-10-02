<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['merchant_id', 'name', 'description', 'price', 'photo'];

    public function merchant(){
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getPhotoUrlAttribute()
    {
        return asset('storage/' . $this->photo);
    }
}
