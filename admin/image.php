<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("LOCATION:index.php");
    exit;
}

require "../connexion.php";

$login = $_SESSION['login'];
$req = $bdd->prepare("SELECT * FROM identifiant WHERE login = ?");
$req->execute([$login]);
if(!$member = $req->fetch()) {
    $req->closeCursor();
    header("LOCATION:index.php");
    exit;
}
$req->closeCursor();

$messagesErreur = [
    1 => "Type de fichier invalide. Seuls .png, .jpg et .jpeg sont autorisés.",
    2 => "Taille du fichier trop grande (max 2Mo).",
    3 => "Erreur lors du téléchargement du fichier.",
    4 => "Aucune image n'a été sélectionnée."
];

if(isset($_FILES['photo'])) {
    if(empty($_FILES['photo']['tmp_name'])) {
        $erreur = 4;
    } else {
        $dossier = "../images/profil/";
        if(!is_dir($dossier)) {
            mkdir($dossier, 0755, true);
        }

        $fichier = basename($_FILES['photo']['name']);
        $taille_maxi = 2000000;
        $taille = filesize($_FILES['photo']['tmp_name']);
        $extensions = ['.png','.jpg','.jpeg'];
        $extension = strrchr($fichier,'.');

        if(!in_array(strtolower($extension), $extensions)) {
            $erreur = 1;
        }

        if($taille > $taille_maxi) {
            $erreur = 2;
        }

        if(!isset($erreur)) {
            $fichier = strtr($fichier, 
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i','-',$fichier); 
            $fichiercptl = rand().$fichier;

            if(!empty($member['photo']) && file_exists($dossier.$member['photo'])) {
                unlink($dossier.$member['photo']);
            }

            if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$fichiercptl)) {
                $update = $bdd->prepare("UPDATE identifiant SET photo = :photo WHERE login = :login");
                $update->execute([
                    ":photo" => $fichiercptl,
                    ":login" => $login
                ]);
                $update->closeCursor();

                $success = true;
                $member['photo'] = $fichiercptl;
            } else {
                $erreur = 3;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="/images/icones/apple-touch-monochrome-57px.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/icones/apple-touch-monochrome-72px.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icones/apple-touch-monochrome-76px.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/icones/apple-touch-monochrome-114px.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/icones/apple-touch-monochrome-120px.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/icones/apple-touch-monochrome-144px.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/icones/apple-touch-monochrome-152px.png">

    <link rel="icon" type="image/svg+xml" href="/images/icones/favicon-monochrome-svg.svg" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icones/favicon-monochrome-32px.png" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icones/favicon-monochrome-16px.png" media="(prefers-color-scheme: light)">

    <link rel="icon" type="image/svg+xml" href="/images/icones/favicon-monochrome-dark-svg.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icones/favicon-monochrome-dark-32px.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icones/favicon-monochrome-dark-16px.png" media="(prefers-color-scheme: dark)">

    <link rel="mask-icon" href="/images/icones/safari-svg.svg" color="#000000">

    <title>Modifier l'image de profil</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body class="admin-page">

<?php include("partials/header.php"); ?>

<div class="text-center mb-3">
    <a href="dashboard.php" class="btn btn-retour">Retour</a>
</div>

<div class="container dashboard-contenu my-5">
    <form action="" method="POST" enctype="multipart/form-data" class="formulaire-admin mx-auto p-4">

        <h1 class="titre-formulaire text-center mb-4">Image de profil</h1>

        <?php
        if(isset($erreur)) {
            echo "<div class='alert alert-danger alerte-erreur text-center'>" . ($messagesErreur[$erreur] ?? "Erreur inconnue") . "</div>";
        }

        if(isset($success) && $success) {
            echo "<div class='alert alert-success alerte-erreur text-center'>Image modifiée avec succès.</div>";
        }
        ?>

        <div class="form-group my-3">
            <label for="photo" class="form-label">Choisir une image</label>
            <input type="file" name="photo" id="photo" class="form-control champ-texte">
            <small class="text-muted">Taille max 2 Mo - formats acceptés : png, jpg, jpeg</small>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn bouton-connexion btn-lg">Mettre à jour</button>
        </div>

        <?php if(!empty($member['photo']) && file_exists("../images/profil/".$member['photo'])): ?>
            <div class="text-center mt-5">
                <h3>Image actuelle</h3>
                <img src="../images/profil/<?= $member['photo'] ?>" alt="Photo" style="max-width:200px;border-radius:10px;">
            </div>
        <?php endif; ?>

    </form>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>