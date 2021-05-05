<?php

    class SuccessMessages{

        const  SUCCESS_ADMIN_NEWDEPENDENCY= "ab25333de7e87679a13981cb9689a7e1";
        const  SUCCESS_SIGNUP_NEWUSER = "8281e04ed52ccfc13820d0f6acb0985a";

        private $successList = [];


        public function __construct(){
            $this->successList = [ 
                SuccessMessages::SUCCESS_ADMIN_NEWDEPENDENCY => 'Dependencia Agregada con éxito',
                SuccessMessages::SUCCESS_SIGNUP_NEWUSER => 'Usuario registrado correctamente',
            ];
        }

        public function get($hash){
            return $this->successList[$hash];
        }

        public function existsKey($key){
            if(array_key_exists($key, $this->successList)){
                return true;
            }else{
                return false;
            }
        }
    }

?>