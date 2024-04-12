<?php

namespace App\Http\Controllers;


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
    public function obtenirLocalisation()
    {
        $depots=Depots::all();
        return $depots;
    }

    public function obtenirCategorie()
    {
        $cat=Articles::all();
        return $cat;
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

