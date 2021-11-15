<?php

require_once "models/actasmodel.php";
require_once "models/temasmodel.php";
require_once "models/participantemodel.php";



class Acta extends SessionController
{

    private $user;
    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function newActa()
    {
        if ($this->existPOST(['lugar'])) {
            $asunto = $this->getPost('asunto');
            $lugar = $this->getPost('lugar');
            $temas = $this->getPost('temas');
            $participantes = $this->getPost('participantes');
            $fecha = $this->getPost('fecha');
            $horaInicio = $this->getPost('horaInicio');
            $horaFinal = $this->getPost('horaFinal');
            $dependencia = $this->getPost('dependencia');
            $orden = $this->getPost('orden');
            $conclusiones = $this->getPost('conclusiones');
            //error_log('HORAAAAAA' . $horaInicio);


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
            if($this->existPOST(['participantes'])){
                $actasModel->setEstado("Revisión");
            }
            $actasModel->save();

            $ultimoId = $actasModel->obtenerUltimoId();
            foreach ($temas as $tema) {
                $temasmodel = new TemasModel();
                $temasmodel->setIdActa($ultimoId);
                $temasmodel->setDescripcion($tema);
                $temasmodel->save();
            }
            foreach ($participantes as $participante) {
                $participantemodel = new ParticipanteModel();
                $participantemodel->setIdActa($ultimoId);
                $participantemodel->setIdUsuario($participante);
                $participantemodel->setEstado("Revisión");
                $participantemodel->save();
            }

            $this->redirect('admin/listActas', ['success' => SuccessMessages::SUCCESS_ADMIN_NEWACTA]);
        }
    }

    function deleteActa()
    {
        $id = $_GET['id'];
        $actasModel = new ActasModel();
        if ($actasModel->delete($id)) {
            $this->redirect('admin/listActas', ['success' => SuccessMessages::SUCCESS_ADMIN_DELETEACTA]);
        } else {
            $this->redirect('admin/listActas', ['error' => ErrorMessages::ERROR_ADMIN_ACTAPARTICIPANTE]);
        }
    }

    function filtrarActa(){
        $string = $_POST["buscar"];
        error_log('ENTRO A BUSCAR' . $string);
        $actasModel = new ActasModel();
        if($actasModel->filtrarPorAsunto($string)){
            error_log('ENTRO A BUSCAR2 ' . $string);
            $this->redirect('admin/listActas', []);
        }

    }

    function updateActa(){
        $id = $_POST['idacta'];
        if(isset($id)){
            $asunto = $this->getPost('asunto');
            $lugar = $this->getPost('lugar');
            $temas = $this->getPost('temas');
            $participantes = $this->getPost('participantes');
            $fecha = $this->getPost('fecha');
            $horaInicio = $this->getPost('horaInicio');
            $horaFinal = $this->getPost('horaFinal');
            $dependencia = $this->getPost('dependencia');
            $orden = $this->getPost('orden');
            $conclusiones = $this->getPost('conclusiones');
            error_log('SIGNUP::UPDATE() => ENTRA A UPDATEV333: ' . $dependencia);      

            $actasModel = new ActasModel();
            $actasModel->setId($id);
            $actasModel->setAsunto($asunto);
            $actasModel->setLugar($lugar);
            $actasModel->setIdDependencia($dependencia);
            $actasModel->setFecha($fecha);
            $actasModel->setHoraInicio($horaInicio);
            $actasModel->setHoraFinal($horaFinal);
            $actasModel->setOrden($orden);
            $actasModel->setConclusiones($conclusiones);
            if($actasModel->update($actasModel)){
                foreach ($temas as $tema) {
                    $temasmodel = new TemasModel();
                    $temasmodel->setIdActa($id);
                    $temasmodel->setDescripcion($tema);
                    $temasmodel->save();
                }
                foreach ($participantes as $participante) {
                    $participantemodel = new ParticipanteModel();
                    $participantemodel->setIdActa($id);
                    $participantemodel->setIdUsuario($participante);
                    $participantemodel->setEstado("Revisión");
                    $participantemodel->save();
                }
            }
            $this->redirect('admin/detalleActa?id='.$id, []);
        }
    }
}
