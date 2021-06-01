<?php

    class SuccessMessages{

        const  SUCCESS_ADMIN_NEWDEPENDENCY= "ab25333de7e87679a13981cb9689a7e1";
        const  SUCCESS_ADMIN_NEWACTA= "523141fb15932c71576d3d9501866f9c";
        const  SUCCESS_SIGNUP_NEWUSER = "8281e04ed52ccfc13820d0f6acb0985a";
        const  SUCCESS_ADMIN_DEPENDENCY_UPDATE ="59c5655aaa9478237125e19d4cf22496";
        const  SUCCESS_PERFIL_UPDATE ="704ca811644c9c87821134a7bf3cd16f";
        const  SUCCESS_ADMIN_DELETEACTA ="6e9b5f3b0a15ca7dc9c2c71a1a929ce3";

        


        private $successList = [];


        public function __construct(){
            $this->successList = [ 
                SuccessMessages::SUCCESS_ADMIN_NEWDEPENDENCY => 'Dependencia Agregada con éxito',
                SuccessMessages::SUCCESS_SIGNUP_NEWUSER => 'Usuario registrado correctamente',
                SuccessMessages::SUCCESS_ADMIN_DEPENDENCY_UPDATE => 'Actualizada la dependencia',
                SuccessMessages::SUCCESS_PERFIL_UPDATE => 'Perfil actualizado correctamente',
                SuccessMessages::SUCCESS_ADMIN_NEWACTA => 'Acta creada correctamente',
                SuccessMessages::SUCCESS_ADMIN_DELETEACTA => 'Acta Eliminada Correctamente'
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