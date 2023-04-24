<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ReportController extends Controller
{
    public function index(Request $request){

        $product_in = Product::select('id','code','price','total_price')
        ->where("status",1)->paginate(3);
        $product_out = Product::select('id','code','price','total_price')
        ->where("status",1)->where("product_in",0)->paginate(3);
        
        return view('dashboard.report.index',compact("product_in","product_out"));
    }

    public function filter(Request $request){


        $product_in = Product::select('id','code','price')
        ->where("status",1)
        ->whereBetween('created_at',[$request->from_date, $request->to_date])
        ->paginate(3);

        $product_out = Product::select('id','code','price')
        ->where("status",1)->where("product_in",0)
        ->whereBetween('created_at',[$request->from_date, $request->to_date])
        ->paginate(3);
         
        return view('dashboard.report.index',compact("product_in","product_out"));
    }
}
