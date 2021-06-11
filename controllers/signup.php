<?php
require_once 'models/userModel.php';

class Signup extends SessionController
{

    private $user;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function render()
    {
        $this->view->errorMessage = '';
        $this->view->render('admin/signup', []);
    }


    function newUser()
    {
        if ($this->existPOST(['correo', 'pass', 'nombres', 'apellidos'])) {
            $correo = $this->getPost('correo');
            $pass = $this->getPost('pass');
            $nombres = $this->getPost('nombres');
            $apellidos = $this->getPost('apellidos');
            $cargo = $this->getPost('cargo');
            $user = new userModel();
            $user->setCorreo($correo);
            $user->setPass($pass);
            $user->setRol("user");
            $user->setNombres($nombres);
            $user->setApellidos($apellidos);
            $user->setCargo($cargo);

            //validate data
            if ($correo === '' || empty($correo) || $pass === '' || empty($pass) || $nombres === '' || empty($nombres) || $apellidos === '' || empty($apellidos) || $cargo === '' || empty($cargo)) {
                // error al validar datos
                //$this->errorAtSignup('Campos vacios');
                $this->redirect('admin/listUsuarios', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
            } else  if ($user->exists($correo)) {
                //$this->errorAtSignup('Error al registrar el usuario. Elige un nombre de usuario diferente');
                $this->redirect('admin/listUsuarios', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
                //return;
            } else if ($user->save()) {
                //$this->view->render('login/index');

                $this->redirect('admin/listUsuarios', ['success' => SuccessMessages::SUCCESS_SIGNUP_NEWUSER]);
            } else {
                /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                return; */
                $this->redirect('admin/listUsuarios', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
            }
        } else {
            // error, cargar vista con errores
            //$this->errorAtSignup('Ingresa nombre de usuario y password');
            $this->redirect('admin/listUsuarios', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
        }
    }

    function deleteUser()
    {
        $id = $_GET['id'];
        $userModel = new UserModel();
        $userModel->delete($id);
        $this->redirect('admin/listUsuarios', []);
    }

    function updateUser()
    {
        if ($this->existPOST(['correo', 'nombres', 'apellidos', 'telefono'])) {
            $id = $this->getPost('id');
            $correo = $this->getPost('correo');
            $telefono = $this->getPost('telefono');
            $nombres = $this->getPost('nombres');
            $apellidos = $this->getPost('apellidos');
            $cargo = $this->getPost('cargo');
            $userActual = $this->getUserSessionData();
            $userModel = new userModel();
             
            if ($correo === '' || empty($correo) || $telefono === '' || empty($telefono) || $nombres === '' || empty($nombres) || $apellidos === '' || empty($apellidos)) {
                $this->redirect('admin/perfil', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
            } else if (!$userModel->exists($correo)|| $userActual->getCorreo()==$correo)  {
                $userModel->setId($id);
                $userModel->setCorreo($correo);
                $userModel->setTelefono($telefono);
                $userModel->setNombres($nombres);
                $userModel->setApellidos($apellidos);
                $userModel->setCargo($cargo);
                $userModel->update($userModel);
                $p = $_FILES['photo'];
                if($p['name']){
                    $photo = $_FILES['photo'] ?? "";
                    $target_dir = "public/img/fotos/";
                    $extension = explode('.', $photo["name"]);
                    $filename = $extension[sizeof($extension) - 2];
                    $ext = $extension[sizeof($extension) - 1];
                    $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
                    $target_file = $target_dir . $hash;
                    $uploadOk = FALSE;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    $check = getimagesize($photo["tmp_name"]);
                    if ($check !== false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = TRUE;
                    } else {
                        //echo "File is not an image.";
                        $uploadOk = FALSE;
                    }

                    if ($uploadOk == FALSE) {
                        //echo "Sorry, your file was not uploaded.";
                        if($userActual->getRol()=="admin"){
                            $this->redirect('admin/perfil', []);
                            error_log('Admin::newDependencia() => SI ENTRA A ADMIN ACTUALIZAR 2');
                        }else{
                            $this->redirect('dashboard/perfil', []);
                        }
                    } else {
                        if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                            $userModel = new UserModel();
                            $userModel->updatePhoto($hash, $this->user->getId());
                            if($userActual->getRol()=="admin"){
                                $this->redirect('admin/perfil', []);
                                error_log('Admin::newDependencia() => SI ENTRA A ADMIN ACTUALIZAR ');
                            }else{
                                $this->redirect('dashboard/perfil', []);
                            }
                           
                        } else {
                            if($userActual->getRol()=="admin"){
                                $this->redirect('admin/perfil', []);
                                error_log('Admin::newDependencia() => SI ENTRA A ADMIN ACTUALIZAR 2');
                            }else{
                                $this->redirect('dashboard/perfil', []);
                            }
                        }
                    }
                }
                if($userActual->getRol()=="admin"){
                    $this->redirect('admin/perfil', ['success' => SuccessMessages::SUCCESS_PERFIL_UPDATE]);  
                    error_log('Admin::newDependencia() => SI ENTRA A ADMIN ACTUALIZAR 2');
                }else{
                    $this->redirect('dashboard/perfil', ['success' => SuccessMessages::SUCCESS_PERFIL_UPDATE]);
                }
                //error_log('SIGNUP::UPDATE() => ENTRA A UPDATE' . $userModel->getNombres());
                        
            } else {
                if($userActual->getRol()=="admin"){
                    $this->redirect('admin/perfil', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);  
                    error_log('Admin::newDependencia() => SI ENTRA A ADMIN ACTUALIZAR 2');
                }else{
                    $this->redirect('dashboard/perfil', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
                }
               
            }
        }
    }
}
