<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BILLET RESERVATION N°</title>
    <link rel="shortcut icon" href="vendors/images/logo.png" type="image/x-icon">
</head>
<body>


<div style="border: 1px solid #e2e2e2;border-radius: 5px">
    <table style="width: 100%;border-bottom: 1px solid #e2e2e2;">
        <tr>
            <td style="width: 120px;"><img src="vendors/images/logo.png" alt="" width="100"></td>
            <td style="text-align:center;">
                <span style="color: #f05a28">STM TRANSPORT VOYAGEUR NIGER SA</span>
                <br>
                <span>+227 92 28 13 97 / 74 70 49 50 / info@stm.ne</span>
                <br>
                <span
                    style="font-weight: bold;">Billet N°{{$params['reservation']->numBillet}}/{{$params['reservation']->trajet}}</span>
            </td>
            <td style="width: 120px;"><img src="vendors/images/logo.png" alt="" width="100"></td>
        </tr>
    </table>

    <table style="padding: 20px 10px 10px;width: 100%;">
        <tr>
            <td><span style="font-weight: bold;">Voyageur:</span> {{$params['reservation']->voyageur}}</td>
            <td><span style="font-weight: bold;">Bus:</span> {{  $params['reservation']->bus }}</td>
            <td><span style="font-weight: bold;">Billet:</span> {{  $params['reservation']->numBillet }}</td>
            <td><span style="font-weight: bold;">Siege:</span> {{  $params['reservation']->siege }}</td>
        </tr>
    </table>
    <table style="padding: 10px;width: 100%;">
        <tr>
            <td><span style="font-weight: bold;">Valise:</span> {{$params['reservation']->valise}}</td>
            <td><span style="font-weight: bold;">Sac:</span> {{  $params['reservation']->sac }}</td>
            <td><span style="font-weight: bold;">Colis:</span> {{  $params['reservation']->colis }}</td>
            <td><span style="font-weight: bold;">GYZ:</span> {{  $params['reservation']->gyz }}</td>
            <td><span style="font-weight: bold;">Type voyage:</span> {{$params['reservation']->alleRetour}}</td>
        </tr>
    </table>
    <table style="padding: 10px;width: 100%;">
        <tr>
            <td><span
                    style="font-weight: bold;">Date/Heure:</span> {{date('Y-m-d', $params['reservation']->datedepart->toDateTime()->getTimestamp())}} {{$params['reservation']->heureDepart}}
            </td>
            <td><span style="font-weight: bold;">Trajet:</span> {{  $params['reservation']->trajet }}</td>
            <td><span
                    style="font-weight: bold;">Forfait:</span> {{  \App\Helpers\NumberHelper\NumberHelper::CurrencyFormat($params['reservation']->montant) }}
            </td>
        </tr>
    </table>

    <table style="padding: 10px;width: 100%;">
        <tr>
            <td>
                <barcode code="978-0-9542246-0" type="ISBN" height="0.5" text="1"/>
            </td>
            <td style="text-align:center;">
                <span style="text-decoration:underline;">Signature voyageur</span>
                <br>
                {{$params['reservation']->voyageur}}
            </td>
            <td style="text-align:center;">
                <span style="text-decoration:underline;">Signature Agent</span>
                <br>
                {{$params['reservation']->agent}}
            </td>
        </tr>
    </table>
    <div style="border-top: 1px solid #e2e2e2;font-style: italic;padding: 5px 0;">
        <p style="font-size: .8em;padding: 0 10spx;">
            Veuillez conserver ce reçu jusqu’à votre date de départ. En cas de perte <b>STM Transport</b> dégage toutes responsabilité et remboursement.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo at voluptatum vero maiores sed, ab laborum suscipit autem placeat nihil laboriosam, ipsam, consectetur sint amet architecto ducimus neque facilis omnis.
        <b>Tiré le {{ date("d/m/Y H:i", time()) }} à Niamey - Niger</b>
        </p>
    </div>
</div>

<br>
<p style="border-bottom: 1px dashed #e2e2e2;"></p>
<br>

<div style="border: 1px solid #e2e2e2;border-radius: 5px">
    <table style="width: 100%;border-bottom: 1px solid #e2e2e2;">
        <tr>
            <td style="width: 120px;"><img src="vendors/images/logo.png" alt="" width="100"></td>
            <td style="text-align:center;">
                <span style="color: #f05a28">STM TRANSPORT VOYAGEUR NIGER SA</span>
                <br>
                <span>+227 92 28 13 97 / 74 70 49 50 / info@stm.ne</span>
                <br>
                <span
                    style="font-weight: bold;">Billet N°{{$params['reservation']->numBillet}}/{{$params['reservation']->trajet}}</span>
            </td>
            <td style="width: 120px;"><img src="vendors/images/logo.png" alt="" width="100"></td>
        </tr>
    </table>

    <table style="padding: 20px 10px 10px;width: 100%;">
        <tr>
            <td><span style="font-weight: bold;">Voyageur:</span> {{$params['reservation']->voyageur}}</td>
            <td><span style="font-weight: bold;">Bus:</span> {{  $params['reservation']->bus }}</td>
            <td><span style="font-weight: bold;">Billet:</span> {{  $params['reservation']->numBillet }}</td>
            <td><span style="font-weight: bold;">Siege:</span> {{  $params['reservation']->siege }}</td>
        </tr>
    </table>
    <table style="padding: 10px;width: 100%;">
        <tr>
            <td><span style="font-weight: bold;">Valise:</span> {{$params['reservation']->valise}}</td>
            <td><span style="font-weight: bold;">Sac:</span> {{  $params['reservation']->sac }}</td>
            <td><span style="font-weight: bold;">Colis:</span> {{  $params['reservation']->colis }}</td>
            <td><span style="font-weight: bold;">GYZ:</span> {{  $params['reservation']->gyz }}</td>
            <td><span style="font-weight: bold;">Type voyage:</span> {{$params['reservation']->alleRetour}}</td>
        </tr>
    </table>
    <table style="padding: 10px;width: 100%;">
        <tr>
            <td><span
                    style="font-weight: bold;">Date/Heure:</span> {{date('Y-m-d', $params['reservation']->datedepart->toDateTime()->getTimestamp())}} {{$params['reservation']->heureDepart}}
            </td>
            <td><span style="font-weight: bold;">Trajet:</span> {{  $params['reservation']->trajet }}</td>
            <td><span
                    style="font-weight: bold;">Forfait:</span> {{  \App\Helpers\NumberHelper\NumberHelper::CurrencyFormat($params['reservation']->montant) }}
            </td>
        </tr>
    </table>

    <table style="padding: 10px;width: 100%;">
        <tr>
            <td>
                <barcode code="978-0-9542246-0" type="ISBN" height="0.5" text="1"/>
            </td>
            <td style="text-align:center;">
                <span style="text-decoration:underline;">Signature voyageur</span>
                <br>
                {{$params['reservation']->voyageur}}
            </td>
            <td style="text-align:center;">
                <span style="text-decoration:underline;">Signature Agent</span>
                <br>
                {{$params['reservation']->agent}}
            </td>
        </tr>
    </table>
    <div style="border-top: 1px solid #e2e2e2;font-style: italic;padding: 5px 0;">
        <p style="font-size: .8em;padding: 0 10spx;">
            Veuillez conserver ce reçu jusqu’à votre date de départ. En cas de perte <b>STM Transport</b> dégage toutes responsabilité et remboursement.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo at voluptatum vero maiores sed, ab laborum suscipit autem placeat nihil laboriosam, ipsam, consectetur sint amet architecto ducimus neque facilis omnis.
        <b>Tiré le {{ date("d/m/Y H:i", time()) }} à Niamey - Niger</b>
        </p>
    </div>
</div>

</body>
</html>
