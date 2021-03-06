<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>print article</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel-heading" style="text-align: center;">
                <h1>print article</h1>
            </div>
        </div>
    </div>
    <form action="index.php" method="POST">
    <div class="row">
        <div class="col-md-6">
        <div class="panel panel-default" >
            <?php
            //si je reçois un formulaire par le print
            if(isset($_POST['print'])){
                $id=$_POST['id'];
                $dom = new DOMDocument();
                $dom = printArticle($_POST['id']);
                //je récupère juste l'article désiré et je le sauve dans le fichier article.xml
                $dom->save('article.xml');
            }
            //je print l'article sur lequel le bouton print a été appuyé soit celui dont le titre vaut $_POST['id']
            function printArticle ($id)
            {
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
                    //var_dump($titre->nodeValue, $auteur->nodeValue,$contenu->nodeValue);
                    //si un article a un titre qui est le même que le titre de l'article que l'on veut imprimer,
                    //il est récupéré dans le DomDocument
                    if ($titre->nodeValue == $id) {
                        //echo ("c'est le même id");
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
                    } else {
                        //echo ("c'est pas le même");
                    }
                }
                return $newdom;
            }
            $fichierxml = new DOMDocument('1.0', 'UTF-8');
            $fichierxml->load('article.xml');//import du fichier xml contenant l'article
            $fichierxsl = new DOMDocument();
            $fichierxsl->load('article.xslt');//import du schéma qui transforme le fichier xml en fichier fo
            //création du fichier fo
            $xsl = new XSLTProcessor();
            $xsl->importStyleSheet($fichierxsl);
            $content = $xsl->transformToXML($fichierxml);
            $temp = fopen('article.fo', 'w');
            fwrite($temp,$content);
            fclose($temp);
            //création du pdf à partir du fichier fo
            exec("C:/wamp/www/fop/fop.bat article.fo article.pdf 2>&1");
            // pour afficher le pdf directement dans la page
            $filename = 'article.pdf';
            $content = file_get_contents($filename);
            header("Content-Disposition: inline; filename=$filename");
            header("Content-type: application/pdf");
            header('Cache-Control: private, max-age=0, must-revalidate');
            header('Pragma: public');
            echo $content;
            ?>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="text-align: right;">
        <button type="submit" class="btn btn-primary btn-xs" id="cancel" name="cancel">Cancel</button>
        </div>
    </div>
    </form>
</div>

</body>
</html>

