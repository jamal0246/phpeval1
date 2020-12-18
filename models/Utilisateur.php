<?php

class Utilisateur {
    private $id_utilisateur;
    private $pseudo;
    private $motpasse;
    private $motpasse2;

    public function __construct(string $id_utilisateur, string $pseudo,  string $motpasse, string $motpasse2="0"){
        $this->id_utilisateur = $id_utilisateur;
        $this->pseudo = $pseudo;
        $this->motpasse = $motpasse;
        $this->motpasse2 = $motpasse2;
    }
  

// Getter et setter créés pour pouvoir utiliser les données des objets instanciés (car propriété private)

    public function getId_utilisateur(): int {
        return $this->id_utilisateur;
    }

    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function getMotpasse(): string {
        return $this->$motpasse;
    }

    public function getMotpasse2(): string {
        return $this->$motpasse2;
    }

    public function setId_utilisateur($id_utilisateur): int {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function setPseudo($pseudo): string {
        $this->pseudo = $pseudo;
    }

    public function settMotpasse($motpasse): string {
        $this->motpasse = $motpasse;
    }
    public function settMotpasse2($motpasse2): string {
        $this->motpasse = $motpasse2;
    }

// Déclaration permattant d'enregistrer l'objet dans un fichier JSON
    public function save_useur() {

        //echo "Je récupère le contenu de mon fichier utilisateurs.json :<br>";
        $contenu = (file_exists("datas/utilisateurs.json"))? file_get_contents("datas/utilisateurs.json") : "";
        //var_dump($contenu);
    
        //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
        $utilisateurs = json_decode($contenu);
        //var_dump($utilisateurs);
       
        $utilisateurs = (is_array($utilisateurs))? $utilisateurs : [];
    
        //echo "Je crée un tableau avec mon objet courant : <br>";
        $utilisateur = get_object_vars($this);
        //var_dump($utilisateur);
    
        //echo "J'ajoute cet utilisateur à mon tableau de utilisateurs (\$utilisateurs)";
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


// Déclaration d'une fonction vérifiant l'existance d'un utilisateur inscrit dans le fichier JSON (cf. fonction save_useur())
    // !!!!! fonction en cours d'élaboration ****
    public function verify_user(): bool{ 

        $contenu = (file_exists("datas/utilisateurs.json"))? file_get_contents("datas/utilisateurs.json") : "";
        $utilisateurs = json_decode($contenu);
        $utilisateurs = (is_array($utilisateurs))? $utilisateurs : [];
       // var_dump($utilisateurs);

       $verif = false;

        // Parcours le tableau pour vérifier s'il existe un même pseudo pour un même mot de passe
        foreach ($utilisateurs as $utilisateur){

            if($utilisateur->pseudo == $this->pseudo) {
                $verif = password_verify($this->motpasse, $utilisateur->motpasse);
                    $this->id_utilisateur = $utilisateur->id_utilisateur;
            }
        }
        return $verif;
    }

}