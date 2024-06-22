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

    // Mutator to ensure products_id is stored as a JSON string
    public function setProductsIdAttribute($value)
    {
        $this->attributes['products_id'] = json_encode($value);
    }

    // Accessor to decode the JSON string to an array
    public function getProductsIdAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) : $value;
    }

    // Define the attributes that should be cast to native types
    protected $casts = [
        'order_amount' => 'float',
        'created_date' => 'datetime',
        'modified_date' => 'datetime',
        'deleted_date' => 'datetime',
    ];

    // Override the save method to set order_no
    public function save(array $options = [])
    {
        if (empty($this->order_no)) {
            if (!$this->exists) {
                parent::save($options);
            }
            $this->order_no = '#order_no_' . $this->id;
        }

        // Save the model
        return parent::save($options);
    }
}
