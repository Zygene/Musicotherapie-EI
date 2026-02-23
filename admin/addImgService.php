<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("LOCATION:index.php");
    exit;
}

// Vérifier la présence de l'id
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    header("LOCATION:services.php");
    exit;
}

// Vérifier si l'id existe dans la BDD
require "../connexion.php";
$req = $bdd->prepare("SELECT * FROM services WHERE id=?");
$req->execute([$id]);
if(!$don = $req->fetch()) {
    $req->closeCursor();
    header("LOCATION:services.php");
    exit;
}
$req->closeCursor();
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
    <title>Modifier l'image du service</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="admin-page">

<?php include("partials/header.php"); ?>

<div class="text-center mb-3">
    <a href="updateService.php?id=<?= $id ?>" class="btn btn-retour">Retour</a>
</div>

<div class="zone-centrage-services">
    <div class="conteneur-services conteneur-ajout-service">
        <h1 class="titre-services">Modifier l'image du service</h1>

        <?php
        if(isset($_GET['error'])) {
            $msg = [
                1 => "Extension non autorisée (png, jpg, jpeg uniquement).",
                2 => "Le fichier dépasse 2 Mo.",
                3 => "Erreur lors de l'upload du fichier."
            ];
            echo "<div class='alerte-services alert alert-danger my-3'>".$msg[$_GET['error']]."</div>";
        }
        if(!empty($successMessage)) {
            echo "<div class='alerte-services alert alert-success my-3'>$successMessage</div>";
        }
        ?>

        <form action="treatmentAddImgService.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data" class="mt-4">

            <div class="form-group mb-3">
                <label for="image">Nouvelle image (remplace l’ancienne)</label>
                <input type="file" name="image" id="image" class="form-control champ-texte" accept="image/*" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn bouton-connexion">Mettre à jour</button>
            </div>

        </form>
    </div>
</div>

</body>
</html>