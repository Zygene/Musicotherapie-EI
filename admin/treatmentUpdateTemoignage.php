<?php
session_start();
if(!isset($_SESSION['login'])){
    header("LOCATION:index.php");
    exit;
}

if(!isset($_GET['id'])){
    header("LOCATION:temoignages.php");
    exit;
}
$id = intval($_GET['id']);

require "../connexion.php";

$req = $bdd->prepare("SELECT * FROM temoignages WHERE id=?");
$req->execute([$id]);
if(!$don = $req->fetch()){
    $req->closeCursor();
    header("LOCATION:temoignages.php");
    exit;
}
$req->closeCursor();

if(isset($_POST['nom'])){
    $err = 0;

    if(empty($_POST['nom'])){
        $err = 1;
    } else {
        $nom = htmlspecialchars($_POST['nom']);
    }

    if(empty($_POST['contexte'])){
        $err = 2;
    } else {
        $contexte = htmlspecialchars($_POST['contexte']);
    }    

    if(empty($_POST['texte'])){
        $err = 3;
    } else {
        $texte = htmlspecialchars($_POST['texte']);
    }

    $date = !empty($_POST['date']) ? $_POST['date'] : date('Y-m-d');

    $visible = isset($_POST['visible']) ? 1 : 0;

    if($err == 0){
        $update = $bdd->prepare("UPDATE temoignages SET nom=?, contexte=?, texte=?, date=? WHERE id=?");
        $update->execute([$nom, $contexte, $texte, $date, $id]);
        $update->closeCursor();

        header("LOCATION:temoignages.php?successUpdate=".$id);
        exit;
    } else {
        header("LOCATION:updateTemoignage.php?id=$id&error=$err");
        exit;
    }
} else {
    header("LOCATION:temoignages.php");
    exit;
}
?>
