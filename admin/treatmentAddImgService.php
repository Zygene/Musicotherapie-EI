<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("LOCATION:index.php");
    exit;
}

if(!isset($_GET['id'])) {
    header("LOCATION:services.php");
    exit;
}
$id = intval($_GET['id']);

require "../connexion.php";

$req = $bdd->prepare("SELECT * FROM services WHERE id=?");
$req->execute([$id]);
if(!$don = $req->fetch()) {
    $req->closeCursor();
    header("LOCATION:services.php");
    exit;
}
$req->closeCursor();

$nom = htmlspecialchars($_POST['nom'] ?? '');
$description = htmlspecialchars($_POST['description'] ?? '');
$objectifs = htmlspecialchars($_POST['objectifs'] ?? '');
$duree = htmlspecialchars($_POST['duree'] ?? '');
$prix = htmlspecialchars($_POST['prix'] ?? '');
$date = $_POST['date'] ?? '';

if(!$nom || !$description || !$duree || !$prix || !$date) {
    header("LOCATION:updateService.php?id=$id&error=5");
    exit;
}

$imageNom = $don['image'];
if(isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
    $dossier = "../images/services/";
    if(!is_dir($dossier)) mkdir($dossier, 0755, true);

    $fichier = basename($_FILES['image']['name']);
    $taille_maxi = 2000000;
    $taille = filesize($_FILES['image']['tmp_name']);
    $extensions = ['.png','.jpg','.jpeg'];
    $extension = strtolower(strrchr($fichier, '.'));

    if(!in_array($extension, $extensions)) {
        header("LOCATION:updateService.php?id=$id&error=1");
        exit;
    }
    if($taille > $taille_maxi) {
        header("LOCATION:updateService.php?id=$id&error=2");
        exit;
    }

    $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9]+)/i','-',$fichier);
    $fichierUnique = rand().$fichier;

    if(!empty($don['image']) && file_exists($dossier.$don['image'])) {
        unlink($dossier.$don['image']);
    }

    if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichierUnique)) {
        $imageNom = $fichierUnique;
    } else {
        header("LOCATION:updateService.php?id=$id&error=3");
        exit;
    }
}

$update = $bdd->prepare("UPDATE services SET nom=?, description=?, objectifs=?, duree=?, prix=?, date=?, image=? WHERE id=?");
$update->execute([$nom, $description, $objectifs, $duree, $prix, $date, $imageNom, $id]);
$update->closeCursor();

header("LOCATION:updateService.php?id=$id&success=1");
exit;
?>
