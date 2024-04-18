@extends('baseProjet')


@section('title', 'Index')


@section('content')
@csrf




<body>
    <style>
        .pourcroix {
            color: red;
            /* Couleur du texte en rouge */

        }
    </style>
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

                    <select name="categorie" id="categorie" class="form-select">
                        <option value="-1">Sélectionnez une Categorie</option>
                    </select>
                </div>


                <div class="col-md-3">
                    <!-- sous-catégorie 1 -->
                    <select name="sous_categorie1" id="sous_categorie1" class="form-select">
                        <option value="-1">Sélectionnez une Sous-Categorie 1</option>
                    </select>
                </div>


                <div class="col-md-3">
                    <!-- sous-catégorie 2 -->
                    <select name="sous_categorie2" id="sous_categorie2" class="form-select">
                        <option value="-1">Sélectionnez une Sous-Categorie 2</option>
                    </select>
                </div>
            </form>
        </div>
    </div>



    <!-- Tableau dynamique -->
    <div class="container">
        <table id="myTable">
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
    $combinedInfo = '{idArt:' . $article->GQ_ARTICLE . ',idDepot:' . $article->GQ_DEPOT . '}';
    ?>
    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($combinedInfo)) !!}" />
    <br><br>
    @endforeach


</body>


<script>
   // var leDataTable = new DataTable('#myTable');

   function afficherTableau() {
    console.log("dans afficher tableau"); 
    $.getJSON('obtenir-infos-articles')
        .done(function(donnees, stat, hxr) {
            console.log("je suis le tableau");

            donnees = donnees.filter(function(item) {
                return item.date !== -1;
            });

            $('#myTable').DataTable({
                "data": donnees,
                "columns": [{
                        title: "id de la ligne invisible",
                        data: 'id', 
                        name : 'id'
                    },
                    {
                        title: "Nom Produits",
                        data: 'produit', name : 'produit'
                    },
                    {
                        title: "Catégorie",
                        data: 'cat', name : 'cat'
                    },
                    {
                        title: "Sous catégorie 1",
                        data: 'scat1', name : 'scat1'
                    },
                    {
                        title: "Sous catégorie 2",
                        data: 'scat2', name : 'scat2'
                    },
                    {
                        title: "Quantité",
                        data: 'qte', name : 'qte'
                    },
                    {
                        title: "Satellite",
                        data: 'sat', name : 'sat'
                    },
                    {
                        title: '<a href="#" onclick="selectAll(); return false;" style="font-size: 30px;"> &square; </a>',
                        data: 'coche', name : 'coche'
                    }
                ],
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent",
                },
            });
        })
        .fail(function(xhr, text, error) {
            console.log("Erreur lors de la récupération des données : " + error);
        });
}

/*
    function mettreAJourTableau() {
        console.log("maj table");

        // detruire le datatable
        leDataTable.destroy();
        $('#myTable').empty();
        // Initialisation de DataTables avec des options de filtre
        leDataTable = new DataTable('#myTable');
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
    }*/



    function remplirListeLocalisation() {
        // remplissage de la liste des localisation

        $.getJSON('{{ route("obtenir-localisation") }}')
            .done(function(donnees, stat, hxr) {
                console.log("ok");
                $.each(donnees, function(index, ligne) {
                    // ligne contient un objet json de la forme
                    // {"idRegion" : "id de la region"},
                    // {"nomRegion" : "nom de la region"}                 
                    $("#satellite").append($('<option>', {
                        value: ligne.GDE_DEPOT
                    }).text(ligne.GDE_LIBELLE));
                });
            })
            .fail(function(xhr, text, error) {
                console.log("param :" + JSON.stringify(hxr));
            });
    }


    function remplirCategorie() {

        $.getJSON('{{ route("obtenir-categorie") }}')
            .done(function(donnees, stat, hxr) {
                console.log("ok");
                $.each(donnees, function(index, ligne) {
                    // ligne contient un objet json de la forme
                    // {"idRegion" : "id de la region"},
                    // {"nomRegion" : "nom de la region"}                 
                    $("#categorie").append($('<option>', {
                        value: ligne.CC_CODE
                    }).text(ligne.CC_LIBELLE));
                });

            })
            .fail(function(xhr, text, error) {
                console.log("param :" + JSON.stringify(hxr));
            });
    }



    function remplirSouscat() {
        // remplissage de la liste des categorie
        var idCat = $(this).val();
        console.log("remplir sous cat pour cat : " + idCat);
        // vider la liste des sous categories sauf la premiere ligne
        $("#sous_categorie1").find('option').not(':first').remove();

        $.getJSON('obtenir-sous-categorie/' + idCat)
            .done(function(donnees, stat, hxr) {
                console.log("ok");
                $.each(donnees, function(index, ligne) {

                    $("#sous_categorie1").append($('<option>', {
                        value: ligne.CC_CODE
                    }).text(ligne.CC_LIBELLE));
                });

            })
            .fail(function(xhr, text, error) {
                console.log("param :" + JSON.stringify(hxr));
            });
    }

    // Permet de rignitialiser sous cat 2 a chaque fois que je change d'sous cat 1

    document.getElementById("sous_categorie1").addEventListener("change", function() {
        // Récupérer l'élément de la liste déroulante de sous-catégories
        var selectElement = document.getElementById("sous_categorie2");

        // Supprimer tous les éléments enfants, sauf le premier
        while (selectElement.children.length > 1) {
            selectElement.removeChild(selectElement.children[1]);
        }
    });


    function remplirSouscat2() {
        // remplissage de la liste des categorie
        var idCat = $(this).val();
        console.log("remplir sous cat 2 pour cat : " + idCat);
        // vider la liste des sous categories sauf la premiere ligne
        $("#sous_categorie2").find('option').not(':first').remove();
        $.getJSON('obtenir-sous-categorie2/' + idCat)
            .done(function(donnees, stat, hxr) {
                console.log("ok");
                $.each(donnees, function(index, ligne) {

                    $("#sous_categorie2").append($('<option>', {
                        value: ligne.CC_CODE
                    }).text(ligne.CC_LIBELLE));
                });

            })
            .fail(function(xhr, text, error) {
                console.log("param :" + JSON.stringify(hxr));
            });
    }


    // JavaScript pour afficher ou masquer la liste déroulante au clic sur l'image de compte
    $(document).ready(function() {

        // Attend que le document soit entièrement chargé
        //$('select').change(mettreAJourTableau);
        $("#categorie").change(remplirSouscat);
        $("#sous_categorie1").change(remplirSouscat2);

        $("#compteBtn").click(function() {
            $("#menuDropdown").toggle(); // Afficher ou masquer la liste déroulante


        });

        remplirListeLocalisation();
        remplirCategorie();
        afficherTableau();
        //remplirSouscat();
        //remplirSouscat2();

        // Initialisation de DataTables avec des options de filtre
        /*leDataTable=$('#myTable').DataTable({
            "paging": true, // Activer la pagination
            "searching": true, // Activer la recherche
            "ordering": true, // Activer le tri
            "info": true // Afficher les informations sur la pagination
        });*/
/*
        leDataTable.settings().init({
            "paging": true, // Activer la pagination
            "searching": true, // Activer la recherche
            "ordering": true, // Activer le tri
            "info": true // Afficher les informations sur la pagination
        }).draw();
        */
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
