<?php ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>add article</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel-heading" style="text-align: center;">
                <h1>add article</h1>
            </div>
        </div>
    </div>
    <!--formulaire pour créer un article-->
    <form action="index.php" method="POST">
    <div class="row">
        <div class="col-md-6">
        <div class="panel panel-default" >
            <div class="form-group" style="margin: 4px">
                <label for="titreArticle">Title</label>
                <input type="text" name="titreArticle" class="form-control" id="titreArticle" placeholder="Title">
            </div>
            <div class="form-group" style="margin: 4px">
                <label for="nomAuteur">Writer name</label>
                <input type="text" name="nomAuteur" class="form-control" id="nomAuteur" placeholder="Writer name">
            </div>
            <div class="form-group" style="margin: 4px">
                <label for="contenu">Content</label>
                <textarea class="form-control" name="contenu" id="contenu" placeholder="Content"></textarea>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="text-align: right;">
        <button type="submit" class="btn btn-success btn-xs" id="validate" name="validate">validate</button>
        <button type="submit" class="btn btn-primary btn-xs" id="cancel" name="cancel">Cancel</button>
        </div>
    </div>
    </form>
</div>

</body>
</html>
