<?php
class RegisterService
{
    private $params;
    private $error;
    private $user;
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
    public function getUser()
    {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user=$user;
    }
    public function launchControls()
        {
   
        if(empty($this->params['username'])){
            $this->error['username'] = 'Le nom de l\'utilisateur n\'est pas renseigner';
        }
       
        if(empty($this->params['email'])){
            $this->error['email'] = 'Le email n\'est pas renseigner';
        }
       
        if(empty($this->params['password'])){
            $this->error['password'] = 'Le mot de passe n\'est pas renseigner' ;
        }
        
    
        
        $pass = $this->params['password'];
        $pass = strlen($pass);
        if($pass<3 || $pass>16){
            $this->error['passwordLength'] = 'Votre mot de passe doit avoir entre 3 a 16 caractere';
        }
        if (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $this->params['email']))
        {
           $this->error['email'] = 'Votre email n\'est pas conforme'; 
        }
        if(empty($this->error) == false)
        {
        ;
        return $this->error;
        }
        $this->user = $this->checkAll();
        if(empty($this->user)){
            $this->error['identifiant'] = 'Locataire deja existant';
            return $this->error;
        }
        else
        {
            return $this->user;
        }
        }
        public function checkAll(){
            $nom = $this->params['username'];
            $email = $this->params['email'];
            $connexion = new PDO('mysql:host=localhost;dbname=locappart;charset=UTF8','root','');
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $objet = $connexion->prepare('SELECT username, email FROM user WHERE username=:username AND email=:email');
            $objet->execute(array(
                'email' => $this->params['email'],
                'username' => $this->params['username']
            ));
            $user = $objet->fetchAll(PDO::FETCH_ASSOC);
            if(empty($user)){
                        
                        $password = $this->params['password'];
                        
                        
                        
                        $objet = $connexion->prepare('INSERT INTO user SET 
                            username=:username,
                            email=:email,
                            password=:password
                            ');
                        $objet->execute(array(
                        'username' => $nom,
                        'email' => $email,
                        'password' => $password
                        ));
                        $user = true;
                return $user;
            }
            return false;
        }
}