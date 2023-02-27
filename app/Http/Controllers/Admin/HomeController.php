<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $product_in = Product::select('id','code')
        ->where("status",1)->where("product_in",1)
        ->whereDate("created_at",now()->today())->paginate(3);
        $product_out = Product::select('id','code')
        ->where("status",1)->where("product_in",0)
        ->whereDate("updated_at",now()->today())->paginate(3);
        return view('dashboard.home.index',compact("product_in","product_out"));
    }
}
