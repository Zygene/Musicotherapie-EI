<?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=hofi3697_musicotherapieei;charset=utf8','hofi3697','Ck45-6QCA-Dqr}',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Erreur: '.$e->getMessage());
    }
?>