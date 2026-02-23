<?php
session_start();
if(!isset($_SESSION['login'])){
    header("LOCATION:index.php");
    exit;
}

if(!isset($_GET['id'])){
    header("LOCATION:services.php");
    exit;
}

$id = intval($_GET['id']);
require "../connexion.php";

$req = $bdd->prepare("SELECT * FROM services WHERE id=?");
$req->execute([$id]);
if(!$don = $req->fetch()){
    $req->closeCursor();
    header("LOCATION:services.php");
    exit;
}
$req->closeCursor();

$errorMessages = [
    'image1' => "Format d'image non autorisé (png, jpg, jpeg uniquement).",
    'image2' => "Le fichier dépasse 2 Mo.",
    'image3' => "Erreur lors de l'envoi de l'image."

];

$successMessage = '';
if(isset($_GET['successUpdate'])){
    $successMessage = "Le service '".htmlspecialchars($_GET['successUpdate'])."' a été mis à jour avec succès.";
}

function showError($key, $messages){
    if(isset($_GET[$key])){
        $code = $_GET[$key];
        $msg = $messages[$key === 'errorimg' ? 'image'.$code : $code] ?? "Une erreur inconnue est survenue.";
        echo "<div class='alert alert-danger my-2'>$msg</div>";
    }
}
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
    <title>Modifier un service</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="admin-page">

<?php include("partials/header.php"); ?>

<div class="text-center mb-3">
    <a href="services.php" class="btn btn-retour">Retour</a>
</div>

<div class="zone-centrage-services">
    <div class="conteneur-services conteneur-ajout-service">
        <h1 class="titre-services">Modifier le service</h1>

        <?php
        showError('error', $errorMessages);
        showError('errorimg', $errorMessages);

        if(!empty($successMessage)){
            echo "<div class='alerte-services alert alert-success my-3'>$successMessage</div>";
        }
        ?>

        <form action="treatmentUpdateService.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data" class="mt-4">

            <div class="form-group mb-3">
                <label for="nom">Nom du service</label>
                <input type="text" id="nom" name="nom" class="form-control champ-texte" value="<?= htmlspecialchars($don['nom']) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control champ-texte" required><?= htmlspecialchars($don['description']) ?></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="objectifs">Objectifs possibles</label>
                <textarea id="objectifs" name="objectifs" class="form-control champ-texte"><?= htmlspecialchars($don['objectifs']) ?></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="duree">Durée</label>
                <input type="text" id="duree" name="duree" class="form-control champ-texte" value="<?= htmlspecialchars($don['duree']) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="prix">Prix (€) / séance</label>
                <input type="text" id="prix" name="prix" class="form-control champ-texte" value="<?= htmlspecialchars($don['prix']) ?>" required>
                <small class="text-muted">Vous pouvez entrer un nombre ou du texte (ex: "Sur devis, selon la durée et le nombre de participants").</small>
            </div>

            <div class="form-group mb-3">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" class="form-control champ-texte" value="<?= $don['date'] ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>Image actuelle</label><br>
                <?php if(!empty($don['image']) && file_exists("../images/services/".$don['image'])): ?>
                    <img src="../images/services/<?= $don['image'] ?>" alt="Image du service" class="img-fluid mb-2" style="max-width:200px;">
                <?php else: ?>
                    <p>Aucune image disponible.</p>
                <?php endif; ?>
                <div class="mt-2">
                    <label for="image">Remplacer l'image</label>
                    <input type="file" name="image" id="image" class="form-control champ-texte" accept="image/*">
                    <small class="text-muted">Taille max 2 Mo - formats acceptés : png, jpg, jpeg</small>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn bouton-connexion">Mettre à jour le service</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>