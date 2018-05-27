<link href="{{asset('css/print.css')}}" rel="stylesheet">
<style>
table {
    width:100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th {
    background-color: black;
    color: white;
}
</style>
<body>
    <div class="container">
     <div class="row">
        <img src="http://www.greendom.eu/wp-content/uploads/2014/01/logo-n.png"> </img>
        <h1> Achat Catalogue </h1>
      </div>
        Chemin du Pré-Fleuri 5 <br/>
        1228 Plan-Les-Ouates <br/>
        Téléphone (+41) 22 556-02 59 <br/>
        Télécopie (+41) 22 556 02 58 <br/>
        TVA: CHE-237.588.037
        <p/>
        <br/>
        <br/>
        <br/>

        <p align="right">
            À l'attention de<br/>
            <b> {{$user->forename}} {{$user->name}}</b><br/>
            {{$user->address}}
        </p>
        <br/>

        <br/>
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:25%">Produit</th>
                    <th style="width:25%">Description</th>
                    <th style="width:25%">Prix</th>
                    <th style="width:25%">Quantité</th>
                    <th style="width:25%">Total</th>

                </tr>
            </thead>
            <tbody>
                @foreach($productArray as $products)
                    <tr>
                        <td>{{$products["nom"]}}</td>
                        <td>{{$products["description"]}}</td>
                        <td>{{$products["prix"]}}</td>
                        <td>{{$products["quantite"]}}</td>
                        <td>{{intval($products["prix"]) * intval($products["quantite"])}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br/> <br/>

        <center> Merci d'effectuer le versement de votre acompte à: <br/>
        <b> GREENDOM SA - UBS - IBAN: CH36 0024 0240 1976 1401 T </b> <br/>
        Conditions de paiements: 50% à la commande, le solde à la livraison
        <br/><br/><b> MERCI POUR VOTRE CONFIANCE ! </b> </center>
        <br/><br/>
        <center> Pour toute question concernant cette facture, veuillez nous contacter au 022 556 02 59, ou à info@greendom.eu </center>
        <br/><br/>

        <p style="text-align:left;">
        Signature du client
        <span style="float:right;">Signature Greendom SA</span>
        </p>

      </div>
    </div>
</body>