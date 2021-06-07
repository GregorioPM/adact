<?php
    class TemasModel extends Model{

        private $id;
        private $idActa;
        private $descripcion;

        function __construct(){
            parent::__construct();
            $this->id='';
            $this->idActa='';
            $this->descripcion='';
        }

        public function save(){
            try {
                    $query = $this->prepare('INSERT INTO tema(id_acta, descripcion) VALUES(:idActa, :descripcion)');
                    $query->execute([
                         'idActa' => $this->idActa,
                         'descripcion' => $this->descripcion,  
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
                        $query = $this->query('SELECT * FROM tema WHERE id_acta='. $idacta);
                        while($p = $query->fetch(PDO::FETCH_ASSOC)){
                                $item= new TemasModel();
                                $item->setId($p['id']);
                                $item->setIdActa($p['id_acta']);
                                $item->setDescripcion($p['descripcion']);

                                error_log('ACTASMODEL::GETParticipantes->ENTRO A GETALL TEMAS '); 
                                array_push($items, $item);
                        }
                        return $items;
                } catch (PDOException $e) {
                        error_log('ACTAMODEL::getAll->PDOException ' . $e); 
                }  
        }

        public function delete($id){
                try {
                        $query = $this->prepare('DELETE FROM tema WHERE id = :id');
                        $query->execute([
                                'id' =>$id
                        ]);
                        return true;
                } catch (PDOException $e) {
                        error_log('USERMODEL::delete->PDOException ' . $e); 
                        return false;
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
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }
    }

?>