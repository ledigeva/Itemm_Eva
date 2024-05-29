<?php

namespace App\Http\Controllers;


use App\Models\Choix_Cat;
use App\Models\Depots;
use App\Models\Articles;
use App\Models\Dispos;
use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Common\Mode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QrCodeController extends Controller
{
   
    public function obtenirInfosArticles(){

    $donnees = Dispos::with('articles.choix_cat1', 'articles.choix_cat2', 'articles.choix_cat3', 'depots')
    ->get()
    ->map(function ($dispo) {
    return [
        'id' => $dispo->GQ_ARTICLE . "|" . $dispo->GQ_DEPOT,
        'produit' => $dispo->articles->GA_LIBELLE,
        'cat' => $dispo->articles->choix_cat1->isNotEmpty() ? $dispo->articles->choix_cat1->first()->CC_LIBELLE : 'N/A',
        'scat1' => $dispo->articles->choix_cat2->isNotEmpty() ? $dispo->articles->choix_cat2->first()->CC_LIBELLE : 'N/A',
        'scat2' => $dispo->articles->choix_cat3->isNotEmpty() ? $dispo->articles->choix_cat3->first()->CC_LIBELLE : 'N/A',
        'qte' => $dispo->GQ_PHYSIQUE,
        'sat' => $dispo->depots->GDE_LIBELLE,
        'coche' => '<input type="checkbox"/>'
    ];
});
return $donnees;
}



    public function filtreTableauSatellite($idSatelitte){

$donneesFiltrees = Dispos::with('articles.choix_cat1', 'articles.choix_cat2', 'articles.choix_cat3', 'depots')
    ->where('GQ_DEPOT', $idSatelitte)
    ->get()
    ->map(function ($dispo) {
    return [
        'id' => $dispo->GQ_ARTICLE . "|" . $dispo->GQ_DEPOT,
        'produit' => $dispo->articles->GA_LIBELLE,
        'cat' => $dispo->articles->choix_cat1->isNotEmpty() ? $dispo->articles->choix_cat1->first()->CC_LIBELLE : 'N/A',
        'scat1' => optional($dispo->articles->choix_cat2)->isNotEmpty() ? $dispo->articles->choix_cat2->first()->CC_LIBELLE : 'N/A',
        'scat2' => optional($dispo->articles->choix_cat3)->isNotEmpty() ? $dispo->articles->choix_cat3->first()->CC_LIBELLE : 'N/A',
        'qte' => $dispo->GQ_PHYSIQUE,
        'sat' => $dispo->depots->GDE_LIBELLE,
        'coche' => '<input type="checkbox"/>',
    ];
});
return response()->json($donneesFiltrees);

    }


    public function obtenirLocalisation()
    {
        $depots=Depots::all();
        return $depots;
    }

    public function obtenirCategorie()
    {
        $cat=Choix_Cat::all()->where('CC_TYPE','FN1');
        return $cat;
    }
    public function obtenirSousCategorie($idCategorie)
    {
      
        $souscat = Choix_Cat::whereIn('cc_code', function($query) use ($idCategorie) {
            $query->select('GA_Familleniv2')
                ->distinct()
                ->from('articles')
                ->where('GA_FAMILLENIV1', $idCategorie);
        })->get();
        return $souscat;

    }
    public function obtenirSousCategorie2($idCategorie2)
    {

        //$souscatt = DB::select('SELECT * FROM choix_cat WHERE cc_code IN (SELECT DISTINCT GA_Familleniv3 FROM articles WHERE GA_FAMILLENIV2="$idCategorie"');
        
        $souscatt = Choix_Cat::whereIn('cc_code', function($query) use ($idCategorie2) {
            $query->select('GA_Familleniv3')
                ->distinct()
                ->from('articles')
                ->where('GA_FAMILLENIV2', $idCategorie2);
        })->get();

        return $souscatt;
    }



    public function obtenirInformationTableau(Request $request)
    {
        $query = DB::table('dispos')
        ->join('articles', 'dispos.GQ_ARTICLE', '=', 'articles.GA_CODEARTICLE')
        ->join('depots', 'dispos.GQ_DEPOT', '=', 'depots.GDE_DEPOT');


        //satellite
    if ($request->filled('satellite')) {
        $query->where('depots.GDE_LIBELLE', $request->input('satellite'));

        $cat=Choix_Cat::all()->where('CC_TYPE','FN1');
        return $cat;
    }

    //categorie
    if ($request->filled('categorie')) {
        $query->where('articles.GA_FAMILLENIV1', $request->input('categorie'));
    }


    //souscat
    if ($request->filled('sous_categorie1')) {
        $query->where('articles.GA_FAMILLENIV2', $request->input('sous_categorie1'));
    }


    //souscatt
    if ($request->filled('sous_categorie2')) {
        $query->where('articles.GA_FAMILLENIV3', $request->input('sous_categorie2'));
    }

    $articles = $query->get();

    return view('qrcode', data: ['articles' => $articles]);
}


    
    public function genepagepdfqrcode() 
    {
    
        $pdf = Pdf::loadView('pdfqrcode');
        return $pdf->download();

    }


    public function genererQrCode(Request $request) {
        // Récupérer les données envoyées depuis JavaScript
        $boites = $request->boites;
    
        // Traiter les données comme nécessaire (par exemple, générer les QR codes)
        $tabJson= array();
        // pour chaque boite on genere le json
        foreach($boites as $boite)
        {
            $tab=explode("|",$boite);   // separer article et satelitte
            $idArticle=$tab[0];
            $idDepot=$tab[1];
            array_push($tabJson, array(
                'idArt' => $idArticle,
                'idDepot' => $idDepot
            ));
        }


        // Retourner une réponse
        //return response()->json($tabJson);
       // $this->générerpdfqrcode();
        return view('pdfqrcode', data: ['boites' => $tabJson]);

    }

    public function generateQrCode() 
    {
        $image = \QrCode::format('png')
                 ->size(200)
                 ->generate('A simple example of QR code!');
        $output_file = '/img/qr-code/-' . time() . '.png';
        Storage::disk('public')->put($output_file, $image);

        return 'sucess';
    }
}
