<?php
require_once 'models/userModel.php';

class LoginModel extends model{

    function __construct(){
        parent:: __construct();
    }

    function login($correo, $password){
          // insertar datos en la BD
          
          try{
              //$query = $this->db->connect()->prepare('SELECT * FROM users WHERE username = :username');
              $query = $this->prepare('SELECT * FROM usuario WHERE correo = :correo');
              $query->execute(['correo' => $correo]);
              
              if($query->rowCount() == 1){
                  $item = $query->fetch(PDO::FETCH_ASSOC); 
  
                  $user = new UserModel();
                  $user->from($item);
  
                  error_log('login: user id '.$user->getId());
  
                  if(password_verify($password, $user->getPass())){
                      error_log('loginModel::login ->success');
                      //return ['id' => $item['id'], 'username' => $item['username'], 'role' => $item['role']];
                      return $user;
                      //return $user->getId();
                  }else{
                      return NULL;
                  }
              }
          }catch(PDOException $e){
            error_log("loginModel::login->exception" . $e);
              return NULL;
          }
    }
}

?>