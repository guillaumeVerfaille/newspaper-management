<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title></title>
</head>
<body>
<?php
echo 'Test: �crivons du xml <br>';
$dom = new DOMDocument('1.0','UTF-8');

$racine = $dom->createElement('journal');
$dom->appendChild($racine);

$article = $dom->createElement('article');
$racine->appendChild($article);

$titre = $dom->createElement('titre');
$contenu_titre = $dom->createTextNode('premier article');
$titre->appendChild($contenu_titre);

$auteur = $dom->createElement('auteur');
$contenu_auteur = $dom->createTextNode('Guillaume');
$auteur->appendChild($contenu_auteur);

$contenu = $dom->createElement('contenu');
$contenu_contenu = $dom->createTextNode('contenu du premier article');
$contenu->appendChild($contenu_contenu);

$article->appendChild($titre);
$article->appendChild($auteur);
$article->appendChild($contenu);

$dom->save('test.xml');

$fichierxml = new DOMDocument('1.0', 'UTF-8');
$fichierxml->load('journal.xml');

$liste = $fichierxml->getElementsByTagName('article');
//var_dump($liste);
foreach ($liste as $article)
{
	//var_dump($article);
    $titre = $article->getElementsByTagName('titre')->item(0);
    $auteur = $article->getElementsByTagName('auteur')->item(0);
    $contenu = $article->getElementsByTagName('contenu')->item(0);
    var_dump($titre->nodeValue, $auteur->nodeValue,$contenu->nodeValue);
}
?>
</body>
</html>
<?php
?>