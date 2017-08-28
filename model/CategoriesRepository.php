<?php


class CategoriesRepository
{
    private $connexion;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }


    public function getAllCategories(){
        $object = $this->connexion->prepare('SELECT * FROM categories');
        $object->execute(array());
        $categories = $object->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $c){
            $arrayObjet[] = new Categories($c);
        }

        return $arrayObjet;
    }



    public function saveCategoriesBdd(Categories $categories){
        if(empty($categories->getId())){
            return $this->insertCategories($categories);
        }else{
            return $this->updateCategories($categories);
        }
    }



    private function insertCategories(Categories $categories){
        $query="INSERT INTO categories SET category_name=:category_name ";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'titre'=>$categories->getCategoryName()
            
        ));
        return $pdo->rowCount();
    }

    private function updateCategories(Categories $categories){
        $query = 'UPDATE categories SET category_name=:category_name  WHERE id=:id';
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'titre'=>$categories->getCategoryName()
            
        ));
        return $pdo->rowCount();
    }

  

    public function deleteCategories(Categories $categories){
        $object = $this->connexion->prepare('DELETE FROM categories WHERE id=:id');
        $object->execute(array(
            'id'=>$categories->getId()
        ));
        return  $object->rowCount();
    }
}