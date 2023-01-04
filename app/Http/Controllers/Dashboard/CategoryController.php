<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        if (session('category-create')) {
            toast(Session::get('category-create'), "success");
        }
        if (session('category-delete')) {
            toast(Session::get('category-delete'), "success");
        }
        if (session('category-update')) {
            toast(Session::get('category-update'), "success");
        }
        $categories = Category::orderBy('id', 'desc')->get();
        return view('dashboard.category.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('category')->with('category-create', "Category has been created Successfully!");
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
