<?php

use App\Models\GoldPrice;

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


   


