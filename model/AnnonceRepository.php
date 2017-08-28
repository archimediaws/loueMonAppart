<?php

class AnnonceRepository
{
    public $connexion;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }

    public function getAnnonceById($id){
        $object = $this->connexion->prepare('SELECT * FROM annonce WHERE id=:id');
        $object->execute(array(
            'id'=>$id
        ));
        $annonces = $object->fetchAll(PDO::FETCH_ASSOC);

        return new Annonce($annonces[0]);
    }

    public function getAllAnnonce(){
        $object = $this->connexion->prepare('SELECT * FROM annonce');
        $object->execute(array());
        $annonces = $object->fetchAll(PDO::FETCH_ASSOC);

        foreach ($annonces as $a){
            $arrayObjet[] = new Annonce($a);
        }

        return $arrayObjet;
    }

    public function getAllAnnonceByUserId(){
        $userid = $_SESSION['user']->getId();
        // var_dump($_SESSION['user']);
        // die();
        $object = $this->connexion->prepare('SELECT * FROM annonce WHERE poster_id=:poster_id');
        $object->execute(array(
            'poster_id'=> $userid
        ));
        $annoncesuser = $object->fetchAll(PDO::FETCH_ASSOC);
        $arrayObjet = [];
        foreach ($annoncesuser as $auser){
            $arrayObjet[] = new Annonce($auser);
        }

        return $arrayObjet;
    }


    public function saveAnnonceBdd(Annonce $annonce){
        if(empty($annonce->getId())){
            return $this->insertAnnonce($annonce);
        }else{
            return $this->updateAnnonce($annonce);
        }
    }

    private function insertAnnonce(Annonce $annonce){
        $query="INSERT INTO annonce SET title=:title, description=:description, date_post=:date_post, poster_id=:poster_id, category_id:category_id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'title'=>$annonce->getTitle(),
            'description' => $annonce->getDescription(),
            'date_post'=>$annonce->getDate_post(),
            'poster_id' => $annonce->getPoster_id(),
            'category_id' => $annonce->getCategory_id()
        ));
        return $pdo->rowCount();
    }

    private function updateAnnonce(Annonce $annonce){
        $query = 'UPDATE annonce SET title=:title, description=:description, date_post=:date_post, poster_id=:poster_id, category_id:category_id WHERE id=:id';
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'title'=>$annonce->getTitle(),
            'description' => $annonce->getDescription(),
            'date_post'=>$annonce->getDate_post(),
            'poster_id' => $annonce->getPoster_id(),
            'category_id' => $annonce->getCategory_id(),
            'id' => $annonce->getId()
        ));
        return $pdo->rowCount();
    }

    public function deleteAnnonce(Annonce $annonce){

       
        //$this->deleteAllPromotionFromProduit($produit);

        $object = $this->connexion->prepare('DELETE FROM annonce WHERE id=:id');
        $object->execute(array(
            'id'=>$annonce->getId()
        ));
        return  $object->rowCount();
    }
}