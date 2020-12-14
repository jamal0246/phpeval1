<?php

class Utilisateur {
    private $id_utilisateur;
    private $pseudo;
    private $motpasse;

    function __construct(string $id_utilisateur, string $pseudo,  string $motpasse){
        $this->id_utilisateur = $id_utilisateur;
        $this->pseudo = $pseudo;
        $this->motpasse = $motpasse;
    }
  
    // Elaboré sur le modele vu en cours
    function save_useur() {

        //echo "Je récupère le contenu de mon fichier utilisateurs.json :<br>";
        $contenu = (file_exists("datas/utilisateurs.json"))? file_get_contents("datas/utilisateurs.json") : "";
        //var_dump($contenu);
    
        //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
        $utilisateurs = json_decode($contenu);
        //var_dump($utilisateurses);
       
        $utilisateurs = (is_array($utilisateurs))? $utilisateurs : [];
    
        //echo "Je crée un tableau avec mon objet courant : <br>";
        $utilisateur = get_object_vars($this);
        //var_dump($utilisateur);
    
        //echo "J'ajoute cet utilisateur à mon tableau de utilisateurs (\$livres)";
        array_push($utilisateurs, $utilisateur);
        //var_dump($utilisateurs);
    
        //echo "J'ouvre mon fichier utilisateurs.json <br>";
        $handle = fopen("datas/utilisateurs.json", "w");

        //echo "Je réencode mon tableau au format JSON : <br>";
        $json = json_encode($utilisateurs);
        //var_dump($json);
    
        //echo "J'écris ma chaîne JSON dans mon fichier utilisateurs.json<br>";
        fwrite($handle, $json);
        //echo "Je ferme mon fichier !";
        fclose($handle);
    }
}