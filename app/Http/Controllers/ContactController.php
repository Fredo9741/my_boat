<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Mail\EstimationMail;
use App\Mail\PartnershipMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Email de destination pour tous les formulaires
     */
    private string $contactEmail = 'gisman261@gmail.com';

    /**
     * Send contact form email (from boat detail page)
     */
    public function send(Request $request)
    {
        // Détecter le type de formulaire
        $formType = $this->detectFormType($request);

        \Log::info('Contact form submitted', [
            'type' => $formType,
            'mailer' => config('mail.default'),
            'from' => config('mail.from.address'),
        ]);

        return match($formType) {
            'boat_inquiry' => $this->handleBoatInquiry($request),
            'estimation' => $this->handleEstimation($request),
            'partnership' => $this->handlePartnership($request),
            default => $this->handleGeneralContact($request),
        };
    }

    /**
     * Detect form type based on request data
     */
    private function detectFormType(Request $request): string
    {
        if ($request->has('bateau_id')) {
            return 'boat_inquiry';
        }

        if ($request->input('sujet') === 'estimation' || $request->has('type_bateau')) {
            return 'estimation';
        }

        if ($request->has('company') || $request->has('activity_type')) {
            return 'partnership';
        }

        return 'general';
    }

    /**
     * Handle boat inquiry from boat detail page
     */
    private function handleBoatInquiry(Request $request)
    {
        \Log::info('handleBoatInquiry called', ['request' => $request->all()]);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
            'bateau_id' => 'required|exists:bateaux,id',
            'bateau_titre' => 'required|string',
            'bateau_slug' => 'required|string',
        ]);

        \Log::info('Boat inquiry validation passed', ['validated' => $validated]);

        try {
            \Log::info('Attempting to send boat inquiry email', [
                'to' => $this->contactEmail,
                'subject' => 'Demande bateau: ' . $validated['bateau_titre'],
                'mailer' => config('mail.default'),
            ]);

            Mail::send('emails.boat-inquiry', ['data' => $validated], function ($message) use ($validated) {
                $message->to($this->contactEmail)
                    ->subject('Demande bateau: ' . $validated['bateau_titre'])
                    ->replyTo($validated['email'], $validated['nom']);
            });

            \Log::info('Boat inquiry email sent successfully');

            return redirect()->back()
                ->with('success', 'Votre message a été envoyé avec succès! Nous vous répondrons dans les plus brefs délais.');
        } catch (\Exception $e) {
            \Log::error('Email sending failed (boat inquiry): ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'envoi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Handle general contact form
     */
    private function handleGeneralContact(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:20',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        try {
            Mail::send('emails.general-contact', ['data' => $validated], function ($message) use ($validated) {
                $message->to($this->contactEmail)
                    ->subject('Contact Myboat-oi: ' . $validated['sujet'])
                    ->replyTo($validated['email'], $validated['nom']);
            });

            return redirect()->back()
                ->with('success', 'Votre message a été envoyé avec succès! Nous vous répondrons dans les plus brefs délais.');
        } catch (\Exception $e) {
            \Log::error('Email sending failed (general contact): ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'envoi du message: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Handle estimation request form (sell page)
     */
    private function handleEstimation(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|max:20',
            'type_bateau' => 'nullable|string|max:255',
            'marque' => 'nullable|string|max:255',
            'modele' => 'nullable|string|max:255',
            'annee' => 'nullable|integer|min:1950|max:' . (date('Y') + 1),
            'longueur' => 'nullable|numeric|min:1|max:100',
            'localisation' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'message' => 'required|string|max:3000',
        ]);

        try {
            Mail::send('emails.estimation', ['data' => $validated], function ($message) use ($validated) {
                $message->to($this->contactEmail)
                    ->subject('Demande d\'estimation - ' . ($validated['type_bateau'] ?? 'Bateau') . ' - ' . ($validated['marque'] ?? '') . ' ' . ($validated['modele'] ?? ''))
                    ->replyTo($validated['email'], $validated['nom']);
            });

            return redirect()->back()
                ->with('success', 'Votre demande d\'estimation a été envoyée! Nous vous recontacterons sous 24h.');
        } catch (\Exception $e) {
            \Log::error('Email sending failed (estimation): ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'envoi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Handle partnership request form
     */
    private function handlePartnership(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'activity_type' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:3000',
            'accept_terms' => 'required|accepted',
        ]);

        try {
            Mail::send('emails.partnership', ['data' => $validated], function ($message) use ($validated) {
                $message->to($this->contactEmail)
                    ->subject('Demande de partenariat - ' . $validated['company'])
                    ->replyTo($validated['email'], $validated['name']);
            });

            return redirect()->back()
                ->with('success', 'Votre demande de partenariat a été envoyée! Nous vous recontacterons sous 24h.');
        } catch (\Exception $e) {
            \Log::error('Email sending failed (partnership): ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'envoi: ' . $e->getMessage())
                ->withInput();
        }
    }
}
