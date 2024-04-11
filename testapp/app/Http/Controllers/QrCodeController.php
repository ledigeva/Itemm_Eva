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

    public function obtenirInformation()
    {
    
        /*try 
        {
            
            $articles = Articles::all();
           
            return view(view: 'qrcode', data: ['articles' => $articles]);
        }catch (\Exception $e) {
        //gerer les erreurs
            return view(view: 'qrcode', data: ['articles' => []])->with(key:'error', value: $e->getMessage());
        }*/


        $articles = DB::table('dispos')
        ->join('articles', 'dispos.GQ_ARTICLE', '=', 'articles.GA_CODEARTICLE')
        ->join('depots', 'dispos.GQ_DEPOT', '=', 'depots.GDE_DEPOT')
        ->get();
        return view(view: 'qrcode', data: ['articles' => $articles]);

        
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

