<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return inertia('Services/SettingIndex', [
            'settings' => Setting::all()
        ]);
    }

    public function store(Request $request, Setting $setting)
    {
        $setting->update([
            'email' => $request->email,
            'address' => $request->address,
        ]);
    }
}
