<?php
    class ParticipanteModel extends Model{

        private $id;
        private $idActa;
        private $idUsuario;
        private $estado;

        function __construct(){
            parent::__construct();
            $this->id='';
            $this->idActa='';
            $this->idUsuario='';
            $this->estado='';
        }

        public function save(){
            try {
                    $query = $this->prepare('INSERT INTO participante(id_usuario,id_acta, estado) VALUES(:idUsuario, :idActa, :estado)');
                    $query->execute([
                         'idUsuario' => $this->idUsuario,
                         'idActa' => $this->idActa,
                         'estado' => $this->estado,  
                    ]);
                    return true;
            } catch (PDOException $e) {
                    error_log('USERMODEL::save->PDOException ' . $e); 
                    return false;
            }
        }

        public function getAll($idacta){
                $items = [];
                try {
                        $query = $this->query('SELECT * FROM participante WHERE id_acta='. $idacta);
                        while($p = $query->fetch(PDO::FETCH_ASSOC)){
                                $item= new ParticipanteModel();
                                $item->setId($p['id']);
                                $item->setIdUsuario($p['id_usuario']);
                                $item->setIdActa($p['id_acta']);
                                $item->setEstado($p['estado']);

                                error_log('ACTASMODEL::GETParticipantes->ENTRO A GETALL TEMAS '); 
                                array_push($items, $item);
                        }
                        return $items;
                } catch (PDOException $e) {
                        error_log('ACTAMODEL::getAll->PDOException ' . $e); 
                }  
        }
    

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of idActa
         */ 
        public function getIdActa()
        {
                return $this->idActa;
        }

        /**
         * Set the value of idActa
         *
         * @return  self
         */ 
        public function setIdActa($idActa)
        {
                $this->idActa = $idActa;

                return $this;
        }

        /**
         * Get the value of idUsuario
         */ 
        public function getIdUsuario()
        {
                return $this->idUsuario;
        }

        /**
         * Set the value of idUsuario
         *
         * @return  self
         */ 
        public function setIdUsuario($idUsuario)
        {
                $this->idUsuario = $idUsuario;

                return $this;
        }

        /**
         * Get the value of estado
         */ 
        public function getEstado()
        {
                return $this->estado;
        }

        /**
         * Set the value of estado
         *
         * @return  self
         */ 
        public function setEstado($estado)
        {
                $this->estado = $estado;

                return $this;
        }
    }

?>