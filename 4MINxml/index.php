<?php 
session_start();
//pour executer et afficher les erreurs du programme: exec(command 2>&1);
//var_dump($_POST['delete']);
if(isset($_POST['validate'])){
    $dom = creatArticle();
    $dom->save("journal.xml");
    unset($_POST['validate']);
}/*
elseif (isset($_POST['modify'])) {
    $dom = modifyArticle();
    $dom->save("journal.xml");
    unset($_POST['modify']);
}*/
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>gestion du journal</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel-heading" style="text-align: center;">
                <h1>Journal</h1>
            </div>
        </div>
    </div>
    <form action="addArticle.php" method="POST">
    <div class="row">
        <div class="col-md-6">
            <div class="panel-heading" style="text-align: center;">
              <div class="form-group" style="margin: 6px;">
              	<button type="submit" class="btn btn-info" id="add">add article</button>
              </div>
            </div>
        </div>
    </div>
    </form>
    <div class="row">
        <div class="col-md-6">

        <?php
        $fichierxml = new DOMDocument('1.0', 'UTF-8');
		$fichierxml->load('journal.xml');

		$liste = $fichierxml->getElementsByTagName('article');
	    //var_dump($liste);
        $i=1;
		foreach ($liste as $article)
			{

				$titre = $article->getElementsByTagName('titre')->item(0);
    			$auteur = $article->getElementsByTagName('auteur')->item(0);
    			$contenu = $article->getElementsByTagName('contenu')->item(0);
				echo '<div class="panel panel-default" name="',$titre->nodeValue,'" id="',$i,'">
            	<div class="form-group" style="margin: 6px;">
                <form action="printArticle.php" method="POST" style="margin: 6px;">
                <input hidden name="id" value="',$titre->nodeValue,'"/>
            	<label class="">',$titre->nodeValue,'</label>
                <button type="submit" class="btn btn-success btn-xs" id="',$i,'" name="print">print</button>
                </form>
                <form action="modifyArticle.php" method="POST" style="margin: 6px;">
                <input hidden name="id" value="',$titre->nodeValue,'"/>
                <input hidden name="id1" value="',$auteur->nodeValue,'"/>
                <input hidden name="id2" value="',$contenu->nodeValue,'"/>
                <button type="submit" class="btn btn-primary btn-xs" id="',$i,'" name="modify">modify</button>
                </form>
                <form action="deleteview.php" method="POST" style="margin: 6px;">
                <input hidden name="id" value="',$titre->nodeValue,'"/>
                <button type="submit" class="btn btn-danger btn-xs" id="',$i,'" name="delete">delete</button>
                </form>
            	</div></div>';
                $i++;
            //var_dump($titre->nodeValue, $auteur->nodeValue,$contenu->nodeValue);
			}
        ?>

        </div>
    </div>
	</div>
</body>
</html>
<?php
function creatArticle(){
    $dom = new DOMDocument('1.0', 'UTF-8');
    $newdom = new DOMDocument('1.0', 'UTF-8');
    $dom->load('journal.xml');
    
    $liste = $dom->getElementsByTagName('article');
    //var_dump($liste);
    $racine = $newdom->createElement('journal');
    $newdom->appendChild($racine);

    $articledom = $newdom->createElement('article');
    $racine->appendChild($articledom);

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

    foreach ($liste as $article)
        {
            $titre = $article->getElementsByTagName('titre')->item(0);
            $auteur = $article->getElementsByTagName('auteur')->item(0);
            $contenu = $article->getElementsByTagName('contenu')->item(0);

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
    return $newdom;
}
/*
function modifyArticle(){
    $dom = new DOMDocument('1.0', 'UTF-8');
    $newdom = new DOMDocument('1.0', 'UTF-8');
    $dom->load('journal.xml');

    $liste = $dom->getElementsByTagName('article');
    //var_dump($liste);
    $racine = $newdom->createElement('journal');
    $newdom->appendChild($racine);

    $articledom = $newdom->createElement('article');
    $racine->appendChild($articledom);

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

    foreach ($liste as $article)
    {
        $titre = $article->getElementsByTagName('titre')->item(0);
        $auteur = $article->getElementsByTagName('auteur')->item(0);
        $contenu = $article->getElementsByTagName('contenu')->item(0);

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
    return $newdom;

}*/

?>