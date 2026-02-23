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

$error = '';
$nom = !empty($_POST['nom']) ? htmlspecialchars($_POST['nom']) : $error='1';
$description = !empty($_POST['description']) ? $_POST['description'] : $error='2';
$objectifs = $_POST['objectifs'] ?? '';
$duree = !empty($_POST['duree']) ? htmlspecialchars($_POST['duree']) : $error='3';
$prix = !empty($_POST['prix']) ? $_POST['prix'] : $error='4';
$date = !empty($_POST['date']) ? $_POST['date'] : $error='5';

if($error){
    header("LOCATION:updateService.php?id=$id&error=$error");
    exit;
}

$fichierUnique = $don['image'];

if(!empty($_FILES['image']['name'])){
    $uploadError = $_FILES['image']['error'];

    if($uploadError !== UPLOAD_ERR_OK){
        if($uploadError == UPLOAD_ERR_INI_SIZE || $uploadError == UPLOAD_ERR_FORM_SIZE){
            header("LOCATION:updateService.php?id=$id&errorimg=2");
            exit;
        } else {
            header("LOCATION:updateService.php?id=$id&errorimg=3");
            exit;
        }
    }

    $dossier = "../images/services/";
    $fichier = basename($_FILES['image']['name']);
    $extensions = ['.png','.jpg','.jpeg'];
    $extension = strtolower(strrchr($fichier,'.'));

    if(!in_array($extension, $extensions)){
        header("LOCATION:updateService.php?id=$id&errorimg=1");
        exit;
    }

    $fichier = strtr($fichier, 
        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9]+)/i','-',$fichier);
    $fichierUnique = rand().$fichier;

    if(!move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichierUnique)){
        header("LOCATION:updateService.php?id=$id&errorimg=3");
        exit;
    }

    if(!empty($don['image']) && file_exists($dossier.$don['image'])){
        unlink($dossier.$don['image']);
    }
}

$update = $bdd->prepare("UPDATE services SET nom=?, description=?, objectifs=?, duree=?, prix=?, date=?, image=? WHERE id=?");
$update->execute([$nom, $description, $objectifs, $duree, $prix, $date, $fichierUnique, $id]);

$nomEncoded = urlencode($nom);
header("LOCATION:services.php?successUpdate=$nomEncoded");
exit;
