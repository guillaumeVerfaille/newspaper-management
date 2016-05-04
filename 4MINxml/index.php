<?php ?>
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
		foreach ($liste as $article)
			{
                $i=1
				$titre = $article->getElementsByTagName('titre')->item(0);
    			$auteur = $article->getElementsByTagName('auteur')->item(0);
    			$contenu = $article->getElementsByTagName('contenu')->item(0);
				echo '<div class="panel panel-default" name="',$titre->nodeValue,'" id="',$i,'">
            	<div class="form-group" style="margin: 6px;">
            	<label class="">',$titre->nodeValue,'</label>
                <button type="submit" class="btn btn-success btn-xs" id="print ',$i,'" name="',$titre->nodeValue,'">print</button>
                <button type="submit" class="btn btn-primary btn-xs" id="modify ',$i,'" name="modify ',$titre->nodeValue,'">modify</button>
                <button type="submit" class="btn btn-danger btn-xs" id="delete ',$i,'" name="delete ',$titre->nodeValue,'">delete</button>
            	</div></div>';
                $i=$i+1;
            //var_dump($titre->nodeValue, $auteur->nodeValue,$contenu->nodeValue);
			}
        ?>
        </div>
    </div>
	</div>
</body>
</html>
<?php 
session_start();
//pour executer et afficher les erreurs du programme: exec(command 2>&1);
if(isset($_POST['valider'])){
	
	$dom = new DOMDocument('1.0','UTF-8');
	$racine = $dom->createElement('journal');
	$dom->appendChild($racine);

	$article = $dom->createElement('article');
	$racine->appendChild($article);

	$titre = $dom->createElement('titre');
	$contenu_titre = $dom->createTextNode($_POST['titreArticle']);
	$titre->appendChild($contenu_titre);

	$auteur = $dom->createElement('auteur');
	$contenu_auteur = $dom->createTextNode($_POST['nomAuteur']);
	$auteur->appendChild($contenu_auteur);

	$contenu = $dom->createElement('contenu');
	$contenu_contenu = $dom->createTextNode($_POST['contenu']);
	$contenu->appendChild($contenu_contenu);

	$article->appendChild($titre);
	$article->appendChild($auteur);
	$article->appendChild($contenu);
	$dom->save('article.xml');
	var_dump($dom);
}

?>