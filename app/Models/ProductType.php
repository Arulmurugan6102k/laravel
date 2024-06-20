<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $primaryKey = 'main_id';
    use HasFactory;
    protected $fillable = [
        'product_type_name',
        'product_type_code',
        'is_active',
        'created_date',
        'created_by',
        'modified_date',
        'modified_by',
        'is_deleted',
        'deleted_date',
        'deleted_by'
    ];

}
