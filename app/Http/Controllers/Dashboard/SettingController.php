<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        if (session('setting-create')) {
            toast(Session::get('setting-create'), "success");
        }
        if (session('setting-delete')) {
            toast(Session::get('setting-delete'), "success");
        }
        if (session('setting-update')) {
            toast(Session::get('setting-update'), "success");
        }
        $settings = Setting::orderBy('id', 'desc')->get();
        return view('dashboard.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('dashboard.settings.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'key' => 'required|unique:settings',
            'value'=> 'required',
        ]);

        Setting::create([
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return redirect()->route('setting')->with('setting-create', "Setting has been created Successfully!");

        
    }

    public function edit($id)
    {
        $setting = Setting::findorFail($id);
        return view('dashboard.settings.edit',compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);
        $this->validate($request, [
            'key' => 'required|unique:settings',
            'value'=> 'required',
        ]);

        Setting::find($id)->update([
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return redirect()->route('setting')->with('setting-update', "Setting has been updated Successfully!");
    }

    public function delete($id)
    {
        Setting::find($id)->delete();
        return redirect()->route('setting')->with('setting-delete', 'Setting has been deleted successfully!');
    }
}
