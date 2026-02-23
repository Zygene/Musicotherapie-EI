<?php
session_start();
if(!isset($_SESSION['login'])){
    header("LOCATION:index.php");
    exit;
}

if(isset($_POST['nom'])){
    require "../connexion.php";

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

    $visible = 1;

    if($err === 0){
        $insert = $bdd->prepare("
            INSERT INTO temoignages (nom, contexte, texte, date, visible) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $insert->execute([$nom, $contexte, $texte, $date, $visible]);
        $insert->closeCursor();

        header("LOCATION:temoignages.php?successAdd=".urlencode($nom));
        exit;
    } else {
        header("LOCATION:addTemoignage.php?error=".$err);
        exit;
    }

} else {
    header("LOCATION:addTemoignage.php");
    exit;
}
?>
