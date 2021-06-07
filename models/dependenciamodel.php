<?php

    class DependenciaModel extends Model implements IModel{

        private $id;
        private $dependencia = '';

        function __construct(){
            parent::__construct();
        }

        public function save(){
            try {
                $query= $this->prepare('INSERT INTO dependencia ( dependencia) VALUES( :dependencia)');
                $query->execute([
                    'dependencia' =>$this->dependencia,
                ]);
                if($query->rowCount()){
                    return true;
                }else{
                    return false;
                }
               
            } catch (PDOException $e) {
                error_log('DEPENDENCIAMODEL::save->PDOException ' . $e); 
                return false;
            }

        }
        public function getAll(){
            $items= [];
            try {
               $query = $this->query('SELECT * FROM dependencia');

               while($p = $query->fetch(PDO::FETCH_ASSOC)){
                
                   $item = new DependenciaModel();
                   $item->from($p);
                   array_push($items, $item);
               } 
               return $items;

            } catch (PDOException $e) {
                error_log('DEPENDENCIAMODEL::GETALL->PDOException ' . $e); 
                return false;
            }
        }
        public function get($id){
            try {
                $query = $this->prepare('SELECT * FROM dependencia WHERE id=:id');
                $query->execute(['id'=>$id]);
                $dependencia = $query->fetch(PDO::FETCH_ASSOC);
                $this->from($dependencia);
                return $this;
            } catch (PDOException $e) {
                error_log('DEPENDENCIAMODEL::GETID->PDOException ' . $e); 
                return false;
            }
        }
        public function delete($id){
            try {
                $query = $this->prepare('DELETE FROM dependencia WHERE id = :id');
                $query->execute([
                        'id' =>$id
                ]);
                return true;
            } catch (PDOException $e) {
                error_log('DEPENDENCIAMODEL::DELETE->PDOException ' . $e); 
                return false;
            }
        }
       
        public function totalDependencias()
        {

                $dependencia = "";
                $query = $this->db->connect()->prepare('SELECT COUNT(d.id) dependencias FROM dependencia d');
                try {
                        $query->execute();

                        while ($row = $query->fetch()) {
                                $dependencia = $row['dependencias'];
                        }
                        return $dependencia;
                        error_log('ACTASMODEL::GETParticipantes->PDOException ' . $dependencia);

                } catch (PDOException $e) {
                        return null;
                }
               
        }

        public function update($dependencia){
            try {
                
                $query = $this->prepare('UPDATE dependencia SET dependencia = :dependencia WHERE id=:id');
                $query->execute([                   
                        'id'=>$this->getId(),
                        'dependencia' =>$this->getDependencia()
                ]); 
                //error_log('DEPENDENCIAMODEL::UPDATE->PDOException  ENTRAAA' );      
                return true;
            } catch (PDOException $e) {
                error_log('DEPENDENCIAMODEL::UPDATE->PDOException ' . $e); 
                return false;
            }
        }
        public function from($array){
            $this->id       = $array['id'];
            $this->dependencia   =$array['dependencia'];
        }
 
        public function exists($dependencia){
            try{
                $query = $this->prepare('SELECT dependencia FROM dependencia WHERE dependencia = :dependencia');
                $query->execute( ['dependencia' => $dependencia]);
                
                if($query->rowCount() > 0){
                    error_log('DependenciaModel::exists() => TRUE');
                    return true;
                }else{
                    error_log('DependenciaModel::exists() => FALSE');
                    return false;
                }
            }catch(PDOException $e){
                error_log($e);
                return false;
            }
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

        public function getDependencia()
        {
                return $this->dependencia;
        }

        public function setDependencia($dependencia)
        {
                $this->dependencia = $dependencia;

                return $this;
        }
    }

?>