<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 07/05/2016
 * Time: 23:31
 */?>
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
    <title>modified article</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel-heading" style="text-align: center;">
                <h1>Article modified with succes</h1>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['continue'])) {
    $id=$_POST['id'];
    $dom = new DOMDocument();
    $dom = modifyArticle($id);
    $dom->save("journal.xml");
}
function modifyArticle($id){
    $dom = new DOMDocument('1.0', 'UTF-8');
    $newdom = new DOMDocument('1.0', 'UTF-8');
    $dom->load('journal.xml');

    $liste = $dom->getElementsByTagName('article');
    $racine = $newdom->createElement('journal');
    $newdom->appendChild($racine);

    foreach ($liste as $article) {
        $titre = $article->getElementsByTagName('titre')->item(0);
        $auteur = $article->getElementsByTagName('auteur')->item(0);
        $contenu = $article->getElementsByTagName('contenu')->item(0);

        $articledom = $newdom->createElement('article');
        $racine->appendChild($articledom);

        if ($titre->nodeValue == $id) {
            $titre = $newdom->createElement('titre');
            $contenu_titre = $newdom->createTextNode($_POST['titreArticle']);
            $titre->appendChild($contenu_titre);
            $auteur = $newdom->createElement('auteur');
            $contenu_auteur = $newdom->createTextNode($_POST['nomAuteur']);
            $auteur->appendChild($contenu_auteur);
            $contenu = $newdom->createElement('contenu');
            $contenu_contenu = $newdom->createTextNode($_POST['contenu']);
            $contenu->appendChild($contenu_contenu);
            $articledom->appendChild($titre);
            $articledom->appendChild($auteur);
            $articledom->appendChild($contenu);
        } else {
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

