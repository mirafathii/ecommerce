<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',       // Allow mass assignment of user_id
        'product_id',    // Allow mass assignment of product_id
        'quantity'       // Allow mass assignment of quantity
    ];

    // Relationships (if necessary)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
