<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeReturn extends Model
{
    use HasFactory;
    protected $fillable = [
        'pos_id',
        'extra_charges',
        'percentage',
        'type',
        'final_amount',
        'created_by',
        'updated_by',
    ];

    public function pos(){
        return $this->hasOne(Pos::class, "id", "pos_id");
    }
}
