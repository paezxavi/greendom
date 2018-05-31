<link href="{{asset('css/print.css')}}" rel="stylesheet">
<style>

table, th, td {
    text-align: center;
    border: 1px solid black;
    border-collapse: collapse;
}

.alignleft {
	float: left;
}
.alignright {
	float: right;
}

.clearFloat {
    clear:right;
}

</style>
<body>
    <div class="container">
        <img class="alignleft" src="http://www.greendom.eu/wp-content/uploads/2014/01/logo-n.png"> </img>
        <h1 class="alignright"style='color:green;'> Achat Catalogue </h1>
        <div style="clear:both"> </div>
        <br/>
        <br/>
        Rue de Genève 6 <br/>
        1225 Chêne-bourg <br/>
        Téléphone (+41) 22 556-02 59 <br/>
        Télécopie (+41) 22 556 02 58 <br/>
        TVA: CHE-237.588.037
        <p/>
        <br/>
        <br/>
        <br/>
        <br/>
        <div style="float: right"> {{$user->address}} </div>
        <div style="margin: 0 auto; width: 100px;"> <center> <strong> Expédier à : </strong> </center> </div>
        <br/>
        <br/>
        <div style="float: right"> {{$user->forename}} {{$user->name}} </div>
        <div style="margin: 0 auto; width: 200px;"> <center> <strong> À l'attention de : </strong> </center> </div>
        
        <br/>
        <h3> <strong> CONCERNE : </strong> Commande par catalogue </h3>
        <table width="100%">
            <thead>
                <tr>
                    <th style="background-color:green;color:white;width:15%">QUANTITE</th>
                    <th style="background-color:green;color:white;width:20%">Référence</th>
                    <th style="background-color:green;color:white;width:30%">DESCRIPTION</th>
                    <th style="background-color:green;color:white;width:20%">PRIX UNITAIRE</th>
                    <th style="background-color:green;color:white;width:15%">MONTANT</th>

                </tr>
            </thead>
            <tbody>
                @foreach($productArray as $products)
                    <tr>
                        <td>{{$products["quantite"]}}</td>
                        <td>
                            {{$products["reference"]}} <br/>
                            <img src={{$products["image"]}} height="60" width="60">
                        </td>
                        <td> <strong> {{$products["nom"]}} </strong> <br/>
                            <label> {{$products["description"]}} </label> </td>
                        <td>CHF {{$products["prix"]}}.- </td>
                        <td>
                        CHF {{intval($products["prix"]) * intval($products["quantite"])}}.- </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <small class="alignleft">
            2 ans de garantie sur nos ampoules - 5 ans de garantie sur nos tubes LED - 3 ans de garantie sur nos réglettes LED <br/>
            Conditions de paiement: 50% de la commande et le reste à la livraison
        </small>
        <table width="35%" align="right">
            <tr>
                <td style="width:20%"> SOUS-TOTAL ARRONDI </td>
                <td style="width:15%"> CHF {{$total}}.- </td>
            </tr>
            <tr>
                <td style="width:20%"> TAUX DE T.V.A  </td>
                <td style="width:15%"> 7.7% </td>
            </tr>
            <tr>
                <td style="width:20%"> T.V.A </td>
                <td style="width:15%"> CHF {{$tva}}.- </td>
            </tr>
            <tr>
                <th style="width:20%"> <strong> TOTAL </strong> </th>
                <td style="background-color:green;color:white;width:15%"> CHF {{intval($total) + intval($tva)}}.- </td>
            </tr>
        </table>
        <div style="clear:both"> </div>    
        <div>
            <br/><br/><br/><br/>
        </div>

        <div>
            <center> Paiement par virement bancaire à la société Greendom SA <br/>
            <b> GREENDOM SA - UBS - IBAN: CH36 0024 0240 1976 1401 T </b> <br/>
            Pour toute question concernant cette facture, veuillez nous contacter au 022 556 02 59, ou à info@greendom.eu
            <br/><br/><b> MERCI POUR VOTRE CONFIANCE ! </b> </center>
            <br/><br/>

            <p style="text-align:left;">
                <strong> Signature du client </strong>
                <span style="float:right;">
                    <strong> Signature Greendom SA </strong>
                </span>
            </p>
        </div>

      </div>
    </div>
</body>