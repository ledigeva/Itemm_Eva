<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfBarreController extends Controller
{
    //
    public function generatePdf()
    {
    
    $pdf = Pdf::loadView('pdfbarre');
    return $pdf->download();
    }
}