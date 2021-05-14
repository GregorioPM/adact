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
        if($this->existPOST(['correo', 'password' , 'nombres' , 'apellidos'])){
            error_log("entro porFINNN");
            $correo = $this->getPost('correo');
            $password = $this->getPost('password');
            $nombres= $this->getPost('nombres');
            $apellidos= $this->getPost('apellidos');
            
            //validate data
            if($correo == '' || empty($correo) || $password == '' || empty($password) || $nombres=='' || empty($nombres) || $apellidos=='' || empty($apellidos) ){
                // error al validar datos
                //$this->errorAtSignup('Campos vacios');
                $this->redirect('admin/listUsuarios', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }

            $user = new userModel();
            $user->setCorreo($correo);
            $user->setPassword($password);
            $user->setRol("user");
            $user->setNombres($nombres);
            $user->setApellidos($apellidos);
            
            if($user->exists($correo)){
                //$this->errorAtSignup('Error al registrar el usuario. Elige un nombre de usuario diferente');
                $this->redirect('admin/listUsuarios', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
                //return;
            }else if($user->save()){
                //$this->view->render('login/index');
                $this->redirect('admin/listUsuarios', ['success' => SuccessMessages::SUCCESS_SIGNUP_NEWUSER]);
            }else{
                /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                return; */
                $this->redirect('admin/listUsuarios', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
            }
        }else{
            // error, cargar vista con errores
            //$this->errorAtSignup('Ingresa nombre de usuario y password');
            $this->redirect('admin/listUsuarios', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
        }
    }
}

?>

