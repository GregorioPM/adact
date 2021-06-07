<?php
class ActasModel extends Model  implements IModel
{
        private $id;
        private $asunto;
        private $fecha;
        private $horaInicio;
        private $horaFinal;
        private $lugar;
        private $idDependencia;
        private $orden;
        private $conclusiones;
        private $elaboro;
        private $aprobo;
        private $estado;
        private $totalParticipantes;

        function __construct()
        {
                parent::__construct();
                $this->asunto = '';
                $this->fecha = '';
                $this->horaInicio = '';
                $this->horaFinal = '';
                $this->lugar = '';
                $this->idDependencia = '';
                $this->orden = '';
                $this->conclusiones = '';
                $this->elaboro = '';
                $this->aprobo = '';
                $this->estado = '';
                $this->totalParticipantes = '';
        }

        /* public function save(){
            try {
               $query = $this->prepare('INSERT INTO ')
            } catch (PDOException $e) {
                error_log('USERMODEL::save->PDOException ' . $e); 
                return false;
            }
        }*/
        public function save()
        {
                try {
                        $query = $this->prepare('INSERT INTO acta(asunto, fecha, hora_inicio, hora_final,lugar,id_dependencia,orden_dia,conclusiones,elaboro,reviso_aprobo,estado) VALUES(:asunto, :fecha, :horaInicio, :horaFinal, :lugar, :idDependencia,:orden, :conclusiones, :elaboro, :aprobo, :estado)');
                        $query->execute([
                                'asunto' => $this->asunto,
                                'fecha' => $this->fecha,
                                'horaInicio' => $this->horaInicio,
                                'horaFinal' => $this->horaFinal,
                                'lugar' => $this->lugar,
                                'idDependencia' => $this->idDependencia,
                                'orden' => $this->orden,
                                'conclusiones' => $this->conclusiones,
                                'elaboro' => $this->elaboro,
                                'aprobo' => $this->aprobo,
                                'estado' => $this->estado,
                        ]);
                        error_log('OBTENER ULTIMO ID DE ACTA ' . $this->pdo->lastInsertId());
                        return true;
                } catch (PDOException $e) {
                        error_log('USERMODEL::save->PDOException ' . $e);
                        return false;
                }
        }

        public function obtenerUltimoId()
        {
                $id = "";
                $query = $this->db->connect()->prepare('SELECT MAX(id) AS id FROM acta');
                try {
                        $query->execute();

                        while ($row = $query->fetch()) {
                                $id = $row['id'];
                        }
                        return $id;
                } catch (PDOException $e) {
                        return null;
                }
        }

        public function getAll()
        {
                $items = [];
                try {
                        $query = $this->query('SELECT * FROM acta');
                        while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                                $item = new ActasModel();
                                $item->setId($p['id']);
                                $item->setAsunto($p['asunto']);
                                $item->setFecha($p['fecha']);
                                $item->setHoraInicio($p['hora_inicio']);
                                $item->setHoraFinal($p['hora_final']);
                                $item->setLugar($p['lugar']);
                                $item->setIdDependencia($p['id_dependencia']);
                                $item->setOrden($p['orden_dia']);
                                $item->setConclusiones($p['conclusiones']);
                                $item->setElaboro($p['elaboro']);
                                $item->setAprobo($p['reviso_aprobo']);
                                $item->setEstado($p['estado']);
                                $acta = new ActasModel();
                                $parti = $acta->getParticipantes($p['id']);
                                $item->setTotalParticipantes($parti->getTotalParticipantes());
                                error_log('ACTASMODEL::GETParticipantes->ENTRO A GETALL ' . $parti->getTotalParticipantes());
                                array_push($items, $item);
                        }
                        return $items;
                } catch (PDOException $e) {
                        error_log('ACTAMODEL::getAll->PDOException ' . $e);
                }
        }

        public function getParticipantes($id)
        {
                try {

                        $query = $this->prepare('SELECT COUNT(p.id) as participantes FROM participante p INNER JOIN acta a ON p.id_acta=a.id WHERE a.id=:id');
                        $query->execute(['id' => $id]);
                        
                        $participantes = $query->fetch(PDO::FETCH_ASSOC);
                        $this->totalParticipantes = $participantes['participantes'];
                        error_log('ACTASMODEL::GETParticipantes->ENTRO A OBTENRE ' . $participantes['participantes']);
                        return $this;
                } catch (PDOException $e) {
                        error_log('ACTASMODEL::GETParticipantes->PDOException ' . $e);
                        return false;
                }
        }

        public function getAprovados($id)
        {
                try {

                        $query = $this->prepare('SELECT COUNT(p.id) aprovados FROM acta a
                        INNER JOIN participante p ON a.id= p.id_acta
                        WHERE a.id=:id and p.estado="Aprovado"');
                        $query->execute(['id' => $id]);
                        $aprovados = $query->fetch(PDO::FETCH_ASSOC);
                        $totalAprovados= $aprovados['aprovados'];
                        error_log('ACTASMODEL::GETParticipantes->ENTRO A OBTENRE ' .$totalAprovados);
                        return $totalAprovados;
                } catch (PDOException $e) {
                        error_log('ACTASMODEL::GETParticipantes->PDOException ' . $e);
                        return false;
                }
        }
        public function get($id)
        {

                try {
                        $query = $this->prepare('SELECT * FROM acta WHERE id= :id');
                        $query->execute([
                                'id' => $id
                        ]);
                        $acta = $query->fetch(PDO::FETCH_ASSOC);

                        $this->id = $acta['id'];
                        $this->asunto = $acta['asunto'];
                        $this->fecha = $acta['fecha'];
                        $this->horaInicio = $acta['hora_inicio'];
                        $this->horaFinal = $acta['hora_final'];
                        $this->lugar = $acta['lugar'];
                        $this->idDependencia = $acta['id_dependencia'];
                        $this->orden = $acta['orden_dia'];
                        $this->conclusiones = $acta['conclusiones'];
                        $this->elaboro = $acta['elaboro'];
                        $this->aprobo = $acta['reviso_aprobo'];
                        $this->estado = $acta['estado'];


                        return $this;
                } catch (PDOException $e) {
                        error_log('USERMODEL::getAll->PDOException ' . $e);
                }
        }
        public function delete($id)
        {
                try {
                        $query = $this->prepare('DELETE FROM acta WHERE id = :id');
                        $query->execute([
                                'id' => $id
                        ]);
                        return true;
                } catch (PDOException $e) {
                        error_log('DEPENDENCIAMODEL::DELETE->PDOException ' . $e);
                        return false;
                }
        }
        public function update($acta)
        {
                try {
                        $a=3;
                        error_log('SIGNUP::UPDATE() => ENTRA A UPDATEV222' . $this->getOrden());      

                        $query = $this->prepare('UPDATE acta SET asunto= :asunto, fecha=:fecha, hora_inicio=:hora_inicio, hora_final=:hora_final ,conclusiones=:conclusiones,orden_dia=:orden_dia, lugar=:lugar,id_dependencia=:id_dependencia WHERE id= :id');
                        $query->execute([
                                'id' => $this->getId(),
                                'asunto' => $this->asunto,
                                'fecha' => $this->fecha,
                                'hora_inicio' => $this->horaInicio,  
                                'hora_final'=> $this->horaFinal,
                                'conclusiones'=>$this->conclusiones,
                                'orden_dia'=>$this->orden,
                                'lugar'=>$this->lugar,
                                'id_dependencia'=>$this->idDependencia
                        ]);
                        return true;
                } catch (PDOException $e) {
                        error_log('SIGNUP::UPDATE() => ENTRA A UPDATEV222' . $this->getOrden());      

                        error_log('USERMODEL::getAll->PDOException ' . $e);
                        return false; 
                }
        }

        public function updateEstado($id,$es){
                try {
                        
                        $query = $this->prepare('UPDATE acta SET estado = :estado WHERE id=:id');
                        $query->execute([                   
                                'id'=>$id,
                                'estado' =>$es
                        ]); 
                        error_log('ENTRO A UPDATE ESTADO' );      
                        return true;
                    } catch (PDOException $e) {
                        error_log('DEPENDENCIAMODEL::UPDATE->PDOException ' . $e); 
                        return false;
                    }
        }
        public function from($array)
        {
        }

        public function misParticipaciones($id)
        {
                $items = [];
                try {
                        $query = $this->prepare('SELECT a.id, a.asunto, a.fecha,a.lugar, a.estado
                        FROM acta a 
                        INNER JOIN participante p ON a.id=p.id_acta
                        INNER JOIN usuario u ON p.id_usuario=u.id
                        WHERE u.id=:id');
                        $query->execute(["id" => $id]);
                        while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                                $item = new ActasModel();
                                $item = new ActasModel();
                                $item->setId($p['id']);
                                $item->setAsunto($p['asunto']);
                                $item->setFecha($p['fecha']);
                                $item->setLugar($p['lugar']);
                                $item->setEstado($p['estado']);

                                error_log('ACTASMODEL::GETParticipantes->ENTRO A MISPARTICIPACIONES');
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
         * Get the value of asunto
         */
        public function getAsunto()
        {
                return $this->asunto;
        }

        /**
         * Set the value of asunto
         *
         * @return  self
         */
        public function setAsunto($asunto)
        {
                $this->asunto = $asunto;

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

        /**
         * Get the value of horaInicio
         */
        public function getHoraInicio()
        {
                return $this->horaInicio;
        }

        /**
         * Set the value of horaInicio
         *
         * @return  self
         */
        public function setHoraInicio($horaInicio)
        {
                $this->horaInicio = $horaInicio;

                return $this;
        }

        /**
         * Get the value of horaFinal
         */
        public function getHoraFinal()
        {
                return $this->horaFinal;
        }

        /**
         * Set the value of horaFinal
         *
         * @return  self
         */
        public function setHoraFinal($horaFinal)
        {
                $this->horaFinal = $horaFinal;

                return $this;
        }

        /**
         * Get the value of lugar
         */
        public function getLugar()
        {
                return $this->lugar;
        }

        /**
         * Set the value of lugar
         *
         * @return  self
         */
        public function setLugar($lugar)
        {
                $this->lugar = $lugar;

                return $this;
        }

        /**
         * Get the value of idDependencia
         */
        public function getIdDependencia()
        {
                return $this->idDependencia;
        }

        /**
         * Set the value of idDependencia
         *
         * @return  self
         */
        public function setIdDependencia($idDependencia)
        {
                $this->idDependencia = $idDependencia;

                return $this;
        }

        /**
         * Get the value of orden
         */
        public function getOrden()
        {
                return $this->orden;
        }

        /**
         * Set the value of orden
         *
         * @return  self
         */
        public function setOrden($orden)
        {
                $this->orden = $orden;

                return $this;
        }

        /**
         * Get the value of conclusiones
         */
        public function getConclusiones()
        {
                return $this->conclusiones;
        }

        /**
         * Set the value of conclusiones
         *
         * @return  self
         */
        public function setConclusiones($conclusiones)
        {
                $this->conclusiones = $conclusiones;

                return $this;
        }

        /**
         * Get the value of elaboro
         */
        public function getElaboro()
        {
                return $this->elaboro;
        }

        /**
         * Set the value of elaboro
         *
         * @return  self
         */
        public function setElaboro($elaboro)
        {
                $this->elaboro = $elaboro;

                return $this;
        }

        /**
         * Get the value of aprobo
         */
        public function getAprobo()
        {
                return $this->aprobo;
        }

        /**
         * Set the value of aprobo
         *
         * @return  self
         */
        public function setAprobo($aprobo)
        {
                $this->aprobo = $aprobo;

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
         * Get the value of totalParticipantes
         */
        public function getTotalParticipantes()
        {
                return $this->totalParticipantes;
        }

        /**
         * Set the value of totalParticipantes
         *
         * @return  self
         */
        public function setTotalParticipantes($totalParticipantes)
        {
                $this->totalParticipantes = $totalParticipantes;

                return $this;
        }
}
