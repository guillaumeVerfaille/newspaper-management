<?php ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>ajouter un article</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel-heading" style="text-align: center;">
                <h1>Ajouter un article</h1>
            </div>
        </div>
    </div>
    <form action="index.php" method="POST">
    <div class="row">
        <div class="col-md-6">
        <div class="panel panel-default" >
            <div class="form-group" style="margin: 4px">
                <label for="titreArticle">Titre de l'article</label>
                <input type="text" name="titreArticle" class="form-control" id="titreArticle" placeholder="titre de l'article">
            </div>
            <div class="form-group" style="margin: 4px">
                <label for="nomAuteur">Nom de l'auteur</label>
                <input type="text" name="nomAuteur" class="form-control" id="nomAuteur" placeholder="nom de l'auteur">
            </div>
            <div class="form-group" style="margin: 4px">
                <label for="contenu">Contenu de l'article</label>
                <textarea class="form-control" name="contenu" id="contenu" placeholder="contenu de l'article"></textarea>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="text-align: right;">
        <button type="submit" class="btn btn-success btn-xs" id="valider" name="valider">valider</button>
        <button type="submit" class="btn btn-primary btn-xs" id="annuler" name="annuler">annuller</button>
        </div>
    </div>
    </form>
</div>

</body>
</html>
