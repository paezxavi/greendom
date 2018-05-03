<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    	<link href="../public/css/bulma.css" rel="stylesheet">
    </head>
    <body>
        <h2>Achat</h2>
        <div>
            Madame, Monsieur
            </br>
            <p>Le client {{$user->name}} {{$user->forename}} a passé commande depuis le catalogue.</p>
            </br>
            <p>Les articles sélectionnés sont ci-joint à ce mail</p>
            <hr>
            Merci de ne pas répondre à ce message. Les réponses au mail envoyé à cette adresse ne sont pas acceptées.
        </div>
    </body>
</html>
