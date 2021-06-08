<?php

require_once "models/dependenciamodel.php";
require_once "models/actasmodel.php";
require_once "models/temasmodel.php";
require_once "models/userModel.php";
require_once "models/compromisosmodel.php";
require_once "models/participantemodel.php";



class Admin extends SessionController
{

    private $user;
    private $datos = [];
    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function render()
    {
        $actasModel = new ActasModel();
        $dependenciaModel = new DependenciaModel();
        $userModel = new userModel();
        $compromisosModel = new CompromisosModel();
        $totalActas = $actasModel->totalActas();
        $totalActasAprovadas = $actasModel->totalActasAprovadas();
        $totalActasRevision = $actasModel->totalActasRevision();
        $totalDependencias = $dependenciaModel->totalDependencias();
        $totalUsers = $userModel->totalUsuarios();
        $totalCompromisos = $compromisosModel->misCompromisos($this->user->getId());

        $this->view->render('admin/index', [
            "user" => $this->user,
            "totalActas" => $totalActas,
            "totalActasAprovadas" => $totalActasAprovadas,
            "totalActasRevision" => $totalActasRevision,
            "totalDependencias" => $totalDependencias,
            "totalUsers" => $totalUsers,
            "totalCompromisos" => $totalCompromisos

        ]);
    }
    function deleteTema()
    {
        $id = $_GET['id'];
        $idacta = $_GET['idacta'];
        $temasModel = new TemasModel();
        $temasModel->delete($id);
        $this->redirect('admin/detalleActa?id=' . $idacta, []);
    }

    function deleteParticipante()
    {
        $id = $_GET['id'];
        $idacta = $_GET['idacta'];
        $participanteModel = new ParticipanteModel();
        $participanteModel->delete($id);
        $this->redirect('admin/detalleActa?id=' . $idacta, []);
    }

    function listDependencias()
    {
        /*$dependencias = [
            "dependencia" => "gregorio",
        ];*/
        $dependencias = [];
        $dependenciaModel = new DependenciaModel();
        $dependencias = $dependenciaModel->getAll();
        /*error_log('Admin::getDependencia() => new dependencia created' . var_dump($dependencias));*/

        $this->view->render('admin/list-dependencia', [
            'dependencias' => $dependencias,
            'user' => $this->user
        ]);
    }


    function listUsuarios()
    {
        $usuarios = [];
        $userModel = new userModel();
        $usuarios = $userModel->getAll();
        /*error_log('Admin::getDependencia() => new dependencia created' . var_dump($dependencias));*/

        $this->view->render('admin/list-usuarios', [
            'usuarios' => $usuarios,
            'user' => $this->user
        ]);
    }

    function listActas()
    {
        $actas = [];
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
                $e = "Revisión";
                $a = $actasModel->updateEstado($acta->getId(), $e);
            }
        }
        /*error_log('Admin::getDependencia() => new dependencia created' . var_dump($dependencias));*/
        $actas = $actasModel->getAll();

        $this->view->render('admin/list-actas', [
            'actas' => $actas,
            'user' => $this->user
        ]);
    }

    function perfil()
    {
        $this->view->render('admin/perfil', ["user" => $this->user]);
    }
    function detalleActas()
    {
        $id = $_GET['id'];
        $actasModel = new ActasModel();
        $acta = $actasModel->get($id);
    }
    function detalleActa()
    {
        if (isset($_POST['estado'])) {
            $a = $_POST['idacta'];
            $u = $_POST['idusuario'];
            $participanteModel = new ParticipanteModel();
            $participante = $participanteModel->getParticipante($a, $u);
            $participanteModel->setid($participante);
            $participanteModel->setEstado("Aprobado");
            $participanteModel->update($participanteModel);
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $temas = [];
            $participantes = [];
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
            $acta = $actasModel->get($id);
            $this->view->render('admin/detalle-acta', [
                "user" => $this->user,
                'dependencias' => $dependencias,
                'usuarios' => $usuarios,
                'temas' => $temas,
                'acta' => $acta,
                'participantes' => $participantes,
                'compromisos' => $compromisos,
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
    function listCompromisos()
    {
        $compromisos = [];
        $compromisosModel = new CompromisosModel();
        $user = $this->getUserSessionData();
        $compromisos = $compromisosModel->totalCompromisos($user->getId());
        $this->view->render('admin/list-compromisos', [
            'compromisos' => $compromisos,
            'user' => $this->user
        ]);
    }

    function datosTemas()
    {
        $temas = $_POST['temas'];
        $datos[] = [$temas];
        echo json_encode($datos);
    }
    function datosParticipantes()
    {
        $participantes = $_POST['id'];
        $nombres = $_POST['nombre'];
        $datos[] = [$participantes, $nombres];
        echo json_encode($datos);
    }
    function datosCompromisos()
    {
        $participantes = $_POST['id'];
        $nombres = $_POST['nombre'];
        $datos[] = [$participantes, $nombres];
        echo json_encode($datos);
    }
}
