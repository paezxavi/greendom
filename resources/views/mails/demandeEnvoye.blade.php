<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    	<link href="../public/css/bulma.css" rel="stylesheet">
    </head>
    <body>
        <h2>Demande Spéciale</h2>
        <div>
            Madame, Monsieur
            </br>
            <p>Création d'une demande pour une commande spéciale du client {{$commande->users->name}} {{$commande->users->forename}}.</p>
            </br>
            <p>Accéder à la demande : <a href="http://192.168.10.10/#/commande/7/{{$commande->id}}">lien</a></p>
            <hr>
            Merci de ne pas répondre à ce message. Les réponses au mail envoyé à cette adresse ne sont pas acceptées.
        </div>
    </body>
</html>
