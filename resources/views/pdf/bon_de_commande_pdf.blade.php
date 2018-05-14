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

        <h1> {{$title}} </h1>
       </div>
        Rue de Genève 6 <br/>
        1225 Chêne-Bourg <br/>
        Téléphone +41 (0)22 556 02 59 <br/>
        Télécopie +41 (0)22 556 02 58 <br/>
        TVA: CHE-237.588.037
        <p/>
        <b>
        DATE : </b> 28 avril 2018 <br/>
        <b>N° de commande : </b> 12131231312
        </b>
        <br/>
        <br/>
        <br/>

        <center> <b> À l'attention de </b> </center>
        <p align="right">
          <b> Fournisseur xxx </b> <br/>
          Chemin François-Chavaz 123 <br/>
          1213 Onex
        </p>
        <br/>


        <p align="right">
            <b> À l'attention de </b><br/>
            {{$customer->name}} {{$customer->forename}}<br/>
            {{$customer->address}} <br/>
        </p>
        <br/>

        <br/>
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:20%">Produit</th>
                    <th style="width:60%">Description</th>
                    <th style="width:20%">Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->nom}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->pivot->quantity}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br/> <br/>

        
        <center> Pour toute question concernant cette commande, veuillez nous contacter au +41 (0)22 556 02 59, ou à info@greendom.eu </center>
        <br/><br/>

        <p style="text-align:left;">
        Signature du client
        <span style="float:right;">Signature Greendom SA</span>
        </p>

      </div>
    </div>
</body>
