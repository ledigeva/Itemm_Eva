<?php

use App\Http\Controllers\ArticleSatelliteController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GenerateInvoiceController;
use App\Http\Controllers\PdfBarreController;
use App\Http\Controllers\QrCodeController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/toto',[BlogController::class,'obtenirInformationTableau'])->name('toto');

Route::get('genepdf', [PdfBarreController::class, 'generatePdf'])->name('genepdf');
Route::get('genepdfqrcode', [QrCodeController::class, 'genepagepdfqrcode', 'generateQRCode'])->name('genepdfqrcode');
Route::get('pdfbarre', [BlogController::class, 'afficher'])->name('pdfbarre');
//Route::get('generate-qrcode', [QrCodeController::class, 'generateQrCode'])->name('generate-code');

Route::get('/home',function () {
   // return "coucou";
   return view('welcome');
});

Route::get('/laravel', function () {
    return view('welcome');
});



// acceuil de gerer les stock ( eva ) premiere page
Route::get('/', function () {
    return view('accueil');    
})->name('gerestock');

// definire localisation ( theo )
Route::get('/localisation', function () {
    return view('localisation');
})->name('localisation');

// visualiser les statistiques ( Eva )
Route::get('/statistique', function () {
    return view('statistique');
})->name('statistique');

// synchronisation avec cegid
Route::get('/synchronisation', function () {
    return view('synchronisation');
})->name('synchronisation');

// visualiser les stocks
Route::get('/stocks', function () {
    return view('stocks');
})->name('stocks');

// articlesatellite
Route::get('/articleparsatellite', [ArticleSatelliteController::class,"obtenirInformationListe"])->name('articleparsat');
Route::get ('diagram', [ArticleSatelliteController::class, "obtenriDiagram" ])->name ('diagram');

// repartitionarticles
Route::get('/repartition', function () {
    return view('repartitionarticles');
})->name('repartition');

// generer qr code
Route::get('/qrcode', [QrCodeController::class,"obtenirInformationTableau"])->name('qrcode');



// generer code barre
//Route::get('/barre', function () {
//    return view('barre');
//})->name('barre');

Route::get('/obtenir-localisation', [QrCodeController::class, 'obtenirLocalisation'])->name('obtenir-localisation');
Route::get('/obtenir-categorie', [QrCodeController::class, 'obtenirCategorie'])->name('obtenir-categorie');
Route::get('/obtenir-sous-categorie/{idCategorie}', [QrCodeController::class, 'obtenirSousCategorie'])->name('obtenir-sous-categorie');
Route::get('/obtenir-sous-categorie2/{idCategorie2}', [QrCodeController::class, 'obtenirSousCategorie2'])->name('obtenir-sous-categorie2');
//pour tableau
Route::get('/obtenir-infos-articles', [QrCodeController::class, 'obtenirInfosArticles'])->name('obtenir-infos-articles');
Route::get('/filtre-tableau-satellite/{idSat}', [QrCodeController::class, 'filtreTableauSatellite'])->name('filtre-tableau-satellite');
Route::post('/generer-qrcode', [QrCodeController::class, 'genererQrCode'])->name('genererQrCode');