@extends('baseProjet')


@section('title', 'Index')


@section('content')
@csrf




   <style>

        

.pourcroix {
         color: red; /* Couleur du texte en rouge */

    }
        </style>
    </head>
    <body>
   <h1>statistique cat sous cat sous catt nom</h1> 

    <div class="container">

       <!-- Formulaire de filtre -->
       <div class="pourfiltre col-md-12 mb-4 d-flex justify-content-center"> <!-- Added flex class -->
           <!-- satelllite -->
           <form action="barre" method="POST" class="col-md-3 border border-dark">
               @csrf
               <select name="choix" class="form-select">
                   @foreach(\App\Models\Depots::pluck('GDE_LIBELLE') as $satellite)
                       <option value="{{ $satellite }}">{{ $satellite }}</option>
                   @endforeach
               </select>
           </form>
           <!-- catégorie -->
           <form action="barre" method="POST" class="col-md-3 border border-dark">
               @csrf
               <select name="choix" class="form-select">
                   @foreach(\App\Models\Articles::pluck('GA_FAMILLENIV1') as $categorie)
                       <option value="{{ $categorie }}">{{ $categorie }}</option>
                   @endforeach
               </select>
           </form>
           <!-- sous-catégorie 1 -->
           <form action="barre" method="POST" class="col-md-3 border border-dark">
               @csrf
               <select name="choix" class="form-select">
                   @foreach(\App\Models\Articles::pluck('GA_FAMILLENIV2') as $souscat)
                       <option value="{{ $souscat }}">{{ $souscat }}</option>
                   @endforeach
               </select>
           </form>
           <!-- sous-catégorie 2 -->
           <form action="barre" method="POST" class="col-md-3 border border-dark">
               @csrf
               <select name="choix" class="form-select">
                   @foreach(\App\Models\Articles::pluck('GA_FAMILLENIV3') as $souscatt)
                       <option value="{{ $souscatt }}">{{ $souscatt }}</option>
                   @endforeach
               </select>
           </form>
       </div>
   </div>

<!-- Tableau dynamique -->
    <div class="container">
       <table id="myTable">
           <thead>
               <tr>
                   <th class="text-center">Nom Produits</th>
                   <th class="text-center">Catégorie</th>
                   <th class="text-center">Sous catégorie 1</th>
                   <th class="text-center">Sous catégorie 2</th>
                   <th class="text-center">Quantité</th>
                   <th class="text-center">Satellite</th>
                   <th><a href="#" onclick="selectAll(); return false;" style="font-size: 30px;">&square;</a></th>
               </tr>
           </thead>
           <tbody>


               @isset($articles)
                   @foreach($articles as $article)
                       <tr>
       
                       <td>{{ isset($article['GA_CODEARTICLE']) ? $article['GA_CODEARTICLE'] : 'N/A' }}</td>
                           <td>{{ isset($article['GA_LIBELLE']) ? $article['GA_LIBELLE'] : 'N/A' }}</td>
                           <td>{{ isset($article['GA_FAMILLENIV1']) ? $article['GA_FAMILLENIV1'] : 'N/A' }}</td>
                           <td>@if ($article['GA_FAMILLENIV2'] != null) {{ $article['GA_FAMILLENIV2'] }} @else N/A @endif</td>
                           <td>@if ($article['GA_FAMILLENIV3'] != null) {{ $article['GA_FAMILLENIV3'] }} @else N/A @endif</td>
                   
                       </tr>
                   @endforeach
               @endisset
           </tbody>
       </table>
   </div>





    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-veM6F/5soP0/pIjVgqcbz3oNtx0QZOoxxZJjK+C9xyn9li0kFfJWPLblS6+U4fo3"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shCk5KVYdW5Ckx3SxIKZh8+0pD2jmkE0rPD7L"
        crossorigin="anonymous"></script>
    
    <script>
    var allSelected = false;

    function individuel(element) {
    if (element.classList.contains('selected')) {
        element.classList.remove('selected');
        element.innerHTML = "&square;"; // Réinitialise le carré à sa forme originale
    } else {
        element.classList.add('selected');
        element.innerHTML = "<span class='pourcroix'>&#10005;</span>"; // Affiche une croix rouge lorsqu'il est sélectionné
    }
}

function selectAll() {
    allSelected = !allSelected;
    var squares = document.querySelectorAll("tbody tr td:last-child a");
    squares.forEach(function(square) {
        if (allSelected) {
            square.classList.add('selected');
            square.innerHTML = "<span class='pourcroix'>&#10005;</span>"; // Affiche une croix rouge pour chaque carré sélectionné
        } else {
            square.classList.remove('selected');
            square.innerHTML = "&square;"; // Réinitialise chaque carré à sa forme d'origine
        }
    });
}
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="container d-flex justify-content-center align-items-center ">
    <!-- Bouton pour générer le PDF + appele au cotroller -->
    <form action="{{ route('genepdf') }}" method="GET">
        @csrf
        <button type="submit" class="btn btn-primary mt-3" style="color: black;">Générer PDF avec Code-barres</button>
    </form>
</div>




<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

<svg class="barcode"></svg>
    <!-- Script pour générer les codes-barres -->
    <script>
    // Générer le code-barre pour chaque cellule
    document.querySelectorAll('.barcode').forEach(function(element) {
        JsBarcode(element, 'gourgandine', { // contenue du code-barre
            format: 'CODE128',
            width: 2,
            height: 40,
            displayValue: false
        });
    });



</script>




</body>




@endsection