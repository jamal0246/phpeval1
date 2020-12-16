<?php
session_start(); // Création ci_dessu d'une session sur la page index.php 

//var_dump($_REQUEST); aide au développement, permet un contrôle : réception des données envoyées par ailleurs

//****************** Réception et traitement des données ******************* */

// var_dump($_SESSION); aide au développement, permet un contrôle : réception des données envoyées par ailleurs

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
    case "formconnexion" : $template = "formulaire_connexion.php";
    break;
    case "connexion" : connect_user(); // appel à la fonction ci-dessous déclarée
    break;
    case "mespace" : $template = "monespace.php";
    break;
    case "inserttache" : insert_tache(); // appel à la fonction ci-dessous déclarée
    break;
    default : $template = "accueil.php";
}

// Déclaration fonction appelée par le routage aiguillée par la requête "POST" du formulaire envoyé (formulaire_inscript.php)
//// Création d'une instance (objet) utilisateur renseignée par la requête "POST" du formulaire
function insert_user(){

    require_once "models/Utilisateur.php";

    $utilisateur = new Utilisateur ($_GET["idinscrit"], $_POST["pseudo"], $_POST["motpasse"]);
    $utilisateur->save_useur();
    $pseudo=$_POST["pseudo"];
    header("Location:index.php?page=accueil");
    exit;
}

// Je déclare la fonction connect_user() qui créera un nouvel objet utilisateur s'il existe (dans le fichier utilisateur.json)
// puis qui renvoie à la page  "monespace.html"
// s'il n'existe pas, la fonction renvoie à la page d'accueil
function connect_user(){

    require_once "models/Utilisateur.php";

    $utilisateur = new Utilisateur ($_GET["idinscrit"], $_POST["pseudo"], $_POST["motpasse"]);
    
    $utilisateur->verify_user();
    $retourverif= $utilisateur->verify_user();
    $utilisateur->save_useur();
    
    // J'enregistre mon objet en session pour pouvoir utiliser les données de l'objet depuis index.php
    $connect= serialize($utilisateur); 
    $_SESSION["user"]=$connect;

    if($retourverif=="vrai"){
        header("Location:index.php?page=mespace"); 
        exit;   
    }
    header("Location:index.php?page=accueil"); 
    exit;
}

function insert_tache(){

        require_once "models/Utilisateur.php";

        $connect=unserialize($_SESSION["user"]);

        $idconn=$connect->getId_utilisateur();
        //var_dump($idconn);
        //var_dump($_GET["idutilisateur"]);

        require_once "models/Tache.php";

        $tache= new Tache ($idconn, $_POST["nom"], $_POST["date"]); //ici l'objet reçoit l'id de l'utilisateur connecté par la variable "idonn"
        $tache->save_tache();

        //var_dump($tache->getNomtache()); test
        //var_dump($tache->getDatelimite()); test
        //var_dump($tache); test
        header("Location:index.php?page=mespace");
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
                    <li>
                        <a href="index.php?page=formconnexion">Se connecter</a>  <!-- Requête vers le routage pour l'affichage du formulaire -->
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