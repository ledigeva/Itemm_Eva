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


    public function obtenirInformationVueBarre(Request $request)
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

    if ($request->filled('satellite')) {
        $query->where('depots.GDE_LIBELLE', $request->input('satellite'));
    }

    if ($request->filled('categorie')) {
        $query->where('articles.GA_FAMILLENIV1', $request->input('categorie'));
    }

    if ($request->filled('sous_categorie1')) {
        $query->where('articles.GA_FAMILLENIV2', $request->input('sous_categorie1'));
    }

    if ($request->filled('sous_categorie2')) {
        $query->where('articles.GA_FAMILLENIV3', $request->input('sous_categorie2'));
    }

    $articles = $query->get();

    return view('barre', data: ['articles' => $articles]);
}

}