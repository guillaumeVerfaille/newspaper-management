
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
            $fichierxml->load('C:\fop-2.1-bin\fop-2.1\journal.xml');
            $fichierxsl = new DOMDocument();
            $fichierxsl->load('C:\fop-2.1-bin\fop-2.1\journal.xslt');
            
            $xsl = new XSLTProcessor();
            //$xsl->setParameter("",'title',$titre);
            $xsl->importStyleSheet($fichierxsl);
            $content = $xsl->transformToXML($fichierxml);
            echo $content;

            $temp = fopen('journal.fo', 'w');
            fwrite($temp,$content);
            fclose($temp);
            exec("rundll32 SHELL32.DLL,ShellExec_RunDLL "."C:\\WINDOWS\\system32\\cmd.exe /K"."fop journal.fo resultat.pdf");
            //passthru("C:\fop-2.1-bin\fop-2.1\fop.bat journal.fo journal.pdf");
            //header("Location: $C:\fop-2.1-bin\fop-2.1\journal.pdf");
            ?>
        </div>
        </div>
    </div>
</div>

</body>
</html>
