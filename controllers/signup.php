<?php
require_once 'models/userModel.php';

class Signup extends SessionController{

    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->errorMessage = '';
        $this->view->render('admin/signup', []);
    }

    
    function newUser(){
        if($this->existPOST(['correo', 'password'])){
            
            $correo = $this->getPost('correo');
            $password = $this->getPost('password');
            
            //validate data
            if($correo == '' || empty($correo) || $password == '' || empty($password)){
                // error al validar datos
                //$this->errorAtSignup('Campos vacios');
                $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }

            $user = new userModel();
            $user->setCorreo($correo);
            $user->setPassword($password);
            $user->setRol("user");
            
            if($user->exists($correo)){
                //$this->errorAtSignup('Error al registrar el usuario. Elige un nombre de usuario diferente');
                $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
                //return;
            }else if($user->save()){
                //$this->view->render('login/index');
                $this->redirect('', ['success' => SuccessMessages::SUCCESS_SIGNUP_NEWUSER]);
            }else{
                /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                return; */
                $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
            }
        }else{
            // error, cargar vista con errores
            //$this->errorAtSignup('Ingresa nombre de usuario y password');
            $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
        }
    }
}

?>

