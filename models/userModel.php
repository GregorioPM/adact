<?php

    class userModel extends Model implements IModel{

        private $id;
        private $correo;
        private $password;
        private $rol;
        private $nombres;
        private $apellidos;
        private $foto;
        private $telefono;
        
        public function __construct(){
                parent::__construct();
                $this->correo='';
                $this->password='';
                $this->rol='';
                $this->nombres='';
                $this->apellidos='';
                $this->foto='';
                $this->telefono='';
        }

        function updatePhoto($name, $iduser){
                try{
                    $query = $this->db->connect()->prepare('UPDATE usuario SET foto = :val WHERE id = :id');
                    $query->execute(['val' => $name, 'id' => $iduser]);
        
                    if($query->rowCount() > 0){
                        return true;
                    }else{
                        return false;
                    }
                
                }catch(PDOException $e){
                    return NULL;
                }
            }

        public function save(){
                try {
                        $query = $this->prepare('INSERT INTO usuario(correo, password, rol, nombres,apellidos) VALUES(:correo, :password, :rol, :nombres, :apellidos)');
                        $query->execute([
                             'correo' => $this->correo,
                             'password' => $this->password,
                             'rol' => $this->rol,
                             'nombres' => $this->nombres,
                             'apellidos' => $this->apellidos   
                        ]);
                        return true;
                } catch (PDOException $e) {
                        error_log('USERMODEL::save->PDOException ' . $e); 
                        return false;
                }
        }
        public function getAll(){
                $items = [];
                try {
                        $query = $this->query('SELECT * FROM usuario');
                        while($p = $query->fetch(PDO::FETCH_ASSOC)){
                                $item= new UserModel();
                                $item->setId($p['id']);
                                $item->setCorreo($p['correo']);
                                $item->setPassword($p['password']);
                                $item->setRol($p['rol']);
                                $item->setNombres($p['nombres']);
                                $item->setApellidos($p['apellidos']);
                                $item->setFoto($p['foto']);
                                $item->setTelefono($p['telefono']);

                                array_push($items, $item);
                        }
                        return $items;
                } catch (PDOException $e) {
                        error_log('USERMODEL::getAll->PDOException ' . $e); 
                }
        }

        

        public function get($id){
                try {
                        $query = $this->prepare('SELECT * FROM usuario WHERE id= :id');
                        $query->execute([
                                'id' =>$id
                        ]); 
                        $user = $query->fetch(PDO::FETCH_ASSOC);
                                
                                $this->id = $user['id'];
                                $this->correo = $user['correo'];
                                $this->password = $user['password'];
                                $this->rol = $user['rol'];
                                $this->nombres = $user['nombres'];
                                $this->apellidos = $user['apellidos'];
                                $this->foto=$user['foto'];
                                $this->telefono=$user['telefono'];

                             
                        return $this;
                } catch (PDOException $e) {
                        error_log('USERMODEL::getAll->PDOException ' . $e); 
                }
        }
        public function delete($id){
                try {
                        $query = $this->prepare('DELETE FROM usuario WHERE id = :id');
                        $query->execute([
                                'id' =>$id
                        ]);
                        return true;
                } catch (PDOException $e) {
                        error_log('USERMODEL::delete->PDOException ' . $e); 
                        return false;
                }
        }
        public function update($user){
                try {
                        $query = $this->prepare('UPDATE usuario SET correo= :correo, nombres=:nombres, apellidos=:apellidos, telefono=:telefono WHERE id= :id');
                        $query->execute([
                                'id' => $this->getId(),
                                'correo' => $this->correo,
                                'nombres' => $this->nombres,
                                'apellidos' => $this->apellidos,  
                                'telefono'=> $this->telefono
                        ]);
                        error_log('SIGNUP::UPDATE() => ENTRA A UPDATEV222' . $this->getId());      
                        return true;
                } catch (PDOException $e) {
                        error_log('USERMODEL::getAll->PDOException ' . $e);
                        return false; 
                }
        }
        public function from($array){
                $this->id       = $array['id'];
                $this->correo   =$array['correo'];
                $this->password =$array['password'];
                $this->rol      =$array['rol'];
                $this->nombres  =$array['nombres'];
                $this->apellidos=$array['apellidos'];
        }

        public function exists($correo){
                try {
                       $query= $this->prepare('SELECT correo FROM usuario WHERE correo=:correo');
                       $query->execute(['correo'=>$correo]);
                       if($query->rowCount()>0){
                               return true;
                       }else{
                                return false;
                        }
                } catch (PDOException $e) {
                        error_log('USERMODEL::exists->PDOException ' . $e);
                        return false; 
                }
        }

        public function comparePasswords($password, $id){
                try{
                        $user = $this->get($id);
                        return password_verify($password, $user->getPassword());
                } catch (PDOException $e) {
                        error_log('USERMODEL::comparePasswords->PDOException ' . $e);
                        return false; 
                }
            }

        private function getHashedPassword($password){
                return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
        }

        public function getId(){
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getCorreo()
        {
                return $this->correo;
        }

        public function setCorreo($correo)
        {
                $this->correo = $correo;

                return $this;
        }

        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password, $hash = true){ 
                if($hash){
                    $this->password = $this->getHashedPassword($password);
                }else{
                    $this->password = $password;
                }
            }

        public function getRol()
        {
                return $this->rol;
        }

        public function setRol($rol)
        {
                $this->rol = $rol;

                return $this;
        }


        public function getNombres()
        {
                return $this->nombres;
        }

        public function setNombres($nombres)
        {
                $this->nombres = $nombres;

                return $this;
        }

        public function getApellidos()
        {
                return $this->apellidos;
        }

        public function setApellidos($apellidos)
        {
                $this->apellidos = $apellidos;

                return $this;
        }


        public function getFoto()
        {
                return $this->foto;
        }

        public function setFoto($foto)
        {
                $this->foto = $foto;

                return $this;
        }

        public function getTelefono()
        {
                return $this->telefono;
        }
        public function setTelefono($telefono)
        {
                $this->telefono = $telefono;

                return $this;
        }
    }

?>