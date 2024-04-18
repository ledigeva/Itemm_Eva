<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF avec tableau</title>
    <!-- Ajoutez ici les liens vers les fichiers CSS si nécessaire -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
</head>
<body>
    <h1>Tableau dans le PDF</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Code-Barre</th>
                <th>Code-Barre</th>
                <th>Code-Barre</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
            <tr>
                <td class="table-cell">
                    <img src="{{ public_path('image/Itemm.png') }}" width="80">  <b>Code-barre</b> <br>
                    <svg class="barcode"></svg>
                    <br>
                    Légende du code-barre
                </td>
                <td class="table-cell">
                    <img src="{{ public_path('image/Itemm.png') }}" width="80">  <b>Code-barre</b> <br>
                    <svg class="barcode"></svg>
                    <br>
                    Légende du code-barre
                </td>
                <td class="table-cell">
                    <img src="{{ public_path('image/Itemm.png') }}" width="80">   <b>Code-barre</b> <br>
                    <svg class="barcode"></svg>
                    <br>
                    Légende du code-barre
                </td>
            </tr>
            @endfor
        </tbody>
    </table>

    <!-- Script pour générer les codes-barres -->
<script>
    // Générer le code-barre pour chaque cellule
    document.querySelectorAll('.barcode').forEach(function(element) {
        JsBarcode(element, '1234', { // contenue du code-barre
            format: 'CODE128',
            width: 2,
            height: 40,
            displayValue: false
        });
    });
</script>

</body>
</html>
