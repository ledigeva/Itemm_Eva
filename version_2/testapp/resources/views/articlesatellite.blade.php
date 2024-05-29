@extends('baseProjet')


@section('title', 'Index')


@section('content')
@csrf

<body>
    <!-- titre de la page !-->
    <h1 class="text-center">Visualisation des articles d'un Satellite</h1> 

<!-- Conteneur pour la liste déroulante et le texte -->
<div class="container d-flex ">
    <!-- Texte "Choisissez un satellite" -->

        <p>Choisissez un satellite - :</p>


    
    <!-- Liste déroulante -->
    <div class="border border-dark">
        <form id="satelliteForm" action="{{ route('qrcode') }}" method="GET">
            @csrf
            <select name="satellite" id="satellite" class="form-select">
                <option value="-1">Sélectionnez une localisation</option>
            </select>
        </form>
    </div>
</div>



    <!-- statistique ( forme camenbert )-->
    <div id="mon-chart" style="height: 500px; width: 800px;" ></div>

</div>
<!-- Importation de l'API AJAX Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	// Le code du Chart
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Satellite', 'Produits'],
      [ "{{ $info->name }}", {{ $info->GA_LIBELLE->count()  }} ], // Proportion des produits de la catégorie
    ]);

    var options = {
      title: 'Visualisation des article pour un satellite', // Le titre
      is3D : true // En 3D
    };

    // On crée le chart en indiquant l'élément où le placer "#mon-chart"
    var chart = new google.visualization.PieChart(document.getElementById('mon-chart'));

    // On désine le chart avec les données et les options
    chart.draw(data, options);
  }
</script>




</body>

<script>

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

</script>




@endsection

