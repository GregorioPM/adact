<?php

require_once "models/actasmodel.php";
require_once "models/temasmodel.php";


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
            $temas = $this->getPost('temas');
            foreach($temas as $tema){
                error_log('Admin::newDependencia() => new dependencia created' . $tema);

            }
            $fecha = $this->getPost('fecha');
            $dependencia=$this->getPost('dependencia');

    
            $actasModel = new ActasModel();
                $actasModel->setAsunto($asunto);
                $actasModel->setLugar($lugar);
                $actasModel->setEstado("Creada");
                $actasModel->setIdDependencia($dependencia);
                $actasModel->save();
                
                $ultimoId = $actasModel->obtenerUltimoId();
                foreach($temas as $tema){
                     $temasmodel = new TemasModel();
                     $temasmodel->setIdActa($ultimoId);
                     $temasmodel->setDescripcion($tema);
                     $temasmodel->save();
                }
                $this->redirect('admin/listActas', ['success' => SuccessMessages::SUCCESS_ADMIN_NEWDEPENDENCY]);
            
        }
    }
}
