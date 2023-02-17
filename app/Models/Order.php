<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Relación uno a muchos - Ordenes y Usuarios - belongsTo - Tabla orders
    public function user()
    {
        return $this->belongsTo(User::class,'userId');
    }

    // Relación muchos a muchos - Ordenes y Productos - belongsToMany - Tabla intermedia order_products
    public function products()
    {
        return $this->belongsToMany(Product::class,'order_products','orderId','productId')->withPivot('quantity','price');
    }

}
