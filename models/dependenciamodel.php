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
        
        }
        public function get($id){}
        public function delete($id){}
        public function update(){}
        public function from($array){}
 
        public function exists($dependencia){
            try{
                $query = $this->prepare('SELECT dependencia FROM dependencia WHERE dependencia = :dependencia');
                $query->execute( ['dependencia' => $dependencia]);
                
                if($query->rowCount() > 0){
                    error_log('CategoriesModel::exists() => true');
                    return true;
                }else{
                    error_log('CategoriesModel::exists() => false');
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