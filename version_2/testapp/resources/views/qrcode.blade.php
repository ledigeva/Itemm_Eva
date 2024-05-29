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
        <form>
            <div class="container">
                <table id="myTable">
                </table>
            </div>
        </form>



        <!-- Bouton pour générer le PDF + appele au cotroller -->
        <div class="container d-flex justify-content-center align-items-center ">
            <form action="{{ route('genepdfqrcode') }}" method="GET">
                @csrf
                <!--  <button type="submit" class="btn btn-primary mt-3" id="genPdf" >Générer PDF avec QRCode ( format pdf )</button>-->
                <div class="btn btn-primary mt-3" id="genPdf">Générer PDF avec QRCode</div> 
            </form>
        </div>
 
        <script>





</script>


        @foreach ($articles->take(1) as $article)
            <?php
            // Concaténation des informations
            $combinedInfo = '{idArt:' . $article->GQ_ARTICLE . ',idDepot:' . $article->GQ_DEPOT . '}';
            ?>
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($combinedInfo)) !!}" />
            <br><br>
        @endforeach


    </body>


    <script>
        function afficherTableau() {
            console.log("dans afficher tableau");
            $.getJSON('obtenir-infos-articles')
                .done(function(donnees, stat, hxr) {
                    console.log("je suis le tableau");

                    $('#myTable').DataTable({
                        "data": donnees,
                        "columns": [{
                                title: "id de la ligne invisible",
                                data: 'id',
                                name: 'id',
                                visible: false
                            },
                            {
                                title: "Nom Produits",
                                data: 'produit',
                                name: 'produit'
                            },
                            {
                                title: "Catégorie",
                                data: 'cat',
                                name: 'cat'
                            },
                            {
                                title: "Sous catégorie 1",
                                data: 'scat1',
                                name: 'scat1'
                            },
                            {
                                title: "Sous catégorie 2",
                                data: 'scat2',
                                name: 'scat2'
                            },
                            {
                                title: "Quantité",
                                data: 'qte',
                                name: 'qte'
                            },
                            {
                                title: "Satellite",
                                data: 'sat',
                                name: 'sat'
                            },
                            {
                                title: '<input type="checkbox" onclick="selectAll();" id="selAll" />',
                                data: 'coche',
                                name: 'coche',
                                sortable: false
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


        function majTableauSat() {
            console.log("maj table selon satelitte");
            var idSat = $(this).val();
            if (idSat != -1) {
                $.getJSON('filtre-tableau-satellite/' + idSat)
                    .done(function(donnees, stat, hxr) {
                        console.log("ok");
                        $('#myTable').DataTable().clear().destroy();
                        $('#myTable').DataTable({
                            "data": donnees,
                            "columns": [{
                                    title: "id de la ligne invisible",
                                    data: 'id',
                                    name: 'id',
                                    visible: false
                                },
                                {
                                    title: "Nom Produits",
                                    data: 'produit',
                                    name: 'produit'
                                },
                                {
                                    title: "Catégorie",
                                    data: 'cat',
                                    name: 'cat'
                                },
                                {
                                    title: "Sous catégorie 1",
                                    data: 'scat1',
                                    name: 'scat1'
                                },
                                {
                                    title: "Sous catégorie 2",
                                    data: 'scat2',
                                    name: 'scat2'
                                },
                                {
                                    title: "Quantité",
                                    data: 'qte',
                                    name: 'qte'
                                },
                                {
                                    title: "Satellite",
                                    data: 'sat',
                                    name: 'sat'
                                },
                                {
                                    title: '<input type="checkbox" onclick="selectAll();" id="selAll" />',
                                    data: 'coche',
                                    name: 'coche',
                                    sortable: false
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
                        console.log("param :" + JSON.stringify(hxr));
                    });

            }
        }

        function selectAll() {
            console.log("check/uncheck");
            if ($("#selAll").prop('checked')) {
                console.log("check");
                $('#myTable').find('tbody tr').each(function() {
                    $(this).find('td:last input[type="checkbox"]').prop('checked', true);
                });
            } else {
                console.log("uncheck");
                $('#myTable').find('tbody tr').each(function() {
                    $(this).find('td:last input[type="checkbox"]').prop('checked', false);
                });
            }

        }

        function remplirListeLocalisation() {
            // remplissage de la liste des localisation

            $.getJSON('{{ route("obtenir-localisation") }}')
                .done(function(donnees, stat, hxr) {
                    console.log("ok");
                    $.each(donnees, function(index, ligne) {
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

        

        function genererPdf() {
            var boites = [];
            $('#myTable').DataTable().rows().every(function(rowIdx, tableLoop, rowLoop) {

                var checkbox = this.node().childNodes[6]
                .firstChild; // on recupere le contenu de la derniere colonne (la 7 ieme visible)
                console.log("je passe ici 1");
                if ($(checkbox).prop('checked')) { // est elle cochee ?
                    var colonneCache = $('#myTable').DataTable().row(rowIdx).data()
                    .id; // on recupere le contenu de la colonne id correspondant à la ligne cochee
                    // id est le nom de la colonne cachee
                    boites.push(colonneCache); // on ajoute au tableau 


                    console.log("je passe ici 2");

                    //$.get('genepdfqrcode');
                    //action="{{ route('genepdfqrcode') }}";
                    


                }

            });
            console.log(boites);
            $.ajax({
                type: "POST",
                url: "{{ route('genererQrCode') }}", // URL de la méthode dans le contrôleur
                data: {
                    boites: boites,
                    "_token": "{{ csrf_token() }}" // Ajouter le jeton CSRF

                }, // Les données à envoyer
                success: function(response) {
                    // Gérer la réponse du serveur si nécessaire
                    console.log("QR codes générés avec succès !");
                },
                error: function(xhr, status, error) {
                    // Gérer les erreurs si nécessaire
                    console.error("Erreur lors de la génération des QR codes :", error);
                }
            });

        }


        $(document).ready(function() {


            $("#categorie").change(remplirSouscat);
            $("#sous_categorie1").change(remplirSouscat2);
            $("#compteBtn").click(function() {
                $("#menuDropdown").toggle(); // Afficher ou masquer la liste déroulante
            });
            //$("#satellite").change(majTableauSat);
            $(document).on("change", "#satellite", majTableauSat);
            $("#genPdf").click(genererPdf);

            remplirListeLocalisation();
            remplirCategorie();
            afficherTableau();


        });
    </script>


@endsection