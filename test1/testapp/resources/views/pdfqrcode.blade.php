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
    <h1>Tableau QRCode</h1>

    <table border="1">
        <thead>
            <tr>
                <th>qrcode</th>
                <th>qrcode</th>
                <th>qrcode</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
            <tr>
                <td class="table-cell">
                    <img src="{{ public_path('image/Itemm.png') }}" width="80">  <b>QRCode</b> <br>

                    <br>
                    Légende du QRCode
                </td>
                <td class="table-cell">
                    <img src="{{ public_path('image/Itemm.png') }}" width="80">  <b>QRCode</b> <br>

                    <br>
                    Légende du QRCode
                </td>
                <td class="table-cell">
                    <img src="{{ public_path('image/Itemm.png') }}" width="80">   <b>QRCode</b> <br>

                    <br>
                    Légende du QRCode
                </td>
            </tr>
            @endfor
        </tbody>
    </table>