<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pos;
use App\Models\PosItem;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\ExchangeReturn;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ExchangeReturnController extends Controller
{
    public function index(){

        
        if (session('exchange-return-delete')) {
            toast(Session::get('exchange-return-delete'), "success");
        }
        if (session('exchange-return-update')) {
            toast(Session::get('exchange-return-update'), "success");
        }

        $exchange_return = ExchangeReturn::with('pos')->where("status",1)->get();
        // return $exchange_return;

        return view("dashboard.exchange-return.index",compact("exchange_return"));
    }


    public function create(){

        if (session('exchange-return-create')) {
            toast(Session::get('exchange-return-create'), "success");
        }
        $pos = Pos::select("id","voucher_no")->where("status",1)
        ->where("is_return",0)
        ->where("payment_status","paid")->get();
        return view("dashboard.exchange-return.create",compact("pos"));
    }


    public function store(Request $request){
        // return $request;
        $validator = Validator::make($request->all(),[
            "pos_id" => "required",
            "extra_charges" => "required",
            "percentage" => "required",
            "type" => "required",
            "final_amount" => "required",
        ]);

        if($validator->fails()){
            return response()->json(["status"=>422,"message"=>$validator->errors()]);
        };

        $user_id = Auth::user()->id;
        $exchange_return = new ExchangeReturn();
        $exchange_return->pos_id = $request->pos_id;
        $exchange_return->type = $request->type;
        $exchange_return->percentage = $request->percentage;
        $exchange_return->extra_charges = $request->extra_charges;
        $exchange_return->final_amount = $request->final_amount;
        $exchange_return->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $exchange_return->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $exchange_return->created_by = $user_id;
        $exchange_return->updated_by = $user_id;
        $exchange_return->save();


        Pos::where("id",$request->pos_id)->update([
            "is_return" => 1 ,
        ]);
        

        return redirect()->back()->with("exchange-return-create","Exchange & return has been created successfully!");
    }


    public function edit($id){
        $pos = Pos::select("id","voucher_no")->where("status",1)->where("payment_status","paid")->get();
        $exchange_return = ExchangeReturn::find($id);
    
        return view('dashboard.exchange-return.edit', compact('pos','exchange_return'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            "pos_id" => "required",
            "extra_charges" => "required",
            "percentage" => "required",
            "type" => "required",
            "final_amount" => "required",
        ]);

        if($validator->fails()){
            return response()->json(["status"=>422,"message"=>$validator->errors()]);
        };

        $user_id = Auth::user()->id;
        $exchange_return = ExchangeReturn::find($id)->first();
        $exchange_return->pos_id = $request->pos_id;
        $exchange_return->type = $request->type;
        $exchange_return->percentage = $request->percentage;
        $exchange_return->extra_charges = $request->extra_charges;
        $exchange_return->final_amount = $request->final_amount;
        $exchange_return->updated_by = $user_id;
        $exchange_return->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $exchange_return->save();

        return redirect()->route('exchange-return')->with("exchange-return-update","Exchange & return has been updated successfully!");
    
    }

    public function delete($id){
        ExchangeReturn::find($id)->update(['status' => 0]);
        return redirect()->route('exchange-return')->with("exchange-return-delete","Exchange & return has been deleted successfully!");
    }

    public function getPos($id){
       
        $pos = Pos::where("id",$id)->first();
        return response()->json(
            [
                "total_price" => $pos->total_price,
            ]
        );
    }
}
