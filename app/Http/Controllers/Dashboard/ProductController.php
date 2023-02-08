<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        if (session('product-create')) {
            toast(Session::get('product-create'), "success");
        }
        if (session('product-delete')) {
            toast(Session::get('product-delete'), "success");
        }
        if (session('product-update')) {
            toast(Session::get('product-update'), "success");
        }
        $products = Product::with('getCategory')->where('status', 1)->orderBy('id', 'desc')->get();
        // return $products;
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "code" => "required",
            'type' => 'required',
            // "gold_quantity_p" => "required",
            // "gold_quantity_y" => "required",
            "gold_price" => "required",
            // "ad_gold_quantity_p" => "required",
            // "ad_gold_quantity_y" => "required",
            // "ad_gold_price" => "required",
            "total_price" => "required",
            "service_charges" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => 422, "message" => $validator->errors()]);
        };


        $path = '';
        if ($request->file()) {
            $dir = public_path() . "/storage/product/";

            $newName = uniqid() . "_" . $request->image->getClientOriginalName();
            $request->file("image")->move($dir, $newName);
            $path = "product/" . $newName;
        }

        $user_id = Auth::user()->id;
        $code = $request->code;
        for ($x = 0; $x < $request->product_qty; $x++) {
            $product = new Product();
            $product->image = $path;
            $product->code =   $code;
            $product->type = $request->type;
            $product->gem_type = $request->gem_type;
            $product->quantity = $request->quantity;
            $product->weight = $request->weight;
            $product->weight_type = $request->weight_type;
            $product->price = $request->price;
            $product->gold_quantity_p = $request->gold_quantity_p;
            $product->gold_quantity_y = $request->gold_quantity_y;
            $product->gold_price = $request->gold_price;
            $product->ad_gold_quantity_p = $request->ad_gold_quantity_p;
            $product->ad_gold_quantity_y = $request->ad_gold_quantity_y;
            $product->ad_gold_price = $request->ad_gold_price;
            $product->service_charges = $request->service_charges;
            $product->total_price = $request->total_price;
            $product->created_by = $user_id;
            $product->updated_by = $user_id;
            $product->save();
            $code++;
        }
        return redirect()->route('product')->with("product-create", "Product has been created successfully!");
    }

    public function edit($id)
    {
        $product = Product::findorFail($id);
        $categories = Category::all();

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "code" => "required",
            'type' => 'required',
            "gold_price" => "required",
            "ad_gold_price" => "required",
            "total_price" => "required",
            "service_charges" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => 422, "message" => $validator->errors()]);
        };


        $old_image = Product::select('image')->find($id);
        $path = $old_image->image;
        if ($request->file()) {
            $dir = public_path() . "/storage/product/";

            $newName = uniqid() . "_" . $request->image->getClientOriginalName();
            $request->file("image")->move($dir, $newName);
            $path = "product/" . $newName;
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
            'gold_quantity_p' => $request->gold_quantity_p,
            'gold_quantity_y' => $request->gold_quantity_y,
            'gold_price' => $request->gold_price,
            'ad_gold_quantity_p' => $request->ad_gold_quantity_p,
            'ad_gold_quantity_y' => $request->ad_gold_quantity_y,
            'ad_gold_price' => $request->ad_gold_price,
            'service_charges' => $request->service_charges,
            'total_price' => $request->total_price,
            'updated_by' => $user_id,
        ]);

        return redirect()->route('product')->with("product-update", "Product has been updated successfully!");
    }

    public function delete($id)
    {
        Product::find($id)->update(['status' => 0]);
        return redirect()->route('product')->with("product-delete", "Product has been deleted successfully!");
    }
}
