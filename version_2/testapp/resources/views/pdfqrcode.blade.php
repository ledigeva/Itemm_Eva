
@extends('baseProjet')


@section('title', 'Index')


@section('content')
    @csrf
<!--    
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF avec tableau</title>
    
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
</head>
-->
<body>
    <h1>Tableau QRCode</h1>
<!--
    <table border="1">
        <thead>
            <tr>
                <th>qrcode</th>
                <th>qrcode</th>
                <th>qrcode</th>
                <th>qrcode</th>
                <th>qrcode</th>
                <th>qrcode</th>
            </tr>
        </thead>
        <tbody>
           
            <tr>
-->
                @foreach($boites as $boite)
   <!--             <td class="table-cell">
-->     
        <?php          $combinedInfo=json_encode($boite,JSON_PRETTY_PRINT);
        ?> 
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($combinedInfo)) !!}" />                    
                    &nbsp;&nbsp;
   <!--             </td>
                
            </tr>
-->
                @endforeach
   <!--     </tbody>

    </table>
    -->
    @endsection