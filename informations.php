<?php
    require "connexion.php";
    $page = 'informations';
    $bandeTitre = "La musicothérapie en pratique";
    $bandeCouleur = "orange";
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

    <link rel="stylesheet" href="style.css">
    <title>Léna Rousseau - Informations</title>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="wrapper">

        <div class="informations-container">

            <div class="informations-intro">
                <h1>Qu’est ce que la musicothérapie ?</h1>
                <h2>La musicothérapie est une discipline paramédicale qui utilise la musique pour soigner, aider, rééduquer ou soutenir des individus.</h2>
            </div>

            <div class="informations-content">

                <div class="infos-image infos-image-left">
                    <img src="images/general/Plante1-mixed.svg" alt="Plante eucalyptus">
                </div>

                <div class="infos-text">
                    <h1>Ce type de thérapie traite de nombreux domaines</h1>
                    <p>Améliore l’humeur, atténue le stress et les insomnies, réduit la douleur et renforce la confiance en soi.</p>
                    <p>Soutient les personnes avec des troubles sociaux, comportementaux, sensoriels, physiques, neurologiques ou psychoaffectifs.</p>
                    <p>Utile pour des maladies comme Alzheimer, la dépression ou certains troubles alimentaires.</p>
                    <p>Agit chez les personnes atteintes de troubles du spectre de l’autisme, de troubles de l’attention ou diagnostiqués DYS.</p>
                </div>

                <div class="infos-image infos-image-right">
                    <img src="images/general/Illustration-Portrait.svg" alt="Illustration Profil">
                </div>

            </div>

        </div>

        
    </div>
    
    <div class="bloc-couleur-info">

        <h1>Soutien à la communication chez les jeunes</h1>

        <div class="colonne-wrapper">

            <div class="colonne">
                <h2>Enfants</h2>
                <p>La musicothérapie a un impact positif sur le cerveau des enfants, favorisant la concentration, l’apaisement et la communication.</p>
            </div>

            <div class="colonne">
                <h2>Adolescents</h2>
                <p>Elle peut aider les adolescents à s’exprimer lorsqu’ils ont du mal verbalement, offrant une alternative précieuse pour favoriser l’ouverture et la communication.</p>
            </div>
        </div>
    </div>

    <div class="wrapper">

        <div class="informations-cadre">
            <h1>Un cadre pour s’épanouir</h1>
            <p>Les séances offrent un espace sûr pour s’exprimer et créer des liens sociaux. À long terme, cette thérapie contribue à renforcer la confiance en soi, améliorer la gestion émotionnelle, la communication et la sociabilisation.</p>
            <p>Elle soutient leur équilibre psychique, émotionnel, social et cognitif, en les aidant à mobiliser leurs propres ressources.</p>
        </div>

    </div>

    <div class="bande-image"></div>

    <div class="wrapper">

        <div class="informations-container">

            <div class="informations-approches">

                <h1>Approches principales</h1>
                <h2>Il y a différentes sortes de procédés, d’approches utilisées pour répondre aux besoins individuels</h2>

            </div>

        </div>

    </div>

    <div class="section-double-bloc">

        <div class="bloc-colonne">
            <h1>Musicothérapie active</h1>
            <div class="bloc-couleur approche1">
                <h2>Engage les individus dans la création musicale</h2>
                <p>Les musiques sont choisies par le musicothérapeute en fonction des objectifs thérapeutiques, tout en tenant compte de la culture, de l’âge et des goûts du patient.</p>
                <p>Cette approche constitue un véritable soutien : elle favorise l’expression verbale et permet de mettre des mots sur un vécu ou une émotion.</p>
            </div>
        </div>

        <div class="bloc-colonne">
            <h1>Musicothérapie réceptive</h1>
            <div class="bloc-couleur approche2">
                <h2>Les participants écoutent de la musique pour explorer leurs émotions</h2>
                <p>Cette technique privilégie la production sonore et musicale, l’improvisation et la créativité, à travers les instruments, la voix et le corps.</p>
                <p>Elle est particulièrement bénéfique pour les personnes qui éprouvent des difficultés à exprimer leurs pensées et leurs émotions.</p>
            </div>
        </div>

    </div>

    <section class="approches-specifiques">

        <h2>Approches spécifiques ou complémentaires</h2>

        <div class="approches-grid">

            <div class="colonne gauche">
                <div class="approche">
                    <h3>Musicothérapie de groupe</h3>
                    <p>Encourage l’interaction sociale et l’expression émotionnelle dans un cadre collectif</p>
                </div>

                <div class="approche">
                    <h3>Musicothérapie comportementale</h3>
                    <p>Vise à modifier des comportements spécifiques par l’interaction musicale</p>
                </div>

                <div class="approche">
                    <h3>Musicothérapie improvisationnelle</h3>
                    <p>L’accent est mis sur l’improvisation comme un moyen d’expression immédiate et spontanée</p>
                </div>
            </div>

            <div class="illustration-partition">
                <img src="images/general/Illustration-Partition.svg" alt="Illustration Partition">
            </div>

            <div class="colonne droite">
                <div class="approche">
                    <h3>Musicothérapie de relaxation</h3>
                    <p>Utilisée pour réduire le stress et améliorer la détente grâce à des environnements sonores apaisants</p>
                </div>

                <div class="approche">
                    <h3>Musicothérapie neurologique</h3>
                    <p>Ciblée pour des patients atteints de troubles neurologiques, comme la rééducation après un AVC</p>
                </div>

                <div class="approche">
                    <h3>Musicothérapie analytique</h3>
                    <p>Approfondissement des émotions et de l’inconscient à travers l’interprétation musicale</p>
                </div>
            </div>

        </div>
    </section>



    <?php include 'footer.php'; ?>

</body>
</html>