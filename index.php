<?php
//****************** Réception et traitement des données ******************* */

// session_start(); // en cours
// var_dump($_SESSION); aide au développement, permet un contrôle : réception des données envoyées par ailleurs

// var_dump($_REQUEST); //  aide au développement, permet un contrôle : réception des données envoyées par ailleurs

// Réception des données avec un contrôle sur l'existance de la variable "page"
$page = (isset($_REQUEST["page"]))? $_REQUEST["page"] : "accueil";

// Routage 
switch($page){

    case "accueil" : $template = "accueil.php" ;
    break;
    case "forminscription" : $template = "formulaire_inscript.php" ;
    break;
    case "ajoutinscrit" : insert_user(); // appel à la fonction ci-dessous déclarée
    break;
    default : $template = "accueil.php";
}

// Déclaration fonction appelée par le routage aiguillée par la requête "POST" du formulaire envoyé (formulaire_inscript.php)
//// Création d'une instance (objet) utilisateur renseignée par la requête "POST" du formulaire
function insert_user(){

    require_once "models/Utilisateur.php";

    $utilisateur = new Utilisateur ($_POST["id_utilisateur"], $_POST["pseudo"], $_POST["motpasse"]);
    $utilisateur->save_useur();

    header("Location:index.php");
    exit;

}
?>


<!-- ******************** Affichage de la page UI pour l'utilisateur du poste client ***************-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Accueil </title>
</head>
<body>
    <div style="background: rgb(200, 200, 200);">
        <h1> Organisateur personnel </h1>
            <nav>
                <ul>
                    <li>
                        <a href="index.php?page=accueil">Accueil</a> <!-- Requête vers le routage pour l'affichage de la page d'accueil -->
                    </li>
                    <li>
                        <a href="index.php?page=forminscription">S'inscrire</a>  <!-- Requête vers le routage pour l'affichage du formulaire -->
                    </li>
                </ul>
            </nav>


    </div>
            <div>
<!-- ***** Inclusion du code venant du routage pour affichage dans l'UI ******** -->
                <?php require_once "$template" ?>

            </div>
    <div style="background: rgb(200, 200, 200);">
            <p> Mentions légales - Technologie HTML5 et PHP </p>
    </div>
</body>
</html>