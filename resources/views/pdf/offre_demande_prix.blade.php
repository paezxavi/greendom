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
        <h1 class="alignright"style='color:green;'> {{$demandePrix}} </h1>
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
        <div style="float: right"> {{$prov->adresse}} </div>
        <div style="margin: 0 auto; width: 100px;"> <center> <strong> Expédier à : </strong> </center> </div>
        <br/>
        <br/>
        <div style="float: right"> {{$prov->nom}} </div>
        <div style="margin: 0 auto; width: 200px;"> <center> <strong> À l'attention de : </strong> </center> </div>
        
        <br/>
        <h3> <strong> CONCERNE : </strong> demande de prix </h3>
        <table width="100%">
            <thead>
                <tr>
                    <th style="background-color:green;color:white;width:15%">QUANTITE</th>
                    <th style="background-color:green;color:white;width:25%">Référence</th>
                    <th style="background-color:green;color:white;width:60%">DESCRIPTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arrPr as $prod)
                    <tr>
                        <td>{{$prod[0]['quantity']}}</td>
                        <td>
                            {{$prod["reference"]}} <br/>
                            <img src={{$prod["image"]}} height="60" width="60">
                        </td>
                        <td> <strong> {{$prod["nom"]}} </strong> <br/>
                            <label> {{$prod["description"]}} </label> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  
        <div>
            <br/><br/><br/><br/>
        </div>

        <div>
            <p style="text-align:left;">
                <strong> Signature du fournisseur </strong>
                <span style="float:right;">
                    <strong> Signature Greendom SA </strong>
                </span>
            </p>
        </div>

      </div>
    </div>
</body>