<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Common\Mode;

class QrCodeController extends Controller
{
    public function affichageqrcode()
    {
        // Définition de la variable $options
        $options1 = [
            '1' => 'catégorie',
            '2' => 'catégorie',
            '3' => 'catégorie',
            '4' => 'catégorie',
            '5' => 'catégorie',
            '6' => 'catégorie',
            '7' => 'catégorie',
            '8' => 'catégorie',
            '9' => 'catégorie',
            '10' => 'catégorie',
            '11' => 'catégorie',
            '12' => 'catégorie',
            '13' => 'catégorie',
            '14' => 'catégorie',
            '15' => 'catégorie',
            '16' => 'catégorie',
            '17' => 'catégorie',
            '18' => 'catégorie',
            '19' => 'catégorie',
            '20' => 'catégorie',
            '21' => 'catégorie',
            '22' => 'catégorie',
            '23' => 'catégorie',
            '24' => 'catégorie',
        ];
        $options2 = [
            '1' => 'souscat',
            '2' => 'souscat',
            '3' => 'souscat',
            '4' => 'souscat',
        ];
        $options3 = [
            'catégorie' => 'souscatt',
            'souscat' => 'souscatt',
            'souscatt' => 'souscatt',
            'nom' => 'souscatt',
        ];$options4 = [
            'catégorie' => 'nom',
            'souscat' => 'nom',
            'souscatt' => 'nom',
            'nom' => 'nom',
        ];
        $options5 = [
            'catégorie' => 'quantité',
            'souscat' => 'quantité',
            'souscatt' => 'quantité',
            'nom' => 'quantité',
        ];


        // Rendre la vue en passant la variable $options
        return view('barre', ['options1' => $options1,
        'options2' => $options2,
        'options3' => $options3,
        'options4' => $options4]);
    }

}

