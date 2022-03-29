<?php
    class Usuario{
        private $id_rol;
        private $id_estado;
        private $email;
        private $password;
        private $nombre;
        private $identificacion;
        private $telefono;
        private $direccion;
        private $fecha_registro;

        public function __construct(){
            $this->id_rol=0;
            $this->id_estado=0;
            $this->email="";
            $this->password="";
            $this->nombre="";
            $this->identificacion="";
            $this->telefono="";
            $this->direccion="";
            $this->fecha_registro="";
        }

        public function inciarSesion($email, $password){
            include_once 'Connection.php';	
            $connection = Database::connect();
            $sql=("SELECT * FROM usuarios");
    
            foreach ($connection->query($sql) as $row) {
                if($row["email"] == $email && $row["password"]==$password){
                    session_start();
                    $_SESSION["sesion"]="si";
                    $_SESSION["id"]=$row["id"];
                    $_SESSION["id_rol"]=$row["id_rol"];
                    $_SESSION["id_estado"]=$row["id_estado"];
                    $_SESSION["email"]=$row["email"];
                    $_SESSION["password"]=$row["password"];
                    $_SESSION["nombre"]=$row["nombre"];
                    $_SESSION["identificacion"]=$row["identificacion"];
                    $_SESSION["telefono"]=$row["telefono"];
                    $_SESSION["direccion"]=$row["direccion"];
                    $_SESSION["fecha_registro"]=$row["fecha_registro"];
                    return true;
                }   
            }
            Database::disconnect();
            return false;
        }

        public function mostrarUsuario($id_usuario){
            include_once 'Connection.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("SELECT * FROM usuarios u JOIN estado_usuario e ON u.id_estado = e.id JOIN roles r ON u.id_rol = r.id where u.id = ?");
            $query->execute(array($id_usuario));
            $usuario = $query->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
            return $usuario;
        }

        public function mostrarUsuarios(){
            include_once 'Connection.php';
            $connection = Database::connect();
            $query=("SELECT * FROM usuarios u JOIN estado_usuario e ON u.id_estado = e.id JOIN roles r ON u.id_rol = r.id");
            $usuarios = $connection->query($query);
            Database::disconnect();
            return $usuarios;
        }

        public function mostrarEstadoUsuario(){
            include_once 'Connection.php';	
            $connection = Database::connect();
            $query =("SELECT * FROM estado_usuario");
            $estado = $connection->query($query);
            Database::disconnect();
            return $estado;
        }

        public function modificarUsuario($password,$id){
            include_once 'Connection.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("UPDATE usuarios SET password=? WHERE id=?");
            $query->execute(array($password,$id));
            $_SESSION["password"]=$password;
            Database::disconnect();
        }

        public function cambiarEstadoUsuario($id_usuario, $id_estado){
            include_once 'Connection.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("UPDATE usuarios SET id_estado=? WHERE id=?");
            $query->execute(array($id_estado,$id_usuario));
            Database::disconnect();
        }

        public function generarPDF(){

        }
    }
?>