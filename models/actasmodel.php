<?php
    class ActasModel extends Model  implements IModel{
        private $id;
        private $asunto;
        private $fecha;
        private $dependenciaid;
        private $orden;
        private $elaboro;
        private $aprobo;
        private $estado;
        
        function __construct(){
            parent::__construct();
        }

       /* public function save(){
            try {
               $query = $this->prepare('INSERT INTO ')
            } catch (PDOException $e) {
                error_log('USERMODEL::save->PDOException ' . $e); 
                return false;
            }
        }*/
        public function getAll(){
        
        }
        public function get($id){}
        public function delete($id){}
        public function update(){}
        public function from($array){}

    
}

    
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getAsunto()
        {
                return $this->asunto;
        }

        public function setAsunto($asunto)
        {
                $this->asunto = $asunto;

                return $this;
        }

    
        public function getFecha()
        {
                return $this->fecha;
        }

        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }

        public function getDependenciaid()
        {
                return $this->dependenciaid;
        }

        public function setDependenciaid($dependenciaid)
        {
                $this->dependenciaid = $dependenciaid;

                return $this;
        }

        public function getOrden()
        {
                return $this->orden;
        }

        public function setOrden($orden)
        {
                $this->orden = $orden;

                return $this;
        }

        public function getElaboro()
        {
                return $this->elaboro;
        }

        public function setElaboro($elaboro)
        {
                $this->elaboro = $elaboro;

                return $this;
        }

        public function getAprobo()
        {
                return $this->aprobo;
        }

        public function setAprobo($aprobo)
        {
                $this->aprobo = $aprobo;

                return $this;
        }

        public function getEstado()
        {
                return $this->estado;
        }

        public function setEstado($estado)
        {
                $this->estado = $estado;

                return $this;
        }
    }
?>