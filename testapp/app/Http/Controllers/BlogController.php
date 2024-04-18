<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Depots;
use App\Models\Articles;
use App\Models\Choix_Cat;
use App\Models\Dispos;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Common\Mode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

//public function index(): Paginator
//{
//    return \App\Models\Post::paginate(25);
//}    

//public function show(string $slug, string $id): RedirectResponse | Post
//{
//    $post = \App\Models\Post::findOrFail($id);
//    if ($post->slug =! $slug) {
//    return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
//    }
//    return $post;
//}


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

return view('barre', data: ['articles' => $articles]);
}
}