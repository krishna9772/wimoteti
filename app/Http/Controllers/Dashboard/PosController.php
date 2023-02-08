<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pos;
use App\Models\PosItem;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PosController extends Controller
{
    public function index()
    {
        if (session('pos-create')) {
            toast(Session::get('pos-create'), "success");
        }
        if (session('pos-delete')) {
            toast(Session::get('pos-delete'), "success");
        }
        if (session('pos-update')) {
            toast(Session::get('pos-update'), "success");
        }
        $pos = Pos::with('customer')->where('status',1)->orderBy('created_at', 'desc')->get();
        // return $pos;
        
        return view('dashboard.pos.index', compact('pos'));
    }

    public function create()
    {
        $customers = Customer::where('status',1)->orderBy('created_at','desc')->get();
        $products = Product::select('code','id')->where('status',1)->orderBy('id', 'desc')->get();
        return view('dashboard.pos.create',compact('customers','products'));
    }


    public function store(Request $request){
        // return $request->code;
        
        $validator = Validator::make($request->all(),[
            "name" => "required",
            'ph_no' => 'required',
            "address" => "required",
            "code" => "required",
            "quantity" => "required",
            "price" => "required",
            "netAmount" => "required",
            "paid_status" => "required",
        ]);

        if($validator->fails()){
            return response()->json(["status"=>422,"message"=>$validator->errors()]);
        };

       
        $pp = Pos::select('voucher_no')->orderBy('created_at', 'desc')->first();
       
        
        if(isset($pp)){
            $num = $pp->voucher_no + 1;
            $str_length = 8;
            $v_no = substr("00000000{$num}", -$str_length);
        }else{
            $num = 1;
            $str_length = 8;
            $v_no = substr("00000000{$num}", -$str_length);
        }
        
        $user_id = Auth::user()->id;
        $pos = new Pos();
        $pos->c_id = $request->name;
        $pos->voucher_no = $v_no;
        $pos->total_price = $request->netAmount;
        $pos->discount = $request->discount;
        $pos->payment_status = $request->paid_status;
        $pos->created_by = $user_id;
        $pos->updated_by = $user_id;
        $pos->save();


        $product_id = $request->code;
        $quantity = $request->quantity;
        // $qtyCount = count($quantity);
        $posProduct = Product::with('getCategory')->whereIn('id',$product_id)->get();
        $num = 0;

        foreach($posProduct as $product){
            
            $posItem = new PosItem();
            $posItem->pos_id = $pos->id;
            $posItem->product_id = $product->id;
            $posItem->type = $product->getCategory->name;
            $posItem->code = $product->code;
            $posItem->image = $product->image;
            $posItem->gem_type = $product->gem_type;
            $posItem->quantity = $quantity[$num];
            $posItem->weight = $product->weight;
            $posItem->price = $product->price;
            $posItem->gold_quantity_p = $product->gold_quantity_p;
            $posItem->gold_quantity_y = $product->gold_quantity_y;
            $posItem->gold_price = $product->gold_price;
            $posItem->ad_gold_quantity_p = $product->ad_gold_quantity_p;
            $posItem->ad_gold_quantity_y = $product->ad_gold_quantity_y;
            $posItem->ad_gold_price = $product->ad_gold_price;
            $posItem->service_charges = $product->service_charges;
            $posItem->total_price = $request->total[$num];
            $posItem->save();
            $num++;
        }

        return redirect()->route('pos')->with("pos-create","Pos has been created successfully!");
    }

    public function getCustomer($id){

        $customer = Customer::where('id',$id)->first();
        return response()->json(
            [
                "ph_no" => $customer->ph_no,
                "address" => $customer->address,
            ]
        );
    }

    public function getProduct($id){

        $product = Product::where('id',$id)->first();
        return response()->json(
            [
                "price" => $product->total_price,
            ]
        );
        return response()->json($id);
    }

    public function voucher($id){

        $pos = Pos::with('positem','customer')->where("id",$id)->first();
        // return $pos;
        $created_by = User::select('name')->where('id',$pos->created_by)->first();
        return view('dashboard.voucher.index',compact('pos','created_by'));
    }
}