<?php


class UserRepository
{
    private $connexion;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }

    public function saveUserBdd(User $user){
        if(empty($user->getId())){
            return $this->insertUser($user);
        }else{
            return $this->updateUser($user);
        }
    }

    public function insertUser(User $user){
        $query="INSERT INTO user SET username=:username, password=:password, email=:email, annonce_id=:annonceId";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'username'=>$user->getNom(),
            'password'=>$user->getPass(),
            'email' => $user->getEmail(),
            'annonceId'=>$user->getAnnonceId()
        ));
        return $pdo->rowCount();
    }

    public function updateUser(User $user){
        $query = 'UPDATE user SET username=:username, password=:password, email=:email, annonce_id=:annonceId WHERE id=:id';
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'username'=>$user->getNom(),
            'password'=>$user->getPass(),
            'email' => $user->getEmail(),
            'annonceId'=> $user->getAnnonceId()
        ));
        return $pdo->rowCount();
    }

    public function deleteUser(User $user){
        $object = $this->connexion->prepare('DELETE FROM user WHERE id=:id');
        $object->execute(array(
            'id'=>$user->getId()
        ));
        return  $object->rowCount();
    }
}