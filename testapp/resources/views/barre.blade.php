<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        
    


        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.relative{position:relative}.mx-auto{margin-left:auto;margin-right:auto}.mx-6{margin-left:1.5rem;margin-right:1.5rem}.ml-4{margin-left:1rem}.mt-16{margin-top:4rem}.mt-6{margin-top:1.5rem}.mt-4{margin-top:1rem}.-mt-px{margin-top:-1px}.mr-1{margin-right:0.25rem}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.h-16{height:4rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-5{height:1.25rem}.min-h-screen{min-height:100vh}.w-auto{width:auto}.w-16{width:4rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-5{width:1.25rem}.max-w-7xl{max-width:80rem}.shrink-0{flex-shrink:0}.scale-100{--tw-scale-x:1;--tw-scale-y:1;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.items-center{align-items:center}.justify-center{justify-content:center}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.self-center{align-self:center}.rounded-lg{border-radius:0.5rem}.rounded-full{border-radius:9999px}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity))}.bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}.from-gray-700\/50{--tw-gradient-from:rgb(55 65 81 / 0.5);--tw-gradient-to:rgb(55 65 81 / 0);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-transparent{--tw-gradient-to:rgb(0 0 0 / 0);--tw-gradient-stops:var(--tw-gradient-from), transparent, var(--tw-gradient-to)}.bg-center{background-position:center}.stroke-red-500{stroke:#ef4444}.stroke-gray-400{stroke:#9ca3af}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.text-center{text-align:center}.text-right{text-align:right}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.font-semibold{font-weight:600}.leading-relaxed{line-height:1.625}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);--tw-shadow-colored:0 25px 50px -12px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-gray-500\/20{--tw-shadow-color:rgb(107 114 128 / 0.2);--tw-shadow:var(--tw-shadow-colored)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-gray-900:hover{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.hover\:text-gray-700:hover{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}.focus\:rounded-sm:focus{border-radius:0.125rem}.focus\:outline:focus{outline-style:solid}.focus\:outline-2:focus{outline-width:2px}.focus\:outline-red-500:focus{outline-color:#ef4444}.group:hover .group-hover\:stroke-gray-600{stroke:#4b5563}.z-10{z-index: 10}@media (prefers-reduced-motion: no-preference){.motion-safe\:hover\:scale-\[1\.01\]:hover{--tw-scale-x:1.01;--tw-scale-y:1.01;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}}@media (prefers-color-scheme: dark){.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}.dark\:bg-red-800\/20{background-color:rgb(153 27 27 / 0.2)}.dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}.dark\:bg-gradient-to-bl{background-image:linear-gradient(to bottom left, var(--tw-gradient-stops))}.dark\:stroke-gray-600{stroke:#4b5563}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:shadow-none{--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.dark\:ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.dark\:ring-inset{--tw-ring-inset:inset}.dark\:ring-white\/5{--tw-ring-color:rgb(255 255 255 / 0.05)}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.group:hover .dark\:group-hover\:stroke-gray-400{stroke:#9ca3af}}@media (min-width: 640px){.sm\:fixed{position:fixed}.sm\:top-0{top:0px}.sm\:right-0{right:0px}.sm\:ml-0{margin-left:0px}.sm\:flex{display:flex}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 1024px){.lg\:gap-8{gap:2rem}.lg\:p-8{padding:2rem}}


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
            right: -10px; /* Décalage vers la gauche */
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
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .center {
            text-align: center;
        }
        .form-container {
            display: flex;
            /* Utiliser Flexbox pour aligner les éléments horizontalement */
        }
        .pourfiltre {
            text-align: center;
            display: flex;
            justify-content: center; /* Centrer horizontalement les éléments */
        }
        .selected {
        color: black; /* Couleur du texte en noir */

        
}
.pourcroix {
         color: red; /* Couleur du texte en rouge */

    }
        </style>
    </head>
    <body class="antialiased">






    <!-- Barre de navigation -->
    <div class="navbar">
        <a href="{{ route('gerestock') }}">
            <img src="{{ asset('image/Itemm.png') }}" alt="Logo"><!-- logo itemm -->
        </a>

        <div><!-- met option de ma barre de nivigation -->
            <a href="{{ route('localisation') }}">Définir Localisation</a>
            <a href="{{ route('statistique') }}">Statistiques</a>
            <a href="{{ route('synchronisation') }}">Synchroniser</a>
            <a href="{{ route('stocks') }}">Stocks</a>
            <a href="{{ route('qrcode') }}">QR-Codes</a>
            <a href="{{ route('toto') }}">Code-barres</a>
        </div>

        <!-- Menu déroulant Bootstrap --> <!-- a refaire -->
        <div class="dropdown">
            <img src="{{ asset('image/compte.png') }}" id="compteBtn" alt="Compte">
            <div class="dropdown-menu" aria-labelledby="compteBtn" id="menuDropdown">
                <li><a class="dropdown-item" id="dropdown-item">Michel</a></li>
                <li><a class="dropdown-item">Gestion d'inventaire</a></li>
                <li><button class="dropdown-item" id="deconnexionBtn">Déconnexion</button></li>
            </div>
        </div>
    </div>


    <!-- Contenu principal -->
    <div class="container mt-6">
        <div class="row justify-content-center">

            <!-- Formulaire de filtre -->
            <!-- catégorie -->
            <div class="pourfiltre col-md-12 mb-4">
                <form action="barre" method="POST" class="col-md-3 border border-dark">
                    @csrf
                    <select name="choix" class="form-select">
                        @foreach($options1 as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </form>

                <!-- sous-catégorie -->
                <form action="barre" method="POST" class="col-md-3 border border-dark">
                    @csrf
                    <select name="choix" class="form-select">
                        @foreach($options2 as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </form>

                <!-- sous-catégorie 2 -->
                <form action="barre" method="POST" class="col-md-3 border border-dark">
                    @csrf
                    <select name="choix" class="form-select">
                        @foreach($options3 as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </form>

                <!-- nom -->
                <form action="barre" method="POST" class="col-md-3 border border-dark">
                    @csrf
                    <select name="choix" class="form-select">
                        @foreach($options4 as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
            </div>


        <!-- Tableau dinamique -->
        <div class="container">
        <div class="col-md-12" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr><!-- les titres -->
                        <th>Nom Produit</th>
                        <th>Catégorie</th>
                        <th>Sous-Catégorie 1</th>
                        <th>Sous-Catégorie 2</th>
                        <th>Quantité</th>
                        <th>Satellite</th>
                        <th><a href="#" onclick="selectAll(); return false;" style="font-size: 30px;">&square;</a></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Boucle pour générer les lignes du tableau -->
                    <!-- contenue -->
                    @foreach($options1 as $value => $label)
                    <tr class="table-dark" style="border-width: 2px;">
                        <td class="text-black">{{ $value }}</td>
                        <td class="text-black">{{ $label }}</td>
                        <td class="text-black">{{ $value }}</td>
                        <td class="text-black">{{ $label }}</td>
                        <td class="text-black">{{ $value }}</td>
                        <td class="text-black">{{ $label }}</td>
                        <td class="text-black"><a href="#" onclick="individuel(this); return false;" style="font-size: 30px;">&square;</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

        </div>
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


<!-- 
<canvas id="barcode"></canvas>

<script>
    // Appel de la fonction pour générer le code-barres avec le texte "1234"
    generateBarcode('1234');

    // Fonction pour générer le code-barres
    function generateBarcode(text) {
        // Options pour le code-barres
        var opts = {
            bcid: 'code128',  // Type de code-barres
            text: text,       // Texte à encoder
            scale: 3,         // Échelle du code-barres
            height: 10,       // Hauteur du code-barres en millimètres
            includetext: true // Inclure le texte en-dessous du code-barres
        };

        // Générer le code-barres dans le canvas avec l'ID 'barcode'
        bwipjs.toCanvas('barcode', opts, function (err, canvas) {
            if (err) {
                // Gérer les erreurs ici
                console.error(err);
            } else {
                // Code-barres généré avec succès
                console.log('Code-barres généré avec succès.');
            }
        });
    }
</script>
-->

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
</html>
