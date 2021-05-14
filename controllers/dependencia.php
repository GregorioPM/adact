<?php

require_once "models/dependenciamodel.php";

class Dependencia extends SessionController{

    private $user;
    function __construct(){
        parent::__construct();
        $this->user = $this->getUserSessionData();
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
                $this->redirect('admin/listDependencias', []);
            }else{
                $this->redirect('admin/listDependencias', []);
            }
        }
    }
    
    
    
    function deleteDependencias(){
        $id = $_GET['id'];
        $dependenciaModel = new DependenciaModel();
        $dependenciaModel->delete($id);
        $this->getDependencias();
        $this->redirect('admin/listDependencias', []);
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
                 $this->redirect('admin/listDependencias', []);
             }else{
                 $this->redirect('admin/listDependencias', []);
             }
         }
     
     }
}


?>