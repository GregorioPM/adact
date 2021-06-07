<?php

require_once "userModel.php";

    class ParticipanteModel extends Model{

        private $id;
        private $idActa;
        private $idUsuario;
        private $estado;
        private $nombres;

        function __construct(){
            parent::__construct();
            $this->id='';
            $this->idActa='';
            $this->idUsuario='';
            $this->estado='';
            $this->nombres='';

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

        public function delete($id){
                try {
                        $query = $this->prepare('DELETE FROM participante WHERE id = :id');
                        $query->execute([
                                'id' =>$id
                        ]);
                        return true;
                } catch (PDOException $e) {
                        error_log('USERMODEL::delete->PDOException ' . $e); 
                        return false;
                }
        }

        public function misParticipaciones($id)
        {

                try {

                        $query = $this->prepare('SELECT COUNT(p.id) participaciones FROM participante p
                        INNER JOIN usuario u ON p.id_usuario=u.id
                        WHERE u.id=:id');
                        $query->execute(['id' => $id]);
                        $participantes = $query->fetch(PDO::FETCH_ASSOC);
                        $participaciones = $participantes['participaciones'];
                        error_log('ACTASMODEL::GETParticipantes->ENTRO A OBTENRE ' .$participaciones);
                        return $participaciones;
                } catch (PDOException $e) {
                        error_log('ACTASMODEL::GETParticipantes->PDOException ' . $e);
                        return false;
                }
        }

        public function update($participante){
                try {
                    
                    $query = $this->prepare('UPDATE participante SET estado =:estado WHERE id=:id');
                    $query->execute([                   
                            'id'=>$participante->getID(),
                            'estado' =>$participante->getEstado()
                    ]); 
                    //error_log('DEPENDENCIAMODEL::UPDATE->PDOException  ENTRAAA' );      
                    return true;
                } catch (PDOException $e) {
                    error_log('PARTICIPANTEMODEL::UPDATE->PDOException ' . $e); 
                    return false;
                }
            }

        public function getAll($idacta){
                $items = [];
                try {
                        $query = $this->query('SELECT  CONCAT_WS(" ",u.nombres, u.apellidos) as nombres,p.id_usuario,p.id_acta,p.estado,p.id FROM participante p
                        INNER JOIN usuario u ON p.id_usuario=u.id
                        WHERE id_acta='. $idacta);
                        while($p = $query->fetch(PDO::FETCH_ASSOC)){
                                $item= new ParticipanteModel();
                                $item->setId($p['id']);
                                $item->setIdUsuario($p['id_usuario']);
                                $item->setIdActa($p['id_acta']);
                                $item->setEstado($p['estado']);
                                $item->setNombres($p['nombres']);
                                //$user->setApellidos($p['apellidos']);
                                //$user->setNombres($p['nombres']);

                                array_push($items, $item);
                        }
                        return $items;
                } catch (PDOException $e) {
                        error_log('ACTAMODEL::getAll->PDOException ' . $e); 
                }  
        }

        public function getAllParticipantes($idacta){
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

        public function getParticipante($idActa,$idUsuario){
                try {

                        $query = $this->prepare('SELECT p.id FROM acta a
                        INNER JOIN participante p ON a.id=p.id_acta
                        INNER JOIN usuario u ON p.id_usuario=u.id
                        WHERE a.id=:idActa AND u.id=:idUsuario');
                        $query->execute(['idActa' => $idActa,'idUsuario' => $idUsuario]);
                        $participantes = $query->fetch(PDO::FETCH_ASSOC);
                        $idparti = $participantes['id'];
                        error_log('ACTASMODEL::GETParticipantes->ENTRO A OBTENRE ' .$idparti);
                        return $idparti;
                } catch (PDOException $e) {
                        error_log('ACTASMODEL::GETParticipantes->PDOException ' . $e);
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

        /**
         * Get the value of nombres
         */ 
        public function getNombres()
        {
                return $this->nombres;
        }

        /**
         * Set the value of nombres
         *
         * @return  self
         */ 
        public function setNombres($nombres)
        {
                $this->nombres = $nombres;

                return $this;
        }
    }
