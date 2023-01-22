<?php

use App\Models\GoldPrice;
use App\Models\Pos;


use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Crypt;

   

    if(!function_exists('gold_price')){
        function gold_price(){
            $price = GoldPrice::where('status',1)->first();
            if($price){
                $goldPrice = $price->price;
            }else{
                $goldPrice = "";
            }
            return $goldPrice;
        }
    }

    if(!function_exists('pos_count')){
        function pos_count(){
            $pos = Pos::all();
            $posCount = count($pos);
           
            return $posCount;
        }
    }


   


