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
            $fecha = $this->getPost('fecha');
            $horaInicio = $this->getPost('horaInicio');
            $horaFinal = $this->getPost('horaFinal');
            $dependencia=$this->getPost('dependencia');
            $orden= $this->getPost('orden');
            $conclusiones = $this->getPost('conclusiones');
            error_log('HORAAAAAA' . $horaInicio);

    
            $actasModel = new ActasModel();
                $actasModel->setAsunto($asunto);
                $actasModel->setLugar($lugar);
                $actasModel->setEstado("Creada");
                $actasModel->setIdDependencia($dependencia);
                $actasModel->setFecha($fecha);
                $actasModel->setHoraInicio($horaInicio);
                $actasModel->setHoraFinal($horaFinal);
                $actasModel->setOrden($orden);
                $actasModel->setConclusiones($conclusiones);
                $actasModel->save();
                
                $ultimoId = $actasModel->obtenerUltimoId();
                foreach($temas as $tema){
                     $temasmodel = new TemasModel();
                     $temasmodel->setIdActa($ultimoId);
                     $temasmodel->setDescripcion($tema);
                     $temasmodel->save();
                }
                $this->redirect('admin/listActas', ['success' => SuccessMessages::SUCCESS_ADMIN_NEWACTA]);
            
        }
    }

    function deleteActa(){
        $id = $_GET['id'];
        $actasModel = new ActasModel();
        if($actasModel->delete($id)){
            $this->redirect('admin/listActas', ['success' => SuccessMessages::SUCCESS_ADMIN_DELETEACTA]);
        }else{
            $this->redirect('admin/listActas', ['error' => ErrorMessages::ERROR_ADMIN_ACTAPARTICIPANTE]);
        }
        
        
    }
}
