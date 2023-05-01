<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
       
       
        if (session('product-delete')) {
            toast(Session::get('product-delete'), "success");
        }
        if (session('product-update')) {
            toast(Session::get('product-update'), "success");
        }

        if($request->has('type')){
            if($request->get('type') == 'out'){
                $products = Product::with('getCategory')
                ->where("product_in",0)
                ->where('status', 1)->orderBy('updated_at', 'desc')->get();
            }
        }else{
            $products = Product::with('getCategory')
            ->where("product_in",1)
            ->where('status', 1)->orderBy('created_at', 'desc')->get();
        }
       
        // return $products[0]->total_price;
        // return substr($products[0]->total_price, -4);
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        if (session('product-create')) {
            toast(Session::get('product-create'), "success");
        }
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    public function store(Request $request)
    {

        // return $request;
        $validator = Validator::make($request->all(), [
            "code" => "required",
            'type' => 'required',
            "gold_price" => "required",
            "total_price" => "required",
            "service_charges" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => 422, "message" => $validator->errors()]);
        };

        $user_id = Auth::user()->id;
        $code = $request->code;
        $path = '';
        if ($request->hasfile('image')) {
         
            foreach ($request->file('image') as $file) {
               
                $dir = public_path() . "/storage/product/";
                $newName = uniqid() . "_" . $file->getClientOriginalName();
                $file->move($dir, $newName);
                $path .= "product/" . $newName . "~%";                         
            }
        }   
                $product = new Product();
                $product->image = $path;
                $product->code =   $code;
                $product->type = $request->type;
                $product->gem_type = json_encode($request->gem_type);
                $product->quantity = json_encode($request->quantity);
                $product->weight = json_encode($request->weight);
                $product->weight_type = json_encode($request->weight_type);
                $product->price = json_encode($request->price);
                $product->gold_quantity_k = $request->gold_quantity_k;
                $product->gold_quantity_p = $request->gold_quantity_p;
                $product->gold_quantity_y = $request->gold_quantity_y;
                $product->gold_price = $request->gold_price;
                $product->ad_gold_quantity_k = $request->ad_gold_quantity_k;
                $product->ad_gold_quantity_p = $request->ad_gold_quantity_p;
                $product->ad_gold_quantity_y = $request->ad_gold_quantity_y;
                $product->ad_gold_price = $request->ad_gold_price;
                $product->service_charges = $request->service_charges;
                $product->net_weight = $request->net_weight;

                
                $lastfourdigits = substr($request->total_price, -4);
                $lastfournumber = intval($lastfourdigits);
                if($lastfournumber >= 5000){
                    $reducetotal = ($request->total_price) - $lastfournumber;
                    $total_price = $reducetotal + 10000;
                }elseif($lastfournumber < 5000){
                    $reducetotal = ($request->total_price) - $lastfournumber;
                    $total_price = $reducetotal;
                }
                $product->total_price = $total_price;
                $product->created_at = Carbon::now()->format('Y-m-d H:i:s');
                $product->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $product->created_by = $user_id;
                $product->updated_by = $user_id;
                $product->save();
 
        return redirect()->back()->with("product-create", "Product has been created successfully!");
    }

    public function edit($id)
    {
        $product = Product::findorFail($id);
        $categories = Category::all();

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {

        // return $request;
        $validator = Validator::make($request->all(), [
            "code" => "required",
            'type' => 'required',
            "gold_price" => "required",
            "ad_gold_price" => "required",
            "total_price" => "required",
            "service_charges" => "required",
            // "net_weight" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => 422, "message" => $validator->errors()]);
        };


        $old_image = Product::select('image')->find($id);
        $path = $old_image->image . "~%";;
        if ($request->hasfile('image')) {

            foreach ($request->file('image') as $file) {
            $dir = public_path() . "/storage/product/";

            $newName = uniqid() . "_" . $file->getClientOriginalName();
            $file->move($dir, $newName);
            $path .= "product/" . $newName . "~%";

            }
        }

        $user_id = Auth::user()->id;
        Product::find($id)->update([
            'image' => $path,
            'code' => $request->code,
            'type' => $request->type,
            'gem_type' => $request->gem_type,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
            'weight_type' =>  $request->weight_type,
            'price' => $request->price,
            'gold_quantity_k' => $request->gold_quantity_k,
            'gold_quantity_p' => $request->gold_quantity_p,
            'gold_quantity_y' => $request->gold_quantity_y,
            'gold_price' => $request->gold_price,
            'ad_gold_quantity_k' => $request->ad_gold_quantity_k,
            'ad_gold_quantity_p' => $request->ad_gold_quantity_p,
            'ad_gold_quantity_y' => $request->ad_gold_quantity_y,
            'ad_gold_price' => $request->ad_gold_price,
            'service_charges' => $request->service_charges,
            'total_price' => $request->total_price,
            'updated_by' => $user_id,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('product')->with("product-update", "Product has been updated successfully!");
    }

    public function delete($id)
    {
        Product::find($id)->update(['status' => 0]);
        return redirect()->route('product')->with("product-delete", "Product has been deleted successfully!");
    }

    public function detail($id){
        $product = Product::with("getCategory")->findorFail($id);
        // return $product;
        return view('dashboard.products.detail', compact('product'));
    }
}