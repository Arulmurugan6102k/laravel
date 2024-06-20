<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'product_name',
        'product_cost',
        'prod_type_name',
        'release_date',
        'version_id',
        'product_image',
        'product_description',
        'available_colors',
        'created_date',
        'created_by',
        'modified_date',
        'modified_by',
        'is_deleted',
        'deleted_date',
        'deleted_by',
    ];

    // public function productType()
    // {
    //     return $this->belongsTo(ProductType::class, 'product_type_name');
    // }


}
