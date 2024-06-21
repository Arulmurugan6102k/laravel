<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

        // Define the attributes that are mass assignable
        protected $fillable = [
            'order_no',
            'customer_name',
            'customer_email',
            'customer_mob_no',
            'customer_country_id',
            'product_type_id',
            'products_id',
            'order_amount',
            'created_date',
            'created_by',
            'modified_date',
            'modified_by',
            'is_deleted',
            'deleted_date',
            'deleted_by',
        ];

        public function setOrderNoAttribute($value)
    {
        $this->attributes['order_no'] = 'ORD_' . $this->id;
    }

        public function setProductsIdAttribute($value)
    {
        // Ensure products_id is always stored as a JSON string
        $this->attributes['products_id'] = json_encode($value);
    }

    public function getProductsIdAttribute($value)
    {
        // Check if the value is already an array, if not decode it
        return is_string($value) ? json_decode($value, true) : $value;
    }
    
        // Define the attributes that should be cast to native types
        protected $casts = [
            'order_amount' => 'float',
            'created_date' => 'datetime',
            'modified_date' => 'datetime',
            'deleted_date' => 'datetime',
        ];
}
