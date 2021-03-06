<?php

    class ErrorMessages{
        // ERROR_CONTROLLER_METODO_OPERACION
        const ERROR_ADMIN_NEWDEPENDENCY_EXISTS = "d04199919e5b63afcc591aba8b138710";
        const ERROR_ADMIN_ACTAPARTICIPANTE = "d7a49c077658fa16b44a222ab3a560ae";
        const ERROR_LOGIN_AUTHENTICATE = "11c37cfab311fbe28652f4947a9523c4";
        const ERROR_LOGIN_AUTHENTICATE_EMPTY = "c5ad1b2e3fba324adae0ddc32478a388";
        const ERROR_LOGIN_AUTHENTICATE_DATA = "4fe5e13b3e9458d28f6632a2361b2abe";
        const ERROR_SIGNUP_NEWUSER = "2121fb69c350c69f3246eb65aec12c14";
        const ERROR_SIGNUP_NEWUSER_EMPTY = "a5bcd7089d83f45e17e989fbc86003ed";
        const ERROR_SIGNUP_NEWUSER_EXISTS = "6ed9f1614737c71ba4128caa787304c4";
        const ERROR_ADMIN_DELETEDEPENDENCY_EXISTS="d18899692faf9c09edcaa390a236ce19";
        const ERROR_SIGNUP_DELETEUSER="9f630f25403bf454142f2d0742ebd326";
       
        

        private $errorList = [];

        public function __construct(){
            $this->errorList = [ 
                ErrorMessages::ERROR_ADMIN_NEWDEPENDENCY_EXISTS => 'El nombre de la dependencia ya existe, intenta otra vez',
                ErrorMessages::ERROR_LOGIN_AUTHENTICATE => 'Hubo un problema al autenticarse',
                ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY => 'Llena los campos de correo y contraseña',
                ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA => 'Correo y/o contraseña incorrectos',
                ErrorMessages::ERROR_SIGNUP_NEWUSER => 'Hubo un error al intentar registrar. Intenta de nuevo',
                ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY => 'Los campos no pueden estar vacíos',
                ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS => 'El correo ya existe, intenta con otro',
                ErrorMessages::ERROR_ADMIN_ACTAPARTICIPANTE => 'Error el acta tiene asociado participantes',
                ErrorMessages::ERROR_ADMIN_DELETEDEPENDENCY_EXISTS => 'Error La dependencia esta siendo utilizada en un acta',
                ErrorMessages::ERROR_SIGNUP_DELETEUSER => 'Error el Usuario no se puede eliminar , por que esta participando en un acta',


                
                
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