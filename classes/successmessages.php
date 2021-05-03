<?php

    class SuccessMessages{

        const  SUCCESS_ADMIN_NEWDEPENDENCY= "ab25333de7e87679a13981cb9689a7e1";

        private $successList = [];


        public function __construct(){
            $this->successList = [ 
                SuccessMessages::SUCCESS_ADMIN_NEWDEPENDENCY => 'Dependencia Agregada con éxito',
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