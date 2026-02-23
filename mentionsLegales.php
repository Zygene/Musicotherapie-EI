<?php
    require "connexion.php";
    $page = 'mentionslegales';
    $bandeTitre = "Mentions Légales";
    $bandeCouleur = "vertClair";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Léna Rousseau - Informations</title>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="wrapper">

        <div class="mention-bloc">
            <h1>1. Éditeur du site</h1>
            <p class="espace">Léna Rousseau - Musicothérapeute indépendante</p>
            <p>Rue des Alliés 18</p>
            <p class="espace">7080 Frameries - Belgique</p>
            <p><strong>Email :</strong> lena.rousseau@gmail.com</p>
            <p><strong>Téléphone :</strong> 32 (0)473 45 64 14</p>
        </div>

        <div class="mention-bloc">
            <h1>2. Responsable éditorial</h1>
            <p>Léna Rousseau</p>
        </div>

        <div class="mention-bloc">
            <h1>3. Propriété intellectuelle</h1>
            <p class="espace">Tous les contenus présents sur ce site, dont les textes, images, illustrations, graphismes, icônes et logos sont protégés par le droit d’auteur.</p>
            <p>Toute reproduction, distribution ou utilisation, même partielle, est interdite sans mon autorisation préalable.</p>
        </div>

        <div class="mention-bloc">
            <h1>4. Données personnelles</h1>
            <p class="espace">Les informations que vous me transmettez via ce formulaire ou par email sont confidentielles et utilisées uniquement pour vous répondre.</p>
            <p class="espace">Conformément à la réglementation sur la protection des données personnelles, vous disposez d’un droit d’accès, de rectification et de suppression de vos informations.</p>
            <p>Pour exercer ce droit, vous pouvez me contacter à l’adresse email suivante : <strong>lena.rousseau@gmail.com</strong></p>
        </div>

        <div class="mention-bloc">
            <h1>5. Hébergement</h1>
            <p>Site hébergé par <strong>o2switch</strong>, hébergeur de site web</p>
            <p>https://www.o2switch.fr/ - 02 808 59 58</p>
        </div>

    </div>

    <?php include 'footer.php'; ?>

</body>
</html>