<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Send contact form email
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
            'bateau_id' => 'required|exists:bateaux,id',
            'bateau_titre' => 'required|string',
        ]);

        // Get contact email from settings
        $contactEmail = Setting::get('contact_email');

        if (!$contactEmail) {
            return redirect()->back()
                ->with('error', 'Erreur: Email de contact non configuré. Veuillez contacter l\'administrateur.');
        }

        try {
            // Send email
            Mail::to($contactEmail)->send(new ContactFormMail($validated));

            return redirect()->back()
                ->with('success', 'Votre message a été envoyé avec succès! Nous vous répondrons dans les plus brefs délais.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'envoi du message. Veuillez réessayer plus tard.')
                ->withInput();
        }
    }
}
