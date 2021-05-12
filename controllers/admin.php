<?php

require_once "models/dependenciamodel.php";

class Admin extends SessionController{

    private $user;
    function __construct(){
        parent::__construct();
    }

    function render(){

        $this->view->render('admin/index', []);
    }

    function detalleDependencia(){
        //$id = $_GET['id'];
            error_log('ADMIN::CREARDEPENDENCIA -> Nueva Dependencia');
            $this->view->render('admin/creardependencia', []);
           //$this->view->render('admin/creardependencia', []);
    }

    function crearDependencia(){
        error_log('ADMIN::NUEVADEPENDENCIA -> Creada Dependencia');
        if($this->existPOST(['dependencia'])){
            $dependencia = $this->getPost('dependenciaa');

            $dependenciaModel = new DependenciaModel();

            if(!$dependenciaModel->exists($dependencia)){
                $dependenciaModel->setDependencia($dependencia);
                $dependenciaModel->save();
                error_log('Admin::newDependencia() => new dependencia created');
                //$this->view->render('admin/list-dependencia', []);
                $this->redirect('admin/getDependencias', []);
            }else{
                $this->redirect('admin/getDependencias', []);
            }
        }
    }

    function getDependencias(){
        /*$dependencias = [
            "dependencia" => "gregorio",
        ];*/
       $dependencias= [];
       $dependenciaModel = new DependenciaModel();
       $dependencias = $dependenciaModel->getAll();
       /*error_log('Admin::getDependencia() => new dependencia created' . var_dump($dependencias));*/
       
       $this->view->render('admin/list-dependencia', ['dependencias' => $dependencias]);
    }

    function deleteDependencias(){
       $id = $_GET['id'];
       $dependenciaModel = new DependenciaModel();
       $dependenciaModel->delete($id);
       $this->getDependencias();
       $this->redirect('admin/getDependencias', []);
    }

    function editDependencia(){
        $id = $_GET['id'];
        $dependenciaModel = new DependenciaModel();
        $dependencia =$dependenciaModel->get($id);
        //$this->redirect('admin/getDependencia', ['dependencia' => $dependencia]);
       $this->view->render('admin/modal', ['dependencia' => $dependencia]);
    }

    function updateDependencia(){
        error_log('Admin::UpdateDependencia() => ENTRO A UPDATEEEEEE');
        if($this->existPOST(['dependencia'])){
            $id = $this->getPost('id');
            $dependencia = $this->getPost('dependenciaa');
            //error_log('Admin::newDependencia() => OBTUVE IDDDDD' . $id);
            $dependenciaModel = new DependenciaModel();

            if(!$dependenciaModel->exists($dependencia)){
                $dependenciaModel->setDependencia($dependencia);
                $dependenciaModel->setId($id);
                
                error_log('Admin::UpdateDependencia() => OBTUVE IDDDDD' . $dependenciaModel->getDependencia());
                $dependenciaModel->update($dependenciaModel);
                /*$dependenciaModel->update(['id'=>$id , 'dependencia'=>$dependencia]);*/
                $this->redirect('admin/getDependencias', []);
            }else{
                $this->redirect('admin/getDependencias', []);
            }
        }
    
    }

}
?>