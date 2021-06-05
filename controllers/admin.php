<?php

require_once "models/dependenciamodel.php";
require_once "models/actasmodel.php";
require_once "models/temasmodel.php";


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
        $this->view->render('admin/index', ["user" => $this->user]);
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
        $actas = $actasModel->getAll();
        /*error_log('Admin::getDependencia() => new dependencia created' . var_dump($dependencias));*/

        $this->view->render('admin/list-actas', [
            'actas' => $actas,
            'user' => $this->user
        ]);
    }

    function perfil()
    {
        $this->view->render('admin/perfil', ["user" => $this->user]);
    }
    function detalleActas(){
        $id = $_GET['id'];
        $actasModel = new ActasModel();
        $acta= $actasModel->get($id);
        
    }
    function detalleActa()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $dependenciaModel = new DependenciaModel();
            $dependencias = $dependenciaModel->getAll();
            $userModel = new userModel();
            $usuarios = $userModel->getAll();
            $temasModel = new TemasModel();
            $temas = $temasModel->getAll($id);
            $actasModel = new ActasModel();
            $acta = $actasModel->get($id);
            $this->view->render('admin/detalle-acta', [
                "user" => $this->user,
                'dependencias' => $dependencias,
                'usuarios' => $usuarios,
                'temas' => $temas,
                'acta'=> $acta
            ]);
        } else {
            $dependenciaModel = new DependenciaModel();
            $dependencias = $dependenciaModel->getAll();
            $userModel = new userModel();
            $usuarios = $userModel->getAll();
            $this->view->render('admin/detalle-acta', [
                "user" => $this->user,
                'dependencias' => $dependencias,
                'usuarios' => $usuarios
            ]);
        }
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
        $datos[]=[$participantes , $nombres];
        error_log('Admin::newDependencia() => SI ENTRA A PARTICIPANTES ' . $participantes." " .$nombres);
        echo json_encode($datos);
    }
}
