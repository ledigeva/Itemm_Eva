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

public function afficher()
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
