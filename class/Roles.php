<?php
    class Roles{
        private $id;
        private $rol;
        private $descripcion;
        private $cantidad_libros;
        private $dias_maximos_prestamos;

        public function __construct(){
            $this->id=0;
            $this->rol="";
            $this->descripcion="";
            $this->cantidad_libros=0;
            $this->dias_maximos_prestamos=0;
        }

        public function mostrarRoles(){
            include_once 'Connection.php';	
            $connection = Database::connect();
            $query =("SELECT * FROM roles");
            $roles = $connection->query($query);
            Database::disconnect();
            return $roles;
        }

        public function modificarRol($id_rol,$descripcion,$cantidad_libros, $dias_maximos_prestamo){
            include_once 'Connection.php';
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("UPDATE roles SET descripcion=?, cantidad_libros=?, dias_maximos_prestamo=? WHERE id=?");
            $query->execute(array($descripcion,$cantidad_libros, $dias_maximos_prestamo, $id_rol));
            Database::disconnect();
        }
    }
?>