<?php


class NewPostService 
{

    private $params;
    private $error;
    private $annonce;



    public function getParams()
    {
        return $this->params;
    }
    public function setParams($params)
    {
        $this->params=$params;
    }
    public function getError()
    {
        return $this->error;
    }
    public function setError($error)
    {
        $this->error=$error;
    }
    public function getAnnonce()
    {
        return $this->annonce;
    }
    public function setAnnonce($annonce)
    {
        $this->annonce=$annonce;
    }
 
   
    public function launchControls()
        {
     
        if(empty($this->params['title'])){
            $this->error['type'] = 'Le titre n\'est pas renseigner';
        }
        
        
        if(empty($this->params['description'])){
            $this->error['description'] = 'Vous n\'avez pas decrit votre offre de location';
        }

        if(empty($this->params['categorie'])){
            $this->error['categorie'] = 'Vous n\'avez pas decrit votre categorie ';
        }
           
        if(empty($this->error) == false)
        {
        return $this->error;
        }
        $this->annonce = $this->insertNewAnnonce();
        
        return $this->annonce;
        
        }
        public function insertNewAnnonce(){
            // var_dump($this->params['categorie']);
            // die();
            $iduser = $_SESSION['user'][0]['id'];
            $date = date('d-m-y');
            

            $connexion = new PDO('mysql:host=localhost;dbname=locappart;charset=UTF8','root','');
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $objet = $connexion->prepare('INSERT INTO annonce SET 
                            poster_id=:poster_id,
                            title=:title,
                            description=:description,
                            date_post=:date_post,
                            category_id=:categorie
                           
                            ');
                        $objet->execute(array(
                            'poster_id'=>$iduser,
                            'title' =>$this->params['title'],
                            'description'=>$this->params['description'],
                            'date_post'=>$date,
                            'categorie'=>$this->params['categorie']                
                        ));
                        $annonce = true;
                return $annonce;
            
        }


}