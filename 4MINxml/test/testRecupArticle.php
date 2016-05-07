<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 07/05/2016
 * Time: 19:41
 */?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>test</title>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel-heading" style="text-align: center;">
                    <h1>Article deleted with succes</h1>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(isset($_POST['delete'])){
        $id=$_POST['id'];
        var_dump($_POST['id']);
        $dom = new DOMDocument();
        $dom = testRecup($_POST['id']);
        $dom->save('testRecup.xml');
    }
    function testRecup ($id){
        $dom = new DOMDocument('1.0', 'UTF-8');
        $newdom = new DOMDocument('1.0', 'UTF-8');
        $dom->load('article.xml');

        $liste = $dom->getElementsByTagName('article');
        $racine = $newdom->createElement('journal');
        $newdom->appendChild($racine);
        foreach ($liste as $article)
        {
            $titre = $article->getElementsByTagName('titre')->item(0);
            $auteur = $article->getElementsByTagName('auteur')->item(0);
            $contenu = $article->getElementsByTagName('contenu')->item(0);
            //var_dump($titre->nodeValue, $auteur->nodeValue,$contenu->nodeValue);
            if ($titre->nodeValue == $id){
                //echo ("c'est le même id");
            }
            else
            {
                //echo ("c'est pas le même");
                $articledom = $newdom->createElement('article');
                $racine->appendChild($articledom);

                $titredoc = $newdom->createElement('titre');
                $contenu_titre = $newdom->createTextNode($titre->nodeValue);
                $titredoc->appendChild($contenu_titre);

                $auteurdoc = $newdom->createElement('auteur');
                $contenu_auteur = $newdom->createTextNode($auteur->nodeValue);
                $auteurdoc->appendChild($contenu_auteur);

                $contenudoc = $newdom->createElement('contenu');
                $contenu_contenu = $newdom->createTextNode($contenu->nodeValue);
                $contenudoc->appendChild($contenu_contenu);

                $articledom->appendChild($titredoc);
                $articledom->appendChild($auteurdoc);
                $articledom->appendChild($contenudoc);
            }
        }
        return $newdom;
    }
    ?>
    <form action="index.php" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="panel-heading" style="text-align: center;">
                    <div class="form-group" style="margin: 6px;">
                        <button type="submit" class="btn btn-info" id="test">retour</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</head>
<body>

</body>
</html>
