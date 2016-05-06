<?php ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>modify article</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel-heading" style="text-align: center;">
                <h1>modify article</h1>
            </div>
        </div>
    </div>
    <?php if(isset($_POST['modify'])){
        $fichierxml = new DOMDocument('1.0', 'UTF-8');
        $fichierxml->load('article.xml');

        $liste = $fichierxml->getElementsByTagName('article');
        //var_dump($liste);
        foreach ($liste as $article)
            {
                $i=1;
                $titre = $article->getElementsByTagName('titre')->item(0);
                $auteur = $article->getElementsByTagName('auteur')->item(0);
                $contenu = $article->getElementsByTagName('contenu')->item(0);
        echo '
            <form action="index.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                    <div class="panel panel-default" >
                        <div class="form-group" style="margin: 4px">
                            <label for="titreArticle">Title</label>
                            <input type="text" name="titreArticle" class="form-control" id="titreArticle" value="',$titre->nodeValue,'">
                        </div>
                        <div class="form-group" style="margin: 4px">
                            <label for="nomAuteur">Writer name</label>
                            <input type="text" name="nomAuteur" class="form-control" id="nomAuteur" value="',$auteur->nodeValue,'">
                        </div>
                        <div class="form-group" style="margin: 4px">
                            <label for="contenu">Content</label>
                            <textarea class="form-control" name="contenu" id="contenu" placeholder="Content">',$contenu->nodeValue,'</textarea>
                        </div>';
    }
}
        ?>
    
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="text-align: right;">
        <button type="submit" class="btn btn-primary btn-xs" id="modify" name="modify">Modify</button>
        <button type="submit" class="btn btn-primary btn-xs" id="cancel" name="cancel">Cancel</button>
        </div>
    </div>
    </form>
</div>

</body>
</html>
