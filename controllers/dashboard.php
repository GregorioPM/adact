<?php

require_once "models/actasmodel.php";
require_once "models/dependenciamodel.php";
require_once "models/temasmodel.php";
require_once "models/participantemodel.php";
require_once "models/compromisosmodel.php";



class Dashboard extends SessionController
{

    private $user;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
        error_log('Dashboard::construct -> inicio login');
    }
    function render()
    {
        $participanteModel = new ParticipanteModel();
        $actasModel = new ActasModel();
        $compromisosModel = new CompromisosModel();
        $totalActasAprobadas= $actasModel->totalActasAprobadaParticipante($this->user->getId());
        $totalActasRevision= $actasModel->totalActasRevisionParticipante($this->user->getId());
        $totalParticipaciones = $participanteModel->misParticipaciones($this->user->getId());
        $totalCompromisos = $compromisosModel->misCompromisos($this->user->getId());
        
        $this->view->render('dashboard/index', [
            "user" => $this->user,
            "totalParticipaciones"=>$totalParticipaciones,
            "totalActasAprobadas"=>$totalActasAprobadas,
            "totalActasRevision"=>$totalActasRevision,
            "totalCompromisos"=>$totalCompromisos
            ]);

        error_log('Dashboard::render -> carga Index usuario');
    }

    function perfil()
    {
        $this->view->render('dashboard/perfil', ["user" => $this->user]);
    }

    public function getActas()
    {
    }

    public function getDependencias()
    {
    }

    function listParticipaciones()
    {
            $actas = [];
            $actasModel = new ActasModel();
            $user=$this->getUserSessionData();
             
            $actas = $actasModel->misParticipaciones($user->getId());
            $this->view->render('dashboard/list-participaciones', [
                'actas' => $actas,
                'user' => $this->user
            ]);
        
    }

    function listCompromisos()
    {
            $compromisos = [];
            $compromisosModel = new CompromisosModel();
            $user=$this->getUserSessionData();
            $compromisos=$compromisosModel->totalCompromisos($user->getId());
            $this->view->render('dashboard/list-compromisos', [
                'compromisos' => $compromisos,
                'user' => $this->user
            ]);
        
    }
    function detalleActa()
    {

        if(isset($_POST['estado'])){
            error_log('EEEEEEEEEEEE' .$_POST['estado']);
            $a = $_POST['idacta'];
            $u = $_POST['idusuario'];
            $participanteModel=new ParticipanteModel();
            $participante=$participanteModel->getParticipante($a,$u);
            $participanteModel->setid($participante);
            $participanteModel->setEstado("Aprobado");
            $participanteModel->update($participanteModel);
            $actasModel = new ActasModel();
            $actas2 = $actasModel->getAll();
        foreach ($actas2 as $acta) {
            $aprovados = $actasModel->getAprovados($acta->getId());
            $participantes = $acta->getTotalParticipantes();
            if (($participantes % 2) == 0) {
                $aprovacion = (($participantes / 2) + 1);
            } else {
                $aprovacion = (($participantes / 2) + 0.5);
            }
            error_log($aprovados);
            error_log($aprovacion);

            if ($aprovados >= $aprovacion) {
                $e = "Aprobado";
                $a = $actasModel->updateEstado($acta->getId(), $e);
            } else {
                $e = "Revisi??n";
                $a = $actasModel->updateEstado($acta->getId(), $e);
            }
        }

            //error_log('Dashboard::render -> carga Index usuario' .print_r($participante));

        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $temas = [];
            $participantes=[];
            $dependenciaModel = new DependenciaModel();
            $dependencias = $dependenciaModel->getAll();
            $userModel = new userModel();
            $usuarios = $userModel->getAll();
            $temasModel = new TemasModel();
            $temas = $temasModel->getAll($id);
            $actasModel = new ActasModel();
            $participantesModel = new ParticipanteModel();
            $participantes = $participantesModel->getAll($id);
            $compromisosModel = new CompromisosModel();
            $compromisos = $compromisosModel->getAll($id);
            $estado = $userModel->estadoParticipante($this->user->getId(),$id);
            error_log("ESTADO ACTA" . $estado);
            $acta = $actasModel->get($id);
            $this->view->render('dashboard/detalle-acta', [
                "user" => $this->user,
                'dependencias' => $dependencias,
                'usuarios' => $usuarios,
                'temas' => $temas,
                'acta'=> $acta,
                'participantes' =>$participantes,
                'compromisos' =>$compromisos,
                'estado'=>$estado
            ]);
        } else {
            $dependenciaModel = new DependenciaModel();
            $dependencias = $dependenciaModel->getAll();
            $userModel = new userModel();
            $usuarios = $userModel->getAll();
            $this->view->render('admin/detalle-acta', [
                "user" => $this->user,
                'dependencias' => $dependencias,
                'usuarios' => $usuarios,
            ]);
        }
    }
}
