<?php
require_once 'models/userModel.php';

class Signup extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function render(){
        $this->view->errorMessage = '';
        $this->view->render('admin/signup', []);
    }

    
    function newUser(){
        if($this->existPOST(['correo', 'password' , 'nombres' , 'apellidos'])){
            $correo = $this->getPost('correo');
            $password = $this->getPost('password');
            $nombres= $this->getPost('nombres');
            $apellidos= $this->getPost('apellidos');
            $user = new userModel();
            $user->setCorreo($correo);
            $user->setPassword($password);
            $user->setRol("user");
            $user->setNombres($nombres);
            $user->setApellidos($apellidos);
            //validate data
            if($correo === '' || empty($correo) || $password === '' || empty($password) || $nombres==='' || empty($nombres) || $apellidos==='' || empty($apellidos) ){
                // error al validar datos
                //$this->errorAtSignup('Campos vacios');
                $this->redirect('admin/listUsuarios', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }else  if($user->exists($correo)){
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

    function deleteUser(){
        $id = $_GET['id'];
        $userModel = new UserModel();
        $userModel->delete($id);
        $this->redirect('admin/listUsuarios', []);
    }

    function updateUser(){
        $photo = $_FILES['photo'] ?? "";

        $target_dir = "public/img/fotos/";
        $extension = explode('.',$photo["name"]);
        $filename = $extension[sizeof($extension)-2];
        $ext = $extension[sizeof($extension)-1];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $target_file = $target_dir . $hash;
        $uploadOk = FALSE;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        $check = getimagesize($photo["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = TRUE;
        } else {
            //echo "File is not an image.";
            $uploadOk = FALSE;
        }

        if ($uploadOk == FALSE) {
            //echo "Sorry, your file was not uploaded.";
            $this->redirect('admin/perfil', ['error' => Errors::ERROR_USER_UPDATEPHOTO_FORMAT]);
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                $userModel = new UserModel();
                $userModel->updatePhoto($hash, $this->user->getId());
                $this->redirect('admin/perfil', []);
            } else {
                $this->redirect('admin/perfil', ['error' => Errors::ERROR_USER_UPDATEPHOTO]);
            }
        }
    }
}

?>

