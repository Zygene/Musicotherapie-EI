<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("LOCATION:index.php");
    exit;
}
require "../connexion.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="images/icones/apple-touch-monochrome-57px.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icones/apple-touch-monochrome-72px.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/icones/apple-touch-monochrome-76px.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icones/apple-touch-monochrome-114px.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/icones/apple-touch-monochrome-120px.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/icones/apple-touch-monochrome-144px.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/icones/apple-touch-monochrome-152px.png">

    <link rel="icon" type="image/svg+xml" href="images/icones/favicon-monochrome-svg.svg" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icones/favicon-monochrome-32px.png" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="16x16" href="images/icones/favicon-monochrome-16px.png" media="(prefers-color-scheme: light)">

    <link rel="icon" type="image/svg+xml" href="images/icones/favicon-monochrome-dark-svg.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icones/favicon-monochrome-dark-32px.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="16x16" href="images/icones/favicon-monochrome-dark-16px.png" media="(prefers-color-scheme: dark)">

    <link rel="mask-icon" href="images/icones/safari-svg.svg" color="#000000">

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <title>Ajouter un témoignage</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="admin-page">

<?php include("partials/header.php"); ?>

<div class="text-center mb-3">
    <a href="temoignages.php" class="btn btn-retour">Retour</a>
</div>

<div class="zone-centrage-services">
    <div class="conteneur-services conteneur-ajout-service">
        <h1 class="titre-services">Ajouter un témoignage</h1>

        <form action="treatmentAddTemoignage.php" method="POST" class="mt-4">

            <div class="form-group mb-3">
                <label for="nom">Nom du client</label>
                <input type="text" id="nom" name="nom" class="form-control champ-texte" required>
            </div>

            <div class="form-group mb-3">
                <label for="contexte">Contexte</label>
                <input type="text" id="contexte" name="contexte" class="form-control champ-texte" required>
            </div>

            <div class="form-group mb-3">
                <label for="texte">Témoignage</label>
                <textarea name="texte" id="texte" class="form-control champ-texte" rows="5" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" class="form-control champ-texte" value="<?= date('Y-m-d'); ?>" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn bouton-connexion">Ajouter le témoignage</button>
            </div>

        </form>

        <?php
        if(isset($_GET['error'])) {
            echo "<div class='alerte-services alert alert-danger'>Une erreur est survenue (code: ".$_GET['error'].")</div>";
        }
        if(isset($_GET['successAdd'])) {
            $nomtemoignage = htmlspecialchars($_GET['successAdd']);
            echo "<div class='alerte-services alert alert-success'>Le témoignage de <strong>$nomtemoignage</strong> a été ajouté avec succès.</div>";
        }
        ?>
    </div>
</div>

</body>
</html>