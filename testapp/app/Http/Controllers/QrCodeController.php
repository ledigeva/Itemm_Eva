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

     /*   $donnees = Dispos::join('depots', 'GQ_DEPOT', '=', 'GDE_DEPOT')
    ->join('articles', 'GQ_ARTICLE', '=', 'GA_ARTICLE')
    ->join('choix_cat', 'GA_FAMILLENIV1', '=', 'CC_CODE')
    ->selectRaw('concat(GQ_ARTICLE, "|", GQ_DEPOT) as id, GA_LIBELLE, CC_LIBELLE, NULL, NULL, GDE_LIBELLE, GDE_DEPOT, GQ_PHYSIQUE')
    ->get();*/


        $donnees=DB::table('dispos')
        ->join('articles', 'dispos.GQ_ARTICLE', '=', 'articles.GA_CODEARTICLE')
        ->join('depots', 'dispos.GQ_DEPOT', '=', 'depots.GDE_DEPOT')
        ->join('choix_cat', 'articles.ga_familleniv1', '=', 'choix_cat.cc_code')

        ->selectRaw('concat(dispos.GQ_article, "|", dispos.gq_depot) as id, 
        articles.GA_LIBELLE as produit, 
        choix_cat.CC_LIBELLE as cat,

        choix_cat .cc_libelle as scat1,
        choix_cat.cc_libelle as scat2, 
        dispos.GQ_PHYSIQUE as qte,
        depots.GDE_LIBELLE as sat,"ok" as coche')

        ->get();

        //$souscat = DB::select('SELECT * FROM choix_cat WHERE cc_code 
        //IN (SELECT DISTINCT GA_Familleniv2 FROM articles WHERE GA_FAMILLENIV1="$idCategorie")', [$idCategorie])
    return $donnees;

   

    }

    public function filtreTableauSatellite($idsatelitte){
    
        $tableauSatellite = Depots::whereIn('GDE_LIBELLE', function($query) use ($idsatelitte) {
            $query->select('GA_Familleniv2')
                ->distinct()
                ->from('satellite')
                ->where('GA_FAMILLENIV1', $idsatelitte);
        })->get();
        return $tableauSatellite;

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

/*	    dd($idCategorie);
	    die();
 */
        //$souscat = DB::select('SELECT * FROM choix_cat WHERE cc_code IN (SELECT DISTINCT GA_Familleniv2 FROM articles WHERE GA_FAMILLENIV1="$idCategorie")', [$idCategorie]);
        
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
    
        /*try 
        {
            
            $articles = Articles::all();
           
            return view(view: 'qrcode', data: ['articles' => $articles]);
        }catch (\Exception $e) {
        //gerer les erreurs
            return view(view: 'qrcode', data: ['articles' => []])->with(key:'error', value: $e->getMessage());
        }*/


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


    
    public function pdfqrcode() 
    {
    
        $pdf = Pdf::loadView('pdfqrcode');
        return $pdf->download();

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

