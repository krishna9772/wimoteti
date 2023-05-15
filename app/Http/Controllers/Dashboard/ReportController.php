<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ReportController extends Controller
{
    public function index(Request $request){

        $product_in = Product::select('id','code','price','total_price')->where("product_in",1)
        ->where("status",1)->paginate(3);
        $product_out = Product::select('id','code','price','total_price')
        ->where("status",1)->where("product_in",0)->paginate(3);
        $product_in_total_price = Product::where('status',1)->where('product_in',1)->sum('total_price');
        $product_out_total_price = Product::where('status',1)->where('product_in',0)->sum('total_price');

        
        return view('dashboard.report.index',compact("product_in","product_out",'product_in_total_price','product_out_total_price'));
    }

    public function filter(Request $request){


        $product_in = Product::select('id','code','price')
        ->where("status",1)->where("product_in",1)
        ->whereBetween('updated_at',[$request->from_date, $request->to_date])
        ->paginate(3);

        $product_out = Product::select('id','code','price')
        ->where("status",1)->where("product_in",0)
        ->whereBetween('updated_at',[$request->from_date, $request->to_date])
        ->paginate(3);

        $product_in_total_price = Product::where('status',1)->where('product_in',1)->sum('total_price');
        $product_out_total_price = Product::where('status',1)->where('product_in',0)->sum('total_price');

         
        return view('dashboard.report.index',compact("product_in","product_out",'product_in_total_price','product_out_total_price'));
    }
}
