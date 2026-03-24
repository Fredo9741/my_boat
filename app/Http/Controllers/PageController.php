<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\Setting;

class PageController extends Controller
{
    /**
     * Page À propos
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Page Contact
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Page Vendre mon bateau
     */
    public function sell()
    {
        return view('pages.sell');
    }

    /**
     * Page Mentions légales
     */
    public function mentionsLegales()
    {
        return view('pages.mentions-legales');
    }

    /**
     * Page CGV
     */
    public function cgv()
    {
        return view('pages.cgv');
    }

    /**
     * Page Confidentialité
     */
    public function confidentialite()
    {
        return view('pages.confidentialite');
    }

    /**
     * Fiche de renseignement bateau (imprimable / PDF)
     */
    public function ficheBateau()
    {
        $equipements = Equipement::orderBy('categorie')->orderBy('libelle')->get()->groupBy('categorie');
        return view('pages.fiche-bateau', compact('equipements'));
    }
}
