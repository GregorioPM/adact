<?php

    class ErrorMessages{
        // ERROR_CONTROLLER_METODO_OPERACION
        const ERROR_ADMIN_NEWDEPENDENCY_EXISTS = "d04199919e5b63afcc591aba8b138710";

        private $errorList = [];

        public function __construct(){
            $this->errorList = [ 
                ErrorMessages::ERROR_ADMIN_NEWDEPENDENCY_EXISTS => 'El nombre de la dependencia ya existe, intenta otra',
            ];
        }

        public function get($hash){
            return $this->errorList[$hash];
        }

        public function existsKey($key){
            if(array_key_exists($key, $this->errorList)){
                return true;
            }else{
                return false;
            }
        }
    }

?>