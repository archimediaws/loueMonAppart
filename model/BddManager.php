<?php

class BddManager
{

    public $connexion;
    private $annonceRepository;
    private $categoriesRepository;
    private $userRepository;

   
    public function getAnnonceRepository()
    {
        return $this->annonceRepository;
    }

   
    public function setAnnonceRepository($annonceRepository)
    {
        $this->annonceRepository = $annonceRepository;
    }

  
    public function getCategoriesRepository()
    {
        return $this->categoriesRepository;
    }

   
    public function setCategoriesRepository($categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

  
    public function getUserRepository()
    {
        return $this->userRepository;
    }

   
    public function setUserRepository($userRepository)
    {
        $this->userRepository = $userRepository;
    }



    public function __construct()
    {
        $this->connexion = Connexion::getConnexion();
        $this->setAnnonceRepository(new AnnonceRepository($this->connexion));
        $this->setCategoriesRepository(new CategoriesRepository($this->connexion));
        $this->setUserRepository(new UserRepository($this->connexion));
    }

}