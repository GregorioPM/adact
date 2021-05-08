<?php
    class Dashboard extends SessionController{

        function __construct(){
            parent:: __construct();
            error_log('Dashboard::construct -> inicio login');
        }
        function render(){
            $this->view->render('dashboard/index', []);
            error_log('Dashboard::render -> carga Index usuario');
        }
        
        public function getActas(){

        }

        public function getDependencias(){

        }
    }
?>