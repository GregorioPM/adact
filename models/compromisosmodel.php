<?php

require_once "userModel.php";

class CompromisosModel extends Model
{

        private $id;
        private $idActa;
        private $idParticipante;
        private $compromiso;
        private $fecha;

        function __construct()
        {
                parent::__construct();
                $this->id = '';
                $this->idActa = '';
                $this->idParticipante = '';
                $this->compromiso = '';
                $this->fecha = '';
        }

        public function save()
        {
                try {
                        $query = $this->prepare('INSERT INTO compromiso(id_participante,id_acta, compromiso,fecha) VALUES(:idParticipante, :idActa, :compromiso, :fecha)');
                        $query->execute([
                                'idParticipante' => $this->idParticipante,
                                'idActa' => $this->idActa,
                                'compromiso' => $this->compromiso,
                                'fecha' => $this->fecha,

                        ]);
                        return true;
                } catch (PDOException $e) {
                        error_log('COMPROMISOMODEL::save->PDOException ' . $e);
                        return false;
                }
        }

        public function getAll($idacta)
        {
                $items = [];
                try {
                        $query = $this->query('SELECT * FROM compromiso WHERE id_acta =' . $idacta);
                        while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                                $item = new CompromisosModel();
                                $item->setId($p['id']);
                                $item->setIdParticipante($p['id_participante']);
                                $item->setIdActa($p['id_acta']);
                                $item->setCompromiso($p['compromiso']);
                                $item->setFecha($p['fecha']);

                                error_log('ACTASMODEL::GETParticipantes->ENTRO A GETALL TEMAS ');
                                array_push($items, $item);
                        }
                        return $items;
                } catch (PDOException $e) {
                        error_log('ACTAMODEL::getAll->PDOException ' . $e);
                }
        }

        public function nombresParticipante($id)
        {
                try {

                        $query = $this->prepare('SELECT CONCAT_WS(" ",u.nombres, u.apellidos) nombres FROM compromiso c
            INNER JOIN participante p ON c.id_participante=p.id
            INNER JOIN usuario u ON p.id_usuario=u.id
            WHERE c.id_participante=:id');
                        $query->execute(['id' => $id]);
                        $participantes = $query->fetch(PDO::FETCH_ASSOC);
                        $nombres = $participantes['nombres'];
                        error_log('ACTASMODEL::GETParticipantes->ENTRO A OBTENRE ' . $nombres);
                        return $nombres;
                } catch (PDOException $e) {
                        error_log('ACTASMODEL::GETParticipantes->PDOException ' . $e);
                        return false;
                }
        }

        public function misCompromisos($id)
        {

                try {

                        $query = $this->prepare('SELECT COUNT(c.id) compromisos FROM compromiso c 
                        INNER JOIN participante p ON c.id_participante=p.id
                        INNER JOIN usuario u ON p.id_usuario=u.id
                        WHERE u.id=:id');
                        $query->execute(['id' => $id]);
                        $participantes = $query->fetch(PDO::FETCH_ASSOC);
                        $compromisos = $participantes['compromisos'];
                        error_log('ACTASMODEL::GETParticipantes->ENTRO A OBTENRE ' . $compromisos);
                        return $compromisos;
                } catch (PDOException $e) {
                        error_log('ACTASMODEL::GETParticipantes->PDOException ' . $e);
                        return false;
                }
        }

        public function totalCompromisos($id)
        {

                $items = [];
                try {
                        $query = $this->prepare('SELECT c.id,c.id_participante,c.id_acta,c.compromiso,c.fecha FROM compromiso c 
                        INNER JOIN participante p ON c.id_participante=p.id
                        INNER JOIN usuario u ON p.id_usuario=u.id
                        WHERE u.id=:id');
                        $query->execute(["id" => $id]);
                        while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                                $item = new CompromisosModel();
                                $item->setId($p['id']);
                                $item->setIdParticipante($p['id_participante']);
                                $item->setIdActa($p['id_acta']);
                                $item->setCompromiso($p['compromiso']);
                                $item->setFecha($p['fecha']);

                                error_log('COMPROMISOSMODEL::GETParticipantes->ENTRO A MISPARTICIPACIONES');
                                array_push($items, $item);
                        }
                        return $items;
                } catch (PDOException $e) {
                        error_log('COMPROMISOSMODEL::getAll->PDOException ' . $e);
                }
        }

        public function delete($id){
                try {
                        $query = $this->prepare('DELETE FROM compromiso WHERE id = :id');
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
         * Get the value of idParticipante
         */
        public function getIdParticipante()
        {
                return $this->idParticipante;
        }

        /**
         * Set the value of idParticipante
         *
         * @return  self
         */
        public function setIdParticipante($idParticipante)
        {
                $this->idParticipante = $idParticipante;

                return $this;
        }

        /**
         * Get the value of compromiso
         */
        public function getCompromiso()
        {
                return $this->compromiso;
        }

        /**
         * Set the value of compromiso
         *
         * @return  self
         */
        public function setCompromiso($compromiso)
        {
                $this->compromiso = $compromiso;

                return $this;
        }

        /**
         * Get the value of fecha
         */
        public function getFecha()
        {
                return $this->fecha;
        }

        /**
         * Set the value of fecha
         *
         * @return  self
         */
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }
}
