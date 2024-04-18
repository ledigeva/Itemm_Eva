<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Ajout des styles Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ajout du script jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Ajout du script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Ajout du script DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!--<link href="{{asset('style.css')}}" type="text/css" rel="stylesheet"/>-->
    <style>
               /* Style pour la barre de navigation */
       .navbar {
           overflow: visible;
           /* Autorise le dépassement */
           background-color: #681872;
           padding: 10px;
           display: flex;
           /* Utilisation de flexbox pour aligner les éléments */
           justify-content: space-between;
           /* Pour aligner l'image et le reste du contenu */
           align-items: center;
           /* Centrer verticalement les éléments */
       }

       /* Style pour les liens dans la barre de navigation */
       .navbar a {
           color: #f2f2f2;
           text-align: center;
           padding: 14px 20px;
           text-decoration: none;
       }

       /* Style pour l'image */
       .navbar img {
           height: 30px;
           margin-right: 10px;
           cursor: pointer;
           /* Ajout du curseur pointer */
           filter: brightness(0) invert(1);
       }

       .dropdown-menu {
           display: none;
           /* Cache initialement le menu déroulant */
           position: absolute;
           top: 100%;
           /* Positionner juste en dessous de l'élément parent */
           right: -10px;
           /* Décalage vers la gauche */
           z-index: 999;
           /* Assure que la liste déroulante soit au-dessus de tout autre contenu */
           max-width: 200px;
           /* Limiter la largeur de la liste déroulante */
       }

       /* Affiche le menu déroulant lorsque le bouton est survolé */
       .dropdown:hover .dropdown-menu {
           display: block;
       }

       /* Change la couleur du texte dans le menu déroulant */
       .dropdown-menu a {
           color: black;
       }

       .compteBtn {
           margin-left: 0px;
       }

       .dropdown-item:first-child {
           text-align: left;
       }

       body,
       html {
           height: 100%;
           margin: 0;
           padding: 0;
       }

       table {
           border-collapse: collapse;
           width: 100%;
           max-height: 100%;
       }

       th,
       td {
           border: 1px solid #000;
           /* Bordure d'une épaisseur de 1px */
           padding: 8px;
           text-align: left;
       }

       th {
           background-color: #f2f2f2;
       }

       tr:hover {
           background-color: #f5f5f5;
       }

       /* Style pour réduire la taille de l'image "yeux.png" */
       .small-image {
           height: 40px;
           /* Hauteur ajustée */
       }

       /* Style pour la section des boutons */
       .button-section {
           text-align: left;
           /* Alignement à gauche */
           margin-bottom: 10px;
       }

       .navbar {
           display: flex;
           align-items: center;
       }

       .button-section button {
           padding: 15px 30px;
           /* Ajustez la taille du bouton */
           margin: 0 5px;
           background-color: #975e5e;
           color: rgb(0, 0, 0);
           border: none;
           cursor: pointer;
           font-size: 16px;
           /* Ajustez la taille de la police */
           transform: scale(1);
           /* Agrandit les boutons de 10% */
       }

       .button-section button:hover {
           background-color: #ffffff;
       }

       /* Style pour la fermeture de l'image */
       .close-btn {
           position: absolute;
           top: 10px;
           right: 10px;
           cursor: pointer;
       }

       /* Style pour l'image */
       #petroleImageContainer,
       #planImageContainer {
           position: absolute;
           top: 50%;
           left: 50%;
           transform: translate(-50%, -50%);
           z-index: 9999;
           /* Assure que l'image est au-dessus de tout autre contenu */
           display: none;
           /* Cache initialement les images */
       }

       /* Style pour les images */
       #petroleImageContainer img,
       #planImageContainer img {
           width: 100%;
           height: auto;
       }


       .medium-image {
        height: 80px;
        /* Hauteur ajustée */
    }

    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-group label {
        width: 150px;
        text-align: right;
        margin-right: 10px;
    }

    .form-group input[type="text"] {
        flex: 1;
    }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="index" style="padding: 0%;"><img src="{{asset('img/Itemm.png')}}" alt="Logo"></a>
        <div>
            <!-- Modifiez le lien pour rediriger vers localisation.html -->
            <a href="{{ route('localisation') }}">Définir Localisation</a>
            <a href="{{ route('statistique') }}">Statistiques</a>
            <a href="{{ route('synchronisation') }}">Synchroniser</a>
            <a href="{{ route('stocks') }}">Stocks</a>
            <a href="{{ route('qrcode') }}">QR-Codes</a>
            <a href="{{ route('toto') }}">Code-barres</a>

        </div>
        <!-- Menu déroulant Bootstrap -->
        
    </div>

    @yield('content')
</body>
</html>