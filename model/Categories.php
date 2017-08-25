<?php

class Categories
{
    private $id;
    private $category_name;
   

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

 
    public function getCategoryName()
    {
        return $this->category_name;
    }

   
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }


    public function hydrate(array $donneesPdo){

        if(empty($donneesPdo) == false){
            foreach ($donneesPdo as $key => $value){
                $newString=$key;
                if(preg_match("#_#",$key)){
                    $word = explode("_",$key);
                    $newString = "";
                    foreach ($word as $w){
                        $newString.=ucfirst($w);
                    }
                }
                $method = "set".ucfirst($newString);
                if(method_exists($this,$method)){
                    $this->$method($value);
                }
            }
        }
    }

    public function save(BddManager $bddManager){
        $bddManager->getCategoriesRepository()->saveCategoriesBdd($this);
    }

    public function delete(BddManager $bddManager){
        return $bddManager->getCategoriesRepository()->deleteCategories($this);
    }
}