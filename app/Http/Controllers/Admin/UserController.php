<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (session('user-create')) {
            toast(Session::get('user-create'), "success");
        }
        if (session('user-delete')) {
            toast(Session::get('user-delete'), "success");
        }
        if (session('user-update')) {
            toast(Session::get('user-update'), "success");
        }
       
        $users = User::where('status',1)->get();
        
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            "name" => "required",
            'username' => 'required',
            "password" => "required",
            "role" => "required",
        ]);

        if($validator->fails()){
            return response()->json(["status"=>422,"message"=>$validator->errors()]);
        };

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user')->with("user-create","User has been created successfully!");
    }
    

    public function edit($id)
    {
        $user = User::findorFail($id);

        return view('dashboard.users.edit', compact('user'));

    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validator = Validator::make($request->all(),[
            "name" => "required",
            'username' => 'required',
            "password" => "required",
            "role" => "required",
        ]);

        $record = User::find($id);
        $password = $record->password;
        if ($request->password) {
            $password = Hash::make($request->password);
        }

        User::where('id', $id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'password' => $password,
                'role' => $request->role,
        ]);

        return redirect()->route('user')->with("user-update","User has been updated successfully!");
    }



    public function delete($id)
    {
        User::find($id)->update(['status' => 0]);
        return redirect()->route('user')->with("user-delete","User has been deleted successfully!");
    }
}
