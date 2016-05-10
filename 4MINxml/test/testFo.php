
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>test fo</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel-heading" style="text-align: center;">
                <h1>test fo</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="panel panel-default" >
           <?php
            $titre = "test";
            $fichierxml = new DOMDocument('1.0', 'UTF-8');
            $fichierxml->load('journal.xml');//import du xml
            $fichierxsl = new DOMDocument();
            $fichierxsl->load('journal.xslt');//import du schéma
            
            $xsl = new XSLTProcessor();
            //$xsl->setParameter("",'title',$titre);
            $xsl->importStyleSheet($fichierxsl);
            $content = $xsl->transformToXML($fichierxml);

            $temp = fopen('journal.fo', 'w');
            fwrite($temp,$content);
            fclose($temp);
            exec("C:/wamp/www/fop/fop.bat journal.fo journal.pdf 2>&1");
            ?>
        </div>
        </div>
    </div>
</div>

</body>
</html>
