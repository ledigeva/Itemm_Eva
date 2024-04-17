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
       <div class="row">

       
        
        <!-- satelllite -->
            <form id="satelliteForm" action="{{ route('qrcode') }}" method="GET" class="row border border-dark">
            <div class="col-md-3">
            @csrf
             <select name="satellite" id="satellite" class="form-select">
             <option value="-1">Sélectionnez une localisation</option>
             </select>
        </div>

           
          
        <div class="col-md-3">
           <!-- catégorie -->
              
               <select name="categorie" id="categorie"class="form-select">
               <option value="-1">Sélectionnez une Categorie</option>
               </select>
               </div>


               <div class="col-md-3">
           <!-- sous-catégorie 1 -->
               <select name="sous_categorie1" id="sous_categorie1"class="form-select">
               <option value="-1">Sélectionnez une Sous-Categorie 1</option>
               </select>
               </div>


               <div class="col-md-3">
           <!-- sous-catégorie 2 -->
               <select name="sous_categorie2" id="sous_categorie2"class="form-select">
               <option value="-1">Sélectionnez une Sous-Categorie 2</option>
               </select>
               </div>
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
    var leDataTable=new DataTable('#myTable');
    
    function mettreAJourTableau()
    {
        console.log("maj table");
        
// detruire le datatable
        leDataTable.destroy();
        $('#myTable').empty();
        // Initialisation de DataTables avec des options de filtre
        leDataTable=new DataTable('#myTable');
        leDataTable.settings().init({
           "paging": true, // Activer la pagination
           "searching": true, // Activer la recherche
           "ordering": true, // Activer le tri
           "info": true // Afficher les informations sur la pagination
       }).draw();
        // Sélectionne toutes les listes déroulantes et ajoute un écouteur d'événements change
        var form = $(this).closest('form'); // Trouve le formulaire parent de la liste déroulante modifiée
        var url = form.attr('action'); // Récupère l'URL de l'action du formulaire
        var formData = form.serialize(); // Sérialise les données du formulaire

        // Effectue une requête GET au serveur avec les données du formulaire
        $.get(url, formData, function(response) {
            // Met à jour le contenu du tableau avec la réponse de la requête
            $('#myTable tbody').html(response);
        });
    }



    function remplirListeLocalisation()
    {
         // remplissage de la liste des localisation

       $.getJSON('{{ route("obtenir-localisation") }}')
       .done(function (donnees,stat,hxr){
            console.log("ok");
            $.each(donnees, function (index, ligne) {
                    // ligne contient un objet json de la forme
                    // {"idRegion" : "id de la region"},
                    // {"nomRegion" : "nom de la region"}                 
                    $("#satellite").append($('<option>', {value: ligne.GDE_DEPOT}).text(ligne.GDE_LIBELLE));
            });
        })
    }

    function remplirCategorie()
    {
    // remplissage de la liste des categorie

    $.getJSON('{{ route("obtenir-categorie") }}')
       .done(function (donnees,stat,hxr){
            console.log("ok");
            $.each(donnees, function (index, ligne) {
                    // ligne contient un objet json de la forme
                    // {"idRegion" : "id de la region"},
                    // {"nomRegion" : "nom de la region"}                 
                    $("#categorie").append($('<option>', {value: ligne.CC_CODE}).text(ligne.CC_LIBELLE));
            });

        })
    }

    function remplirSouscat()
    {
    // remplissage de la liste des categorie
    var idCat=$(this).val();
    console.log("remplir sous cat pour cat : "+idCat);
    
    $.getJSON('obtenir-sous-categorie/'+idCat )
       .done(function (donnees,stat,hxr){
            console.log("ok");
            $.each(donnees, function (index, ligne) {
                 
                    $("#sous_categorie1").append($('<option>', {value: ligne.CC_CODE}).text(ligne.CC_LIBELLE));
            });

        })
        .fail(function (xhr,text,error){
            console.log("param :"+JSON.stringify(hxr));
        });
    }




    function remplirSouscat2()
    {
    // remplissage de la liste des categorie
    var idCat=$(this).val();
    console.log("remplir sous cat 2 pour cat : "+idCat);

    $.getJSON('obtenir-sous-categorie2/'+idCat)
       .done(function (donnees,stat,hxr){
            console.log("ok");
            $.each(donnees, function (index, ligne) {
                                   
                    $("#sous_categorie2").append($('<option>', {value: ligne.CC_CODE}).text(ligne.CC_LIBELLE));
            });

        })
        .fail(function (xhr,text,error){
            console.log("param :"+JSON.stringify(hxr));
    });
    }

    
   // JavaScript pour afficher ou masquer la liste déroulante au clic sur l'image de compte
   $(document).ready(function () {

     // Attend que le document soit entièrement chargé
     //$('select').change(mettreAJourTableau);
    $("#categorie").change(remplirSouscat);

       $("#compteBtn").click(function () {
           $("#menuDropdown").toggle(); // Afficher ou masquer la liste déroulante


       });

      remplirListeLocalisation();
      remplirCategorie();
      remplirSouscat();
      remplirSouscat2();

        
        




        

        


       // Initialisation de DataTables avec des options de filtre
       /*leDataTable=$('#myTable').DataTable({
           "paging": true, // Activer la pagination
           "searching": true, // Activer la recherche
           "ordering": true, // Activer le tri
           "info": true // Afficher les informations sur la pagination
       });*/

       leDataTable.settings().init({
           "paging": true, // Activer la pagination
           "searching": true, // Activer la recherche
           "ordering": true, // Activer le tri
           "info": true // Afficher les informations sur la pagination
       }).draw();
   });

   var allSelected = false;

   function individuel(element) {
    if ($(element).hasClass('selected')) {
        $(element).removeClass('selected');
        $(element).html("&square;");
    } else {
        $(element).addClass('selected');
        $(element).html("<span class='pourcroix'>&#10005;</span>");
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
