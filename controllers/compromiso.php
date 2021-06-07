<?php

require_once "models/compromisosmodel.php";

class Compromiso extends SessionController
{

    private $user;
    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function newCompromiso()
    {

        $id = $_POST['idacta'];
        if($this->existPOST(['idacta'])){
            $participante=[];
            $compromisos=[];
            $fechas=[];
            $participante=$this->getPost('participantes');
            $compromisos=$this->getPost('compromisos');
            $fechas=$this->getPost('fecha');
            $array_num = count($participante);
            for ($i = 0; $i < $array_num; ++$i){
                $compromisoModel = new CompromisosModel();
                $compromisoModel->setIdParticipante($participante[$i]);
                $compromisoModel->setIdActa($id);
                $compromisoModel->setCompromiso($compromisos[$i]);
                $compromisoModel->setFecha($fechas[$i]);
                $compromisoModel->save();
            }
            
        }
        $this->redirect('admin/detalleActa?id='.$id,[]);
    }
}
