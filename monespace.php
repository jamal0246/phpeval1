<?php
//var_dump($_SESSION);
require_once "models/Utilisateur.php";
$connect=unserialize($_SESSION["user"]);
//var_dump($connect);

// J'appelle la fonction "getPseudo()" pour recevoir le nom du pseudo connecté pour ensuite personnaliser la page
$pseudo=$connect->getPseudo();

?>


<div style="background: rgb(187, 243, 187)">

        <h3>Mon espace </h3>

        <p> Bonjour <?= $pseudo?> , vous êtes bien connecté.</p>
</div>