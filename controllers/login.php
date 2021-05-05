<?php
    class Login extends SessionController{

        function __construct(){
            parent:: __construct();
            error_log('Login::construct -> inicio login');
        }

        function render(){
            $this->view->render('login/index');
            error_log('Login::render -> carga Index login');
        }

        function authenticate(){
            if( $this->existPOST(['correo', 'password']) ){
                $correo = $this->getPost('correo');
                $password = $this->getPost('password');
    
                //validate data
                if($correo == '' || empty($correo) || $password == '' || empty($password)){
                    //$this->errorAtLogin('Campos vacios');
                    error_log('Login::authenticate() empty');
                    $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
                    return;
                }
                // si el login es exitoso regresa solo el ID del usuario
                
                $user = $this->model->login($correo, $password);
    
                if($user != NULL){
                    // inicializa el proceso de las sesiones
                    error_log('Login::authenticate() passed');    
                    $this->initialize($user);
                }else{
                    //error al registrar, que intente de nuevo
                    //$this->errorAtLogin('Nombre de usuario y/o password incorrecto');
                    error_log('Login::authenticate() username and/or password wrong');
                    $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA]);
                    return;
                }
            }else{
                // error, cargar vista con errores
                //$this->errorAtLogin('Error al procesar solicitud');
                error_log('Login::authenticate() error with params');
                $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE]);
            }
        }
    }
?>