<?php

require_once "models/dependenciamodel.php";

class Dependencia extends SessionController{

    private $user;
    function __construct(){
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function crearDependencia(){
        if($this->existPOST(['dependencia'])){
            $dependencia = $this->getPost('dependenciaa');
    
            $dependenciaModel = new DependenciaModel();
    
            if(!$dependenciaModel->exists($dependencia)){
                $dependenciaModel->setDependencia($dependencia);
                $dependenciaModel->save();
                error_log('Admin::newDependencia() => new dependencia created');
                //$this->view->render('admin/list-dependencia', []);
                $this->redirect('admin/listDependencias', ['success' => SuccessMessages::SUCCESS_ADMIN_NEWDEPENDENCY]);
            }else{
                $this->redirect('admin/listDependencias', ['error' => ErrorMessages::ERROR_ADMIN_NEWDEPENDENCY_EXISTS]);
            }
        }
    }
    
    
    function deleteDependencias(){
        $id = $_GET['id'];
        $dependenciaModel = new DependenciaModel();
        $dependenciaModel->delete($id);
        $this->redirect('admin/listDependencias', []);
     }
    
     function updateDependencia(){
        if($this->existPOST(['dependencia'])){
            $id = $this->getPost('id');
            $dependencia = $this->getPost('dependencia');
            $dependenciaModel = new DependenciaModel();

            if(!$dependenciaModel->exists($dependencia)){
                $dependenciaModel->setDependencia($dependencia);
                $dependenciaModel->setId($id);
                $dependenciaModel->update($dependenciaModel);
                /*$dependenciaModel->update(['id'=>$id , 'dependencia'=>$dependencia]);*/
                $this->redirect('admin/listDependencias', ['success' => SuccessMessages::SUCCESS_ADMIN_DEPENDENCY_UPDATE]);
            }else{
                $this->redirect('admin/listDependencias', ['error' => ErrorMessages::ERROR_ADMIN_NEWDEPENDENCY_EXISTS]);
            }
        }

    }
}


?>