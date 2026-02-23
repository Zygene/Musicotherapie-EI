<?php
    require "connexion.php";

    $showSlide = !isset($_GET['no_slide']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="images/icones/apple-touch-57px.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icones/apple-touch-72px.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/icones/apple-touch-76px.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icones/apple-touch-114px.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/icones/apple-touch-120px.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/icones/apple-touch-144px.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/icones/apple-touch-152px.png">

    <link rel="icon" type="image/svg+xml" href="images/icones/favicon-svg.svg" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icones/favicon-32px.png" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="16x16" href="images/icones/favicon-16px.png" media="(prefers-color-scheme: light)">

    <link rel="icon" type="image/svg+xml" href="images/icones/favicon-dark-svg.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icones/favicon-dark-32px.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="16x16" href="images/icones/favicon-dark-16px.png" media="(prefers-color-scheme: dark)">

    <link rel="mask-icon" href="images/icones/safari-svg.svg" color="#000000">

    <link rel="stylesheet" href="style.css">
    <title>Léna Rousseau - Musicothérapie</title>
</head>
<body>

    <div class="body-accueil">
    <div class="wrapper">
        
        <div class="accueil" id="home">
            <header class="header-accueil">

                <a href="index.php?no_slide=1" class="header-left" id="logo-home">
                    <img src="images/general/Logo-LenaRousseau.svg" alt="Logo Léna Rousseau" class="logo">
                    <span class="nom">Léna Rousseau</span>
                </a>

                <div class="header-center">
                    <div class="fleche-retour" id="fleche-retour"></div>
                </div>

                <div class="header-right">
                    <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer"><img src="images/general/instagram.svg" alt="Instagram" class="social-icon"></a>
                    <span class="separateur"></span>
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="images/general/facebook.svg" alt="Facebook" class="social-icon"></a>
                    <span class="separateur"></span>
                    <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer"><img src="images/general/linkedin.svg" alt="LinkedIn" class="social-icon"></a>
                </div>
            </header>

            <h1>Bienvenue dans l’univers de la musicothérapie. Explorez, découvrez et laissez-vous guider.</h1>
            <h3>Choisissez le chemin par lequel vous souhaitez commencer.</h3>

            <section class="accueil-menu">

                <a href="aPropos.php" class="image-menu">
                    <img src="images/general/APropos.jpg" alt="À propos">
                    <div class="rectangle-menu" id="menu-vert">À propos</div>
                </a>

                <a href="informations.php" class="image-menu">
                    <img src="images/general/Informations.jpg" alt="Informations">
                    <div class="rectangle-menu" id="menu-orange">Informations</div>
                </a>

                <a href="services.php" class="image-menu">
                    <img src="images/general/Services.jpg" alt="Services">
                    <div class="rectangle-menu" id="menu-rouge">Services</div>
                </a>

                <a href="contact.php" class="image-menu">
                    <img src="images/general/Contact.jpg" alt="Me contacter">
                    <div class="rectangle-menu" id="menu-bleu">Me contacter</div>
                </a>

            </section>

            <div class="social-responsive">
                <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer"><img src="images/general/instagram.svg" alt="Instagram" class="social-icon"></a>
                <span class="separateur"></span>
                <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="images/general/facebook.svg" alt="Facebook" class="social-icon"></a>
                <span class="separateur"></span>
                <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer"><img src="images/general/linkedin.svg" alt="LinkedIn" class="social-icon"></a>
            </div>

            <div class="copyright">
                <div class="wrapper">
                    <span>Copyright © 2026 - Tous droits réservés. <a href="mentionsLegales.php">Mentions légales</a></span>
                </div>
            </div>
        </div>

    </div>
    

    <div class="slide" id="slide" style="<?= $showSlide ? '' : 'transform: translateY(-100vh);' ?>">
    <img src="images/general/Logo-LenaRousseau.svg" alt="Logo Léna Rousseau" id="logo_slide">
    <div class="text-column">
        <h1>Léna Rousseau</h1>
        <h2>Musicothérapeute</h2>
        <h3>Cliquez pour me découvrir</h3>
    </div>

    <div class="bouton-contact-wrapper">
        <a href="contact.php" class="bouton-contact">
            Prendre contact
            <span class="envelope-icon"></span>
        </a>
    </div>

    <script src="main.js"></script>

</body>
</html>