<?php
session_start(); // Création ci_dessu d'une session sur la page index.php 

//var_dump($_REQUEST); aide au développement, permet un contrôle : réception des données envoyées par ailleurs

//****************** Réception et traitement des données ******************* */

// var_dump($_SESSION); aide au développement, permet un contrôle : réception des données envoyées par ailleurs

// Réception des données avec un contrôle sur l'existance de la variable "page" (également sécurité pour toute manp de l'URL!)
$page = (isset($_REQUEST["page"]))? $_REQUEST["page"] : "accueil";

// Routage 
switch($page){

    case "accueil" : $toTemplate = vue_accueil();
    break;
    case "forminscription" : $toTemplate = formulaire_inscript();
    break;
    case "ajoutinscrit" : 
        //insert_user(); // appel à la fonction ci-dessous déclarée
        $toTemplate = insert_user();
    break;
    case "formconnexion" : $toTemplate = formulaire_connect();
    break;
    case "connexion" : 
        //connect_user(); // appel à la fonction ci-dessous déclarée
        $toTemplate = connect_user();
    break;
    case "mespace" : $toTemplate = monEspace();
    break;
    case "inserttache" : insert_tache(); // appel à la fonction ci-dessous déclarée
    break;
    default :  $toTemplate = vue_accueil();
}

function vue_accueil(){
    return ["template" => "accueil.php", "datas" => null];
}

function formulaire_inscript(){
    return ["template" => "formulaire_inscript.php", "datas" => null];
}

function formulaire_connect(){
    return ["template" => "formulaire_connexion.php", "datas" => null];
}

// function déconnect() { session_destroy(); return ["template" => "accueil.php", "datas" => null]; } --- TODO
function monEspace(){
    return ["template" => "monespace.php", "datas" => null];
    
}

// Déclaration fonction appelée par le routage aiguillée par la requête "POST" du formulaire envoyé (formulaire_inscript.php)
//// Création d'une instance (objet) utilisateur renseignée par la requête "POST" du formulaire
function insert_user(){

    if(!empty($_GET["idinscrit"]) && !empty($_POST["pseudo"]) && !empty($_POST["motpasse"]) && $_POST["motpasse"] === $_POST["motpasse2"]){

        require_once "models/Utilisateur.php";

        $utilisateur = new Utilisateur ($_GET["idinscrit"], $_POST["pseudo"], password_hash($_POST["motpasse"], PASSWORD_DEFAULT));
        $utilisateur->save_useur();
        header("Location:index.php?page=accueil");
        exit;
 
    } else {
        $_SESSION["errors"]["connexion"] = "Erreur lors de l'enregistrement";
        /// poursuivre la correctionn de la fonction cf. correction cours
        echo "Saisie incorrecte";
    // je ne peux pas proceder a l'inscription de ce user
    //}
    //je redirige vers une fonction d'affichage
    header("Location:index.php?page=accueil");
    exit;
    }
}

// Je déclare la fonction connect_user() qui créera un nouvel objet utilisateur s'il existe (dans le fichier utilisateur.json)
// puis qui renvoie à la page  "monespace.html"
// s'il n'existe pas, la fonction renvoie à la page d'accueil
function connect_user(){ // !!! fonction en cours d'élaboration dans la class Utilisateur
 
    if(!empty($_POST["pseudo"]) && !empty($_POST["motpasse"])) {

        require_once "models/Utilisateur.php";

        $utilisateur = new Utilisateur ($_GET["idinscrit"], $_POST["pseudo"], $_POST["motpasse"]);
    
            if($utilisateur->verify_user()) {
                // L'utilisateur est "autorisé" à se connecter
                $_SESSION["utilisateur"]["id_utilisateur"] = $utilisateur->getId_utilisateur();
                $_SESSION["utilisateur"]["pseudo"] = $utilisateur->getPseudo();
                $connect= serialize($utilisateur); 
                $_SESSION["user"]=$connect;


                header("Location:index.php?page=mespace");
                exit;

                } else {
                // L'utilisateur n'est pas "autorisé" à se connecter
                $_SESSION["errors"]["connexion"] = "Vous avez entré un mauvais identifiant et/ou mot de passe";
                }
    } else {
        $_SESSION["errors"]["champs"] = "L'ensemble des champs est obligatoire.";
    }
    header("Location:index.php?page=accueil");
    exit;
}

/* ancien code eval fonctionnant avant correction
    $utilisateur->verify_user(); // !!!! fonction en cours d'élaboration dans la class Utilisateur
    $retourverif= $utilisateur->verify_user(); //! fonction en cours d'élaboration dans la class Utilisateur
    $utilisateur->save_useur();
    
    // J'enregistre mon objet en session pour pouvoir utiliser les données de l'objet depuis index.php
    $connect= serialize($utilisateur); 
    $_SESSION["user"]=$connect;

    if($retourverif==true){
        header("Location:index.php?page=mespace"; 
        exit;   
    }
    header("Location:index.php?page=accueil"); 
    exit;
   */

function insert_tache(){

        require_once "models/Utilisateur.php";

        $connect=unserialize($_SESSION["user"]);

        $idconn=$connect->getId_utilisateur();
        //var_dump($idconn);
        //var_dump($_GET["idutilisateur"]);

        require_once "models/Tache.php";

        $tache= new Tache ($idconn, $_POST["nom"], $_POST["description"], $_POST["date"]); //ici l'objet reçoit l'id de l'utilisateur connecté par la variable "idonn"
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
                <?php require_once 
                    // "$template" 
                     "templates/". $toTemplate["template"] ?> 

            </div>
    <div style="background: rgb(200, 200, 200);">
            <p> Mentions légales - Technologie HTML5 et PHP </p>
    </div>
    
</body>
</html>