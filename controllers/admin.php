<?php

require_once "models/dependenciamodel.php";
require_once "models/actasmodel.php";

class Admin extends SessionController{

    private $user;
    function __construct(){
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function render(){
        $this->view->render('admin/index', ["user"=>$this->user]);
    }
    function listDependencias(){
        /*$dependencias = [
            "dependencia" => "gregorio",
        ];*/
       $dependencias= [];
       $dependenciaModel = new DependenciaModel();
       $dependencias = $dependenciaModel->getAll();
       /*error_log('Admin::getDependencia() => new dependencia created' . var_dump($dependencias));*/
       
       $this->view->render('admin/list-dependencia', [
           'dependencias' => $dependencias,
           'user'=>$this->user
           ]);
    }
 
    
    function listUsuarios(){
       $usuarios= [];
       $userModel = new userModel();
       $usuarios = $userModel->getAll();
       /*error_log('Admin::getDependencia() => new dependencia created' . var_dump($dependencias));*/
       
       $this->view->render('admin/list-usuarios', [
           'usuarios' => $usuarios,
           'user'=>$this->user
           ]);
    }

    function listActas(){
        $actas= [];
        $actasModel = new ActasModel();
        $actas = $actasModel->getAll();
        /*error_log('Admin::getDependencia() => new dependencia created' . var_dump($dependencias));*/
        
        $this->view->render('admin/list-actas', [
            'actas' => $actas,
            'user'=>$this->user
            ]);
     }

    function perfil(){
        $this->view->render('admin/perfil', ["user"=>$this->user]);
    }
}
?>