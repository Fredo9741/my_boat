<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display settings form
     */
    public function index()
    {
        $settings = [
            'contact_email' => Setting::get('contact_email', ''),
            'facebook_url' => Setting::get('facebook_url', ''),
            'instagram_url' => Setting::get('instagram_url', ''),
            'whatsapp_number' => Setting::get('whatsapp_number', ''),
            'phone_number' => Setting::get('phone_number', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => 'nullable|email',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'whatsapp_number' => 'nullable|string|max:20',
            'phone_number' => 'nullable|string|max:20',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }
}
