<?php



class User
{
    private $id;
    private $nom;
    private $password;
    private $email;
    private $annonce_id;

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

  
    public function getUsername()
    {
        return $this->nom;
    }

  
    public function setUsername($nom)
    {
        $this->nom = $nom;
    }

    public function getPassword()
    {
        return $this->password;
    }

  
    public function setPassword($password)
    {
        $this->password = $password;
    }



    public function getEmail()
    {
        return $this->email;
    }

   
    public function setEmail($email)
    {
        $this->email = $email;
    }

    
    public function getAnnonceId()
    {
        return $this->annonce_id;
    }

   
    public function setAnnonceId($annonce_id)
    {
        $this->annonce_id = $annonce_id;
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
        return $bddManager->getUserRepository()->saveUserBdd($this);
    }
}