<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'pos_id',
        'product_id',
        'type',
        'code',
        'image',
        'gem_type',
        'quantity',
        'weight',
        'price',
        'gold_quantity_k',
        'gold_quantity_p',
        'gold_quantity_y',
        'gold_price',
        'ad_gold_quantity_k',
        'ad_gold_quantity_p',
        'ad_gold_quantity_y',
        'ad_gold_price',
        'total_price',
        'net_weight',
        'service_charges',
        'created_by',
        'updated_by',
    ];

    public function product(){
        return $this->belongsTo(Product::class, "product_id", "id");
    }

    public function pos(){
        return $this->belongsTo(Pos::class, "pos_id", "id");
    }
}
