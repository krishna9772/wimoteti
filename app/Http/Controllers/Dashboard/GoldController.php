<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoldPrice;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class GoldController extends Controller
{
    public function index()
    {
        if (session('gold-create')) {
            toast(Session::get('gold-create'), "success");
        }
        if (session('gold-delete')) {
            toast(Session::get('gold-delete'), "success");
        }
        if (session('gold-update')) {
            toast(Session::get('gold-update'), "success");
        }
        $gold = GoldPrice::orderBy('id', 'desc')->get();
        return view('dashboard.gold.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'price' => 'required',
        ]);
        $user_id = Auth::user()->id;
        GoldPrice::where('status',1)->update(
            [
                'status' => false,
            ]
        );
        
        GoldPrice::create([
            'price' => $request->price,
            'status' => true,
            'created_by' => $user_id,
            'updated_by' => $user_id,
        ]);

        return back();
    }

    public function edit($id)
    {
        $category = Category::findorFail($id);
        return view('dashboard.category.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $this->validate($request, [
            'name' => 'required',
        ]);

        Category::find($id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category')->with('category-update', "Category has been updated Successfully!");
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return redirect()->route('category')->with('category-delete', 'Category has been deleted successfully!');
    }
}
