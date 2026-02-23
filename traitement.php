<?php

if(isset($_POST['nom'])) {

    $err = 0;

    if(empty($_POST['prenom'])) {
        $err = 1;
    } else {
        $prenom = htmlspecialchars($_POST['prenom']);
    }

    if(empty($_POST['nom'])) {
        $err = 2;
    } else {
        $nom = htmlspecialchars($_POST['nom']);
    }

    if(empty($_POST['email'])) {
        $err = 3;
    } else {
        $email = htmlspecialchars($_POST['email']);
    }

    if(empty($_POST['telephone'])) {
        $err = 4;
    } else {
        $telephone = htmlspecialchars($_POST['prefix'] . $_POST['telephone']);
    }

    if(empty($_POST['message'])) {
        $err = 5;
    } else {
        $message = htmlspecialchars($_POST['message']);
    }

    if($err == 0) {
        require "connexion.php";
        $insert = $bdd->prepare("
            INSERT INTO contact(prenom, nom, email, telephone, message, date) 
            VALUES(:prenom, :nom, :email, :telephone, :message, NOW())
        ");
        $insert->execute([
            ':prenom'   => $prenom,
            ':nom'      => $nom,
            ':email'    => $email,
            ':telephone'=> $telephone,
            ':message'  => $message
        ]);
        $insert->closeCursor();
    }
}
?>