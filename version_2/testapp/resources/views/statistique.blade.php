@extends('baseProjet')


@section('title', 'Index')


@section('content')
@csrf

<body>
   <h1>statistique</h1>

   
<!-- Conteneur pour les deux boutons -->
<div class="container d-flex justify-content-center align-items-center">
    <!-- Bouton "Articles par Satellite" -->
    <div class="mr-2">
        <form action="{{ route('articleparsat') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-primary btn-lg mt-3">Articles par Satellite</button>
        </form>
    </div>
    
    <!-- Espace entre les deux boutons -->
    <div class="mx-2"></div>
    
    <!-- Bouton "Répartition des articles" -->
    <div>
        <form action="{{ route('repartition') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-primary btn-lg mt-3">Répartition des articles</button>
        </form>
    </div>
</div>







</body>




@endsection

