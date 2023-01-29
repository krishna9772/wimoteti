<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'code',
        'image',
        'gem_type',
        'quantity',
        'weight',
        'price',
        'gold_quantity_p',
        'gold_quantity_y',
        'gold_price',
        'ad_gold_quantity_p',
        'ad_gold_quantity_y',
        'ad_gold_price',
        'total_price',
        'service_charges',
        'net_weight',
        'created_by',
        'status',
        'updated_by',
    ];

    public function getCategory(){
        return $this->belongsTo(Category::class, "type", "id");
    }
}
