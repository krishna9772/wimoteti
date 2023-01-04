<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if (session('customer-create')) {
            toast(Session::get('customer-create'), "success");
        }
        if (session('customer-delete')) {
            toast(Session::get('customer-delete'), "success");
        }
        if (session('customer-update')) {
            toast(Session::get('customer-update'), "success");
        }
       
        $customers = Customer::where('status',1)->get();
        
        return view('dashboard.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('dashboard.customers.create');

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            "name" => "required",
            'ph_no' => 'required',
            "address" => "required",
        ]);

        if($validator->fails()){
            return response()->json(["status"=>422,"message"=>$validator->errors()]);
        };
        $user_id = Auth::user()->id;
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->ph_no = $request->ph_no;
        $customer->address = $request->address;
        $customer->created_by = $user_id;
        $customer->updated_by = $user_id;
        $customer->save();

        return redirect()->route('customer')->with("customer-create","Customer has been created successfully!");
    }
    

    public function edit($id)
    {
        $customer = Customer::findorFail($id);

        return view('dashboard.customers.edit', compact('customer'));

    }
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $validator = Validator::make($request->all(),[
            "name" => "required",
            'ph_no' => 'required',
            "address" => "required",
        ]);
        $user_id = Auth::user()->id;
        Customer::find($id)->update([
                'name' => $request->name,
                'ph_no' => $request->ph_no,
                'address' => $request->address,
                'updated_by' => $user_id,
        ]);

        return redirect()->route('customer')->with("customer-update","Customer has been updated successfully!");
    }

    public function delete($id)
    {   
        Customer::find($id)->update(['status' => 0]);
        return redirect()->route('customer')->with("customer-delete","Customer has been deleted successfully!");
    }
}
