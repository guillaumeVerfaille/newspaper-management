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
<form action="index.php" method="POST">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel-heading" style="text-align: center;">
                <h1>Journal</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel-heading" style="text-align: center;">
              <div class="form-group" style="margin: 6px;">
              	<button type="submit" class="btn btn-info" id="add">add article</button>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">

        <?php
        $fichierxml = new DOMDocument('1.0', 'UTF-8');
		$fichierxml->load('journal.xml');

		$liste = $fichierxml->getElementsByTagName('article');
		//var_dump($liste);
		foreach ($liste as $article)
			{
				$titre = $article->getElementsByTagName('titre')->item(0);
    			$auteur = $article->getElementsByTagName('auteur')->item(0);
    			$contenu = $article->getElementsByTagName('contenu')->item(0);
				echo '<div class="panel panel-default" id="',$titre->nodeValue,'">
            	<div class="form-group" style="margin: 6px;">
            	<label class="">',$titre->nodeValue,'</label>
                <button type="submit" class="btn btn-success btn-xs" id="print ',$titre->nodeValue,'" style="">print</button>
                <button type="submit" class="btn btn-primary btn-xs" id="modifie ',$titre->nodeValue,'">modify</button>
                <button type="submit" class="btn btn-danger btn-xs" id="delete ',$titre->nodeValue,'">delete</button>
            	</div></div>';
    		//var_dump($titre->nodeValue, $auteur->nodeValue,$contenu->nodeValue);
			}
        ?>
        </div>
    </div>
	</div>
</form>
</body>
</html>
