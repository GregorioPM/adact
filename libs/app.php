<?php
Class App{
    
    function __construct(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

         //var_dump($url);
        /*
            controlador->[0]
            metodo->[1]
            parameter->[2]
        */

        if(empty($url[0])){
            error_log('APP::contruct->no hay controlador');
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            $controller = new Login(); 
            $controller->loadModel('login');
            $controller->render();
            return false;
        }
        $archivoController = 'controllers/' . url[0] . '.php';
        if(file_exists($archivoController)){
            require_once $archivoController;

            $controller = new $url[0];
            $controller->loadModel($url[0]);

            if(isset($url[1])){
                if(method_exists($controller, $url[1])){
                    if(isset($url[2])){
                        $nparam = count($url)-2;
                        $params= [];
                        for ($i=0; $i < $nparam; $i++) { 
                            array_push($params, $url[$i]+2);
                        }
                        $controller->{$url[1]}($params);
                    }else{
                        //no tiene parametros se llama el metodo tal cual
                        $controller->{$url[1]}();
                    }
                }else{
                    //error, no existe el metodo
                }
            }else{
                //no hay metodo a cargar, se carga el metodo por default
                $controller->render();
            }
        }else{
            //no existe el archivo, mandar error
        }    
    }

}
?>