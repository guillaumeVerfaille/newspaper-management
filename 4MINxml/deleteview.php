<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 07/05/2016
 * Time: 22:14
 */
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>deleted article</title>
</head>
<body>
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
    //quand un article doit être supprimé
    if(isset($_POST['delete'])){
        $id=$_POST['id'];
        $dom = new DOMDocument();
        $dom = deleteArticle($_POST['id']);
        $dom->save('journal.xml');
    }
    function deleteArticle ($id){
        $dom = new DOMDocument('1.0', 'UTF-8');
        $newdom = new DOMDocument('1.0', 'UTF-8');
        $dom->load('journal.xml');

        $liste = $dom->getElementsByTagName('article');
        $racine = $newdom->createElement('journal');
        $newdom->appendChild($racine);
        foreach ($liste as $article)
        {
            $titre = $article->getElementsByTagName('titre')->item(0);
            $auteur = $article->getElementsByTagName('auteur')->item(0);
            $contenu = $article->getElementsByTagName('contenu')->item(0);
            //var_dump($titre->nodeValue, $auteur->nodeValue,$contenu->nodeValue);
            //pour l'article qui doit être supprimer, rien n'est réécrit dans le DomDocument
            if ($titre->nodeValue == $id){
                //echo ("c'est le même id");
            }
            else //pour les autres article, leur contenu est réécrit dans le DomDocument
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
                        <button type="submit" class="btn btn-info" id="back">back</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
