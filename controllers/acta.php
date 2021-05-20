<?php

require_once "models/actasmodel.php";

class Acta extends SessionController{
    
    private $user;
    function __construct(){
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function newActa(){
        if($this->existPOST(['lugar'])){
            $asunto = $this->getPost('asunto');
            $lugar = $this->getPost('lugar');
            error_log('Admin::newDependencia() => new dependencia created' . $asunto);
            $fecha = $this->getPost('fecha');
            $dependencia=$this->getPost('dependencia');

    
            $actasModel = new ActasModel();
                $actasModel->setAsunto($asunto);
                $actasModel->setLugar($lugar);
                $actasModel->setEstado("Creada");
                $actasModel->setIdDependencia($dependencia);
                $actasModel->save();
                //$this->view->render('admin/list-dependencia', []);
                $this->redirect('admin/listActas', ['success' => SuccessMessages::SUCCESS_ADMIN_NEWDEPENDENCY]);
            
        }
    }
}
