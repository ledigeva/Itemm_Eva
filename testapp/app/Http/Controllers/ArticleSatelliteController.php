<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Depots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleSatelliteController extends Controller
{
    public function obtenirLocalisation()
    {
        $depots=Depots::all();
        return $depots;
    }

    public function obtenirInformationListe(Request $request)
    {
        $query = DB::table('dispos')
        ->join('articles', 'dispos.GQ_ARTICLE', '=', 'articles.GA_CODEARTICLE')
        ->join('depots', 'dispos.GQ_DEPOT', '=', 'depots.GDE_DEPOT');

    if ($request->filled('satellite')) {
        $query->where('depots.GDE_LIBELLE', $request->input('satellite'));
    }
    $articles = $query->get();

    // information contenue dans la liste
    return view('articlesatellite', data: ['articles' => $articles]);
    }

    public function obtenriDiagram(){
    
        //obtenir les articles pour 1 satellite

        $data = collect(); // Les données du diagramme


        $info = Articles::with("GA_LIBELLE")->get();

		// La vue "diagram"
		return view("articlesatellite", compact('info'));

    }
}