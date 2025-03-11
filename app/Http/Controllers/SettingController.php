<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function setting(): View
    {
        $setting = Setting::first();
        return view('setting.index', compact('setting'));
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required',
            'data_theme' => 'required',
            'dir' => 'required',
            'logo' => 'nullable',
            'icon' => 'nullable',
        ]);
        $setting = Setting::first();
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logo', 'public');
            if ($setting && $setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $validated['logo'] = $logoPath;
        }
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');
            if ($setting && $setting->icon) {
                Storage::disk('public')->delete($setting->icon);
            }
            $validated['icon'] = $iconPath;
        }
        if ($setting) {
            $setting->update($validated);
        } else {
            Setting::create($validated);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
