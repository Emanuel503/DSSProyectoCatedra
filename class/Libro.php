<?php
    class Libro{
        private $isbn;
        private $titulo;
        private $autor;
        private $editorial;
        private $id_estado;
        private $ejemplares;
        private $ejemplares_prestados;
        private $edicion;
        private $imagen;
        private $fecha_registro;

        public function __construct(){
            $this->isbn="";
            $this->titulo="";
            $this->autor = "";
            $this->editorial = "";
            $this->id_estado = "";
            $this->ejemplares = "";
            $this->ejemplares_prestados = "";
            $this->edicion = "";
            $this->imagen = "";
            $this->fecha_registro = "";
        }

        public function mostrarLibro($id_libro){
            include_once 'Connection.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("SELECT * FROM libros l JOIN estado_libro e ON l.id_estado = e.id WHERE l.id = ?");
            $query->execute(array($id_libro));
            $libro = $query->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
            return $libro;
        }

        public function mostrarLibros(){
            include_once 'Connection.php';	
            $connection = Database::connect();
            $query ="SELECT * FROM libros l JOIN estado_libro e ON l.id_estado = e.id ORDER BY edicion, titulo ASC ";
            $libros = $connection->query($query);
            Database::disconnect();
            return $libros;
        }

        public function mostrarEstadosLibro(){
            include_once 'Connection.php';	
            $connection = Database::connect();
            $query ="SELECT * FROM estado_libro";
            $estados = $connection->query($query);
            Database::disconnect();
            return $estados;
        }

        public function agregarLibro($isbn, $titulo, $autor, $editorial, $ejemplares, $edicion, $imagen, $id_estado){

            date_default_timezone_set('America/El_Salvador');
            $this->isbn = trim($isbn);
            $this->titulo = trim($titulo);
            $this->autor = trim($autor);
            $this->editorial = trim($editorial);
            $this->id_estado  = trim($id_estado);
            $this->ejemplares  = trim($ejemplares);
            $this->ejemplares_prestados  = 0;
            $this->edicion = trim($edicion);
            $this->imagen = $imagen;
            $this->fecha_registro = date('Y-m-d');
            $ruta = 'img/libros/'.$imagen["imagen"]["name"];
            move_uploaded_file($imagen["imagen"]["tmp_name"],$ruta);
            
            include_once 'Connection.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("INSERT INTO libros(isbn, titulo, autor, editorial, id_estado, ejemplares, ejemplares_prestados, edicion,imagen, fecha_registro) VALUES(?, ?,?, ?, ?, ?, ?, ?, ?,?)");
            $query->execute(array($this->isbn, $this->titulo, $this->autor, $this->editorial, $this->id_estado, $this->ejemplares, $this->ejemplares_prestados, $this->edicion, $imagen["imagen"]["name"], $this->fecha_registro));
            Database::disconnect();
        }

        public function modificarLibro($isbn, $titulo, $autor, $editorial, $id_estado, $ejemplares, $edicion, $imagen,$imagen_guardada, $id_libro){

            if ($imagen["imagen"]['size']>0){
                unlink('img/libros/'.$imagen_guardada);
                move_uploaded_file($imagen["imagen"]["tmp_name"],'img/libros/'.$imagen["imagen"]["name"]);
                $imagen = $imagen["imagen"]["name"];
            }else{
               $imagen = $imagen_guardada;
            }

            include_once 'Connection.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("UPDATE libros SET isbn=?, titulo=?,autor=?,editorial=?,id_estado=?,ejemplares=?,edicion=?,imagen=? WHERE id=?");
            $query->execute(array($isbn,$titulo, $autor, $editorial,$id_estado, $ejemplares, $edicion, $imagen,$id_libro));
            Database::disconnect();
        }
        
        public function eliminarLibro($id_libro, $imagen){
            include_once 'Connection.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("DELETE FROM libros WHERE id=?");
            $query->execute(array($id_libro));
            Database::disconnect();
            unlink('img/libros/'.$imagen);
        }

        public function generarPDF(){

        }
    }
?>