<?php

class Annonce
{
    private $id;
    private $titre;
    private $description;
    private $date;
    private $poster_id;
    private $category_id;


    public function __construct($donnees=array())
    {
        $this->hydrate($donnees);

    }

  
    public function getId()
    {
        return $this->id;
    }

    
    public function setId($id)
    {
        $this->id = $id;
    }

   
    public function getTitre()
    {
        return $this->titre;
    }

   
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

  
    public function getDescription()
    {
        return $this->description;
    }

   
    public function setDescription($description)
    {
        $this->description = $description;
    }

  
    public function getDate()
    {
        return $this->date;
    }

 
    public function setDate($date)
    {
        $this->date = $date;
    }

    
    public function getPoster()
    {
        return $this->poster_id;
    }

  
    public function setPoster($poster_id)
    {
        $this->poster_id = $poster_id;
    }


    public function getCategory()
    {
        return $this->category_id;
    }

  
    public function setCategory($category_id)
    {
        $this->category_id = $category_id;
    }



    public function hydrate(array $donneesPdo){

        if(empty($donneesPdo) == false){
            foreach ($donneesPdo as $key => $value){
                $key = preg_replace("#_#","",$key);
                $method = "set".ucfirst($key);
                if(method_exists($this,$method)){
                    $this->$method($value);
                }
            }
        }
    }

    public function save(BddManager $bddManager){
        $bddManager->getAnnonceRepository()->saveAnnonceBdd($this);
    }

    public function getMesCategories(BddManager $bddManager){
        if(empty($this->getId()) == false){
            $this->mesCategories = $bddManager->getCategoriesRepository()->getMesCategoriesFromAnnonce($this);
        }
    }

    public function deleteAnnonce(BddManager $bddManager){
        $bddManager->getAnnonceRepository()->deleteAnnonce($this);
    }
}