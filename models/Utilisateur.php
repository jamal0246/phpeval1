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
  
    function getPseudo() {
        return $this->pseudo;
    }

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

    function verify_user(){
        /* TODO la fonction vérifira a partir du fichier des utilisateurs 
        enregistrés, vérifiera la correspondance entre 
        un utilisateur et son mot de passe.*/

        //echo "Je récupère le contenu de mon fichier utilisateurs.json :<br>";
        $contenu = (file_exists("datas/utilisateurs.json"))? file_get_contents("datas/utilisateurs.json") : "";
        //var_dump($contenu);
    
        //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
        $utilisateurs = json_decode($contenu);
        //var_dump($utilisateurs);
       
        $utilisateurs = (is_array($utilisateurs))? $utilisateurs : [];
       // var_dump($utilisateurs);

        // Parcours le tableau pour vérifier s'il existe un même pseudo pour un même mot de passe
        // ce qui signifie que l'utilsateur existe et renvoi "vrai" :-)
        foreach ($utilisateurs as $key=>$utilisateur){

            if($utilisateur->pseudo == $this->pseudo && $utilisateur->motpasse == $this->motpasse){
                    return "vrai";
            }
        }
    }
}