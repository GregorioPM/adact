<?php
    class Dashboard extends SessionController{

        private $user;

        function __construct(){
            parent:: __construct();
            $this->user = $this->getUserSessionData();
            error_log('Dashboard::construct -> inicio login');
        }
        function render(){
            $this->view->render('dashboard/index', ["user"=>$this->user]);
          
            error_log('Dashboard::render -> carga Index usuario');
        }
        
        function perfil()
    {
        $this->view->render('dashboard/perfil', ["user" => $this->user]);
    }

        public function getActas(){

        }

        public function getDependencias(){

        }
    }
?>