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
use Carbon\Carbon;

class PosController extends Controller
{
    public function index(Request $request)
    {
       
        if (session('pos-delete')) {
            toast(Session::get('pos-delete'), "success");
        }
        if (session('pos-update')) {
            toast(Session::get('pos-update'), "success");
        }

        if($request->has('type')){
            if($request->get('type') == 'return'){
                $pos = Pos::with('customer')->where('status',1)
                ->where("is_return",1)
                ->orderBy('created_at', 'desc')->get();
            }
        }else{
            $pos = Pos::with('customer')->where('status',1)
            ->where("is_return",0)
            ->orderBy('created_at', 'desc')->get();
        }

        
        // return $pos;
        
        return view('dashboard.pos.index', compact('pos'));
    }

    public function create()
    {
        if (session('pos-create')) {
            toast(Session::get('pos-create'), "success");
        }
        $customers = Customer::where('status',1)->orderBy('created_at','desc')->get();
        $products = Product::select('code','id')->where('status',1)
        ->where("product_in",1)
        ->orderBy('id', 'desc')->get();
        return view('dashboard.pos.create',compact('customers','products'));
    }


    public function store(Request $request){
        // return $request;
        
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
        $pos->description = $request->description;
        $pos->advance = $request->advance;
        $pos->is_can_return = $request->is_can_return;
        $pos->balance = ($request->netAmount)-($request->advance);
        $pos->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $pos->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $pos->created_by = $user_id;
        $pos->updated_by = $user_id;
        $pos->is_can_return = $request->is_can_return;
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
            $posItem->gem_quantity = $product->quantity;
            $posItem->weight = $product->weight;
            $posItem->weight_type = $product->weight_type;
            $posItem->price = $product->price;
            $posItem->gold_quantity_k = $product->gold_quantity_k;
            $posItem->gold_quantity_p = $product->gold_quantity_p;
            $posItem->gold_quantity_y = $product->gold_quantity_y;
            $posItem->gold_price = $product->gold_price;
            $posItem->ad_gold_quantity_k = $product->ad_gold_quantity_k;
            $posItem->ad_gold_quantity_p = $product->ad_gold_quantity_p;
            $posItem->ad_gold_quantity_y = $product->ad_gold_quantity_y;
            $posItem->ad_gold_price = $product->ad_gold_price;
            $posItem->net_weight = $product->net_weight;
            $posItem->service_charges = $product->service_charges;
            $posItem->total_price = $product->total_price;
            $posItem->save();
            $num++;
        }

        Product::whereIn("id",$product_id)->update(
            [
                "product_in" => 0 ,
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        return redirect()->back()->with("pos-create","Pos has been created successfully!");
    }


    public function edit($id)
    {
        $pos = Pos::with("positem")->with('customer')->find($id);
        $customers = Customer::where('status',1)->orderBy('created_at','desc')->get();
        $products = Product::select('code','id')
        // ->where("product_in",1)
        ->where('status',1)->orderBy('id', 'desc')->get();
        // return $pos;
        

        return view('dashboard.pos.edit', compact('pos','customers','products'));

    }


    public function update(Request $request, $id){

        // return $request;

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

        $old_pos_item = PosItem::select('id')->where('pos_id',$id)->get();
        foreach($old_pos_item as $o_p_item){
            PosItem::where("id",$o_p_item->id)->delete();
        }
        
        $user_id = Auth::user()->id;
        $pos = Pos::findorfail($id);
        $pos->c_id = $request->name;
        $pos->total_price = $request->netAmount;
        $pos->discount = $request->discount;
        $pos->payment_status = $request->paid_status;
        $pos->description = $request->description;
        $pos->advance = $request->advance;
        $pos->is_can_return = $request->is_can_return;
        $pos->balance = ($request->netAmount)-($request->advance);
        $pos->updated_by = $user_id;
        $pos->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $pos->is_can_return = $request->is_can_return;
        $pos->update();


        $product_id = $request->code;
        $quantity = $request->quantity;
        $posProduct = Product::with('getCategory')->whereIn('id',$product_id)->get();
        $num = 0;
      
        foreach($posProduct as $product){
            
            $posItem = new PosItem();
            $posItem->pos_id = $id;
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
            $posItem->total_price = $product->total_price;
            $posItem->save();
            $num++;
        }

        Product::whereIn("id",$product_id)->update(
            [
                "product_in" => 0 ,
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        return redirect()->route('pos')->with("pos-update","Pos has been updated successfully!");
    }


    public function delete($id)
    {   
        // return $id;
        Pos::find($id)->update(['status' => 0]);
        return redirect()->route('pos')->with("pos-delete","Pos has been deleted successfully!");
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

    public function getcreatedCustomer(){
        $customer = Customer::where('status',1)->orderBy("created_at","desc")->first();
        return response()->json(

            [   
                "id" => $customer->id,
                "name" => $customer->name,
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
        // return response()->json($id);
    }
    

    public function voucher($id){

        $pos = Pos::with('positem','customer')->where("id",$id)->first();
        // return $pos;
        $created_by = User::select('name')->where('id',$pos->created_by)->first();
        return view('dashboard.voucher.index',compact('pos','created_by'));
    }

    public function voucherSearch(Request $request){
        $voucherFilter = Pos::with('positem','customer')->where("voucher_no",$request->voucher_no)->first();
        // return $voucherFilter;
        return view("dashboard.home.voucher",compact("voucherFilter"));
    }


    public function voucherBlank(Request $request){
       
        if($request->get('type') == 1){
            return view("dashboard.home.voucher-blank-1");
        }elseif($request->get('type') == 2){
            return view("dashboard.home.voucher-blank-2");
        }
        
    }
}
