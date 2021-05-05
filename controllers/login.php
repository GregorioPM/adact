<?php
    class Login extends SessionController{

        function __construct(){
            parent:: __construct();
            error_log('Login::construct -> inicio login');
        }

        function render(){
            $this->view->render('login/index');
            error_log('Login::render -> carga Index login');
        }
    }
?>