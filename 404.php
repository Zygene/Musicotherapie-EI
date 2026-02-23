<?php
    header("HTTP/1.1 404 Not Found");

    $page = '404';
    $bandeTitre = "Page introuvable";
    $bandeCouleur = "vertClair";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="/images/icones/apple-touch-57px.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/icones/apple-touch-72px.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icones/apple-touch-76px.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/icones/apple-touch-114px.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/icones/apple-touch-120px.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/icones/apple-touch-144px.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/icones/apple-touch-152px.png">

    <link rel="icon" type="image/svg+xml" href="/images/icones/favicon-svg.svg" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icones/favicon-32px.png" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icones/favicon-16px.png" media="(prefers-color-scheme: light)">

    <link rel="icon" type="image/svg+xml" href="/images/icones/favicon-dark-svg.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icones/favicon-dark-32px.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icones/favicon-dark-16px.png" media="(prefers-color-scheme: dark)">

    <link rel="mask-icon" href="/images/icones/safari-svg.svg" color="#000000">

    <title>404 - Page introuvable</title>
    <meta name="robots" content="noindex, follow">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="wrapper-404">

        <div class="page-404">
            <h1>Erreur 404</h1>
            <p>Une fausse note s’est glissée… revenons à l’accueil pour retrouver le fil de la mélodie.</p>
            <a href="index.php" class="bouton-retour">Retour à l’accueil</a>
        </div>
        
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>
