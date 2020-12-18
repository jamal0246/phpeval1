<?php

class Tache {
    private $id_utilsateur_t;
    private $nomtache;
    private $description;
    private $datelimite;

        public function __construct(string $id_utilsateur_t, string $description, string $nomtache, string $datelimite){
            $this->id_utilsateur_t = $id_utilsateur_t;
            $this->nomtache = $nomtache;
            $this->description = $description;
            $this->datelimite = $datelimite;
        }

// Getter et setter créés pour pouvoir utiliser les données des objets instanciés (car propriété private)
        
        public function getid_utilsateur_t(): int {
            return $this->id_utilsateur_t;
}

        public function getNomtache(): string {
            return $this->nomtache;
        }

        public function getDescription(): string {
            return $this->description;
        }

        public function getDatelimite(): string{
            return $this->datelimite;
        }

        public function setId_utilsateur_t($id_utilsateur_t): int {
            $this->$id_utilsateur_t = $id_utilsateur_t;
        }

        public function setNomtache($nomtache): string {
            $this->nomtache = $nomtache;
        }

        public function setDescription($description): string {
            $this->description = $description;
        }

        public function setDatelimite($datelimite): string {
            $this->datelimite = $datelimite;
        }

// Déclaration permattant d'enregistrer l'objet dans un fichier JSON
        public function save_tache(){

        //echo "Je récupère le contenu de mon fichier taches.json :<br>";
        $contenu = (file_exists("datas/taches.json"))? file_get_contents("datas/taches.json") : "";
        //var_dump($contenu);
    
        //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
        $taches = json_decode($contenu);
        //var_dump($taches);
       
        $taches = (is_array($taches))? $taches : [];
    
        //echo "Je crée un tableau avec mon objet courant : <br>";
        $tache = get_object_vars($this);
        //var_dump($tache);
    
        //echo "J'ajoute cet tache à mon tableau de taches (\$taches)";
        array_push($taches, $tache);
        //var_dump($taches);
    
        //echo "J'ouvre mon fichier taches.json <br>";
        $handle = fopen("datas/taches.json", "w");

        //echo "Je réencode mon tableau au format JSON : <br>";
        $json = json_encode($taches);
        //var_dump($json);
    
        //echo "J'écris ma chaîne JSON dans mon fichier taches.json<br>";
        fwrite($handle, $json);

        //echo "Je ferme mon fichier !";
        fclose($handle);
    }
}