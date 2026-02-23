<?php
    require "connexion.php";
    $page = 'services';
    $bandeTitre = "Découvrir les séances";
    $bandeCouleur = "rouge";
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

    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Léna Rousseau - Services</title>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="wrapper">

        <div class="service-titre">
            <h2>La durée peut s’adapter en fonction du public et des objectifs.</h2>
        </div>

        <div class="services-grille">
            <?php
                $query = $bdd->query("SELECT * FROM services ORDER BY id ASC");
                while($service = $query->fetch(PDO::FETCH_ASSOC)):
            ?>
            <div class="service-card">
                <div class="service-image">
                    <img src="images/services/<?php echo htmlspecialchars($service['image']); ?>" alt="<?php echo htmlspecialchars($service['nom']); ?>">
                </div>

                <div class="service-info">
                    <h1><?php echo htmlspecialchars($service['nom']); ?></h1>
                    <p class="description"><?php echo htmlspecialchars($service['description']); ?></p>

                    <div class="objectifs-container">
                        <p class="objectifs"><strong>Objectifs possibles</strong></p>
                        <p class="texte-objectifs"><?php echo nl2br(htmlspecialchars($service['objectifs'])); ?></p>
                    </div>

                    <div class="service-meta">
                        <div class="meta-item duree">
                            <span class="icon-horloge"></span>
                            <span class="text"><?php echo htmlspecialchars($service['duree']); ?></span>
                        </div>

                        <div class="meta-item prix">
                            <span class="icon-tag"></span>
                            <span class="text">
                                <?php
                                if(is_numeric($service['prix'])) {
                                    echo htmlspecialchars($service['prix']) . " €";
                                } else {
                                    echo htmlspecialchars($service['prix']);
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="complementaire">
            <h3>La musicothérapie ne remplace pas un suivi médical ou psychologique, mais peut s’inscrire en complément.</h3>
        </div>

        <div class="bloc-mutuelle">
            <h1>Mutuelle</h1>
    
            <div class="colonne-wrapper">
                <div class="colonne">
                    <p>
                        La musicothérapie est remboursée par la mutuelle, indépendamment de l’âge,
                        dans le cadre de "l’assurance obligatoire."
                    </p>
                </div>
    
                <div class="colonne">
                    <p>
                        Grâce à l’intervention de l’INAMI, les moins de 24 ans bénéficient
                        de séances gratuites, tandis que les adultes profitent d’un remboursement partiel.
                    </p>
                </div>
            </div>
        </div>

        <section class="temoignages-section">

            <div class="titre-temoignages">
                <h1>Quelques témoignages</h1>
                <img src="images/general/Plante2-mixed.svg" alt="" class="Illustration plante">
            </div>

            <div class="temoignages-wrapper">
                <?php
                    $query = $bdd->query("SELECT nom, contexte, texte FROM temoignages WHERE visible = 1 ORDER BY id DESC");
                    while($temoignage = $query->fetch(PDO::FETCH_ASSOC)):
                ?>
                <div class="temoignage-card">

                    <div class="bande-verte"></div>
                    <div class="temoignage-content">

                        <p class="temoignage-texte">“<?php echo nl2br(htmlspecialchars($temoignage['texte'])); ?>”</p>

                        <div class="temoignage-footer">
                            <span class="temoignage-nom">
                                <?php echo htmlspecialchars($temoignage['nom']); ?>
                            </span>

                            <?php if(!empty($temoignage['contexte'])): ?>
                                <span class="temoignage-contexte">
                                    <?php echo htmlspecialchars($temoignage['contexte']); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
                <?php endwhile; ?>
            </div>

        </section>
        
        <p class="mention-anonymat">Les témoignages sont publiés avec l’accord écrit des personnes concernées et restent anonymes pour protéger la vie privée et respecter la confidentialité des patients.</p>

    </div>


    <?php include 'footer.php'; ?>

</body>
</html>