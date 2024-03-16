<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::query()->paginate(10);

        return view('backend.pages.setting.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.setting.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingsRequest $request)
    {
        $setting = $request->all();

        if (Setting::query()->create($setting))
        {
            return redirect()->route('admin.setting.index')->with('success', 'Parametr yaradıldı!');
        } else {
            return redirect()->route('admin.setting.create')->with('error', 'Parametr yaradılma zamanı xəta yarandı!');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setting = Setting::query()->where('id', $id)->firstOrFail();

        return view('backend.pages.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
    }
}
