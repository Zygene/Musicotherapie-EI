<?php
    require "connexion.php";
    $stmt = $bdd->query("SELECT photo FROM identifiant");
    $row = $stmt->fetch();
    $imageProfil = $row['photo'] ?? null;
    $page = 'apropos';
    $bandeTitre = "À la rencontre de Léna Rousseau";
    $bandeCouleur = "vert";
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
    <title>Léna Rousseau - À propos</title>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="wrapper">
        
        <div class="apropos-container">
            <div class="texte-apropos">
                <h1>Présentation
                    <span class="symbole-profil"></span>
                </h1>
                <p>Je suis Léna Rousseau, musicothérapeute passionnée par le pouvoir du son et du rythme comme moyens de transformation intérieure.</p>
                <p>J’accompagne enfants, adolescents, adultes et seniors à travers une approche bienveillante où la musique devient un langage du cœur, un outil de lien, d’expression et de guérison.</p>
                <p>Mon objectif est d’offrir un espace d’écoute et de créativité, où chacun peut explorer ses émotions, apaiser les tensions du quotidien et retrouver confiance en ses propres ressources.</p>
            </div>

            <div class="image-apropos">
                <?php if(!empty($imageProfil) && file_exists("images/profil/".$imageProfil)): ?>
                    <img src="images/profil/<?= htmlspecialchars($imageProfil) ?>" alt="Photo" />
                <?php endif; ?>
            </div>
        </div>

    </div>

    <div class="bloc-couleur">
        <h1>Ma pratique</h1>
        <div class="colonne-wrapper">
            <div class="colonne">
                <h2>Un temps d’écoute</h2>
                <p>Chaque accompagnement débute par un temps d’écoute et d’échange, afin de comprendre les besoins, les attentes et le vécu de la personne que j’accompagne.</p>
                <p>J’accorde une importance particulière à la création d’un cadre sécurisant et respectueux du rythme de chacun.</p>
            </div>
            <div class="colonne">
                <h2>Une approche personnalisée</h2>
                <p>Ma pratique s’appuie sur différentes approches de la musicothérapie, actives ou réceptives, adaptées aux besoins individuels.</p>
                <p>L’improvisation musicale, l’écoute, le chant, le rythme, le corps et le silence deviennent des supports d’expression et de relation.</p>
            </div>
            <div class="colonne">
                <h2>Un espace créatif</h2>
                <p>Je conçois la musicothérapie comme un espace de créativité et de liberté, sans recherche de performance, où chacun peut explorer ses émotions, apaiser ses tensions et mobiliser ses propres ressources dans un cheminement personnel.</p>
            </div>
        </div>
    </div>

    <div class="wrapper">

        <div class="parcours-container">
            <div class="parcours-wrapper">

                <div class="plante">
                    <img src="images/general/Plante2-mixed.svg" alt="Plante Eucalyptus">
                </div>

                <div class="texte-parcours">
                    <h1>Mon parcours</h1>
                    <p>Formée à la musicothérapie au sein d’un cursus spécialisé, j’ai développé une approche à la fois sensible et rigoureuse, mêlant apports théoriques et expériences de terrain.</p>
                    <p>Au fil de mon parcours, j’ai eu l’opportunité d’accompagner un public varié enfants dans différents contextes tels que des institutions médico-sociales, des établissements scolaires et des structures d’accompagnement.</p>
                    <p>Ces expériences ont profondément nourri ma pratique et renforcé ma conviction que la musique peut devenir un puissant levier d’expression, de communication et de transformation, quel que soit l’âge ou la situation de vie.</p>
                </div>

            </div>
        </div>
    </div>

    <div class="bouton-wrapper">
        <a href="informations.php" class="bouton-musicotherapie">
            En savoir plus sur la musicothérapie
        </a>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>