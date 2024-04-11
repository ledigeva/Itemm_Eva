@extends('baseProjet')


@section('title', 'Index')


@section('content')
@csrf
<style>

.pourcroix {
color: red;
/* Couleur du texte en rouge */

}
</style>

<body>
<div class="container">
       <h1>QRCode</h1>
       <!-- Formulaire de filtre -->
       <div class="pourfiltre col-md-12 mb-4 d-flex justify-content-center"> <!-- Added flex class -->
           <!-- satelllite -->
           <form action="barre" method="POST" class="col-md-3 border border-dark">
    @csrf
    <select name="choix" class="form-select">
        @foreach($articles->unique('GDE_LIBELLE') as $article)
            <option value="{{ $article->GDE_LIBELLE }}">{{ $article->GDE_LIBELLE }}</option>
        @endforeach
    </select>
</form>

           <!-- catégorie -->
           <form action="barre" method="POST" class="col-md-3 border border-dark">
               @csrf
               <select name="choix" class="form-select">
               @foreach($articles->unique('GA_FAMILLENIV1') as $article)
               @if ($article->GA_FAMILLENIV1 !== null && $article->GA_FAMILLENIV1 !== '')
                    <option value="{{ $article->GA_FAMILLENIV1 }}">{{ $article->GA_FAMILLENIV1 }}</option>  
                    @endif                 
                    @endforeach
               </select>
           </form>
           <!-- sous-catégorie 1 -->
           <form action="barre" method="POST" class="col-md-3 border border-dark">
               @csrf
               <select name="choix" class="form-select">
               @foreach($articles->unique('GA_FAMILLENIV2') as $article)
               @if ($article->GA_FAMILLENIV2 !== null && $article->GA_FAMILLENIV2 !== '')
                    <option value="{{ $article->GA_FAMILLENIV2 }}">{{ $article->GA_FAMILLENIV2 }}</option>
                    @endif                  
                     @endforeach
               </select>
           </form>
           <!-- sous-catégorie 2 -->
           <form action="barre" method="POST" class="col-md-3 border border-dark">
               @csrf
               <select name="choix" class="form-select">
               @foreach($articles->unique('GA_FAMILLENIV3') as $article)
               @if ($article->GA_FAMILLENIV3 !== null && $article->GA_FAMILLENIV3 !== '')
                    <option value="{{ $article->GA_FAMILLENIV3 }}">{{ $article->GA_FAMILLENIV3 }}</option> 
                    @endif                  
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
                <th>id de la ligne invisible</th>
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
                        <td>{{ $article->GA_CODEARTICLE ? $article->GA_CODEARTICLE : 'N/A' }}</td> <!-- id -->
                        <td>{{ $article->GA_LIBELLE ? $article->GA_LIBELLE : 'N/A' }} </td> <!-- nom -->
                        <td>{{ $article->GA_FAMILLENIV1 ? $article->GA_FAMILLENIV1 : 'N/A' }}</td><!-- categorie -->
                        <td>{{ $article->GA_FAMILLENIV2 ? $article->GA_FAMILLENIV2 : 'N/A' }}</td><!-- sous cat -->
                        <td>{{ $article->GA_FAMILLENIV3 ? $article->GA_FAMILLENIV3 : 'N/A' }}</td><!-- sous catt -->
                        <td>{{ $article->GQ_PHYSIQUE ? $article->GQ_PHYSIQUE : 'N/A' }}</td><!-- quantité -->
                        <td>{{ $article->GDE_LIBELLE ? $article->GDE_LIBELLE : 'N/A' }}</td><!-- satellite -->
                        <!-- Tableau -->
                        <td class="text-black"><a href="#" onclick="individuel(this); return false;" style="font-size: 30px;">&square;</a></td>
                    </tr>
                @endforeach

            @endisset
        </tbody>
    </table>
</div>


<!-- Bouton pour générer le PDF + appele au cotroller -->
<div class="container d-flex justify-content-center align-items-center ">
<form action="{{ route('genepdfqrcode') }}" method="GET">
@csrf
<button type="submit" class="btn btn-primary mt-3">Générer PDF avec QRCode ( format pdf )</button>
</form>
</div>


@foreach($articles->take(1) as $article)
    <?php
    // Concaténation des informations
    $combinedInfo = '{idArt:'.$article->GQ_ARTICLE . ',idDepot:' . $article->GQ_DEPOT.'}';
    ?>
    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($combinedInfo)) !!}"/>
    <br><br>
@endforeach


</body>


<script>
   // JavaScript pour afficher ou masquer la liste déroulante au clic sur l'image de compte
   $(document).ready(function () {
       $("#compteBtn").click(function () {
           $("#menuDropdown").toggle(); // Afficher ou masquer la liste déroulante


       });


       // Initialisation de DataTables avec des options de filtre
       $('#myTable').DataTable({
           "paging": true, // Activer la pagination
           "searching": true, // Activer la recherche
           "ordering": true, // Activer le tri
           "info": true // Afficher les informations sur la pagination
       });


   });

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


@endsection