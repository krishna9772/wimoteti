<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;
    protected $fillable = [
        'c_id',
        'voucher_no',
        'total_price',
        'discount',
        'payment_status',
        'created_by',
        'updated_by',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, "c_id", "id");
    }

    public function positem(){
        return $this->hasMany(PosItem::class, "pos_id", "id");
    }
}
