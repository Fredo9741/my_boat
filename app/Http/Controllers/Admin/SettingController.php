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

    /**
     * Update admin password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Le mot de passe actuel est requis',
            'new_password.required' => 'Le nouveau mot de passe est requis',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères',
            'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
        ]);

        $user = auth()->user();

        // Vérifier le mot de passe actuel
        if (!password_verify($validated['current_password'], $user->password)) {
            return redirect()->route('admin.settings.index')
                ->with('error', 'Le mot de passe actuel est incorrect.');
        }

        // Mettre à jour le mot de passe
        $user->password = bcrypt($validated['new_password']);
        $user->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Mot de passe modifié avec succès.');
    }
}
