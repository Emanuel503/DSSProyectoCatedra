<?php
    class Multas{
        private $id;
        private $multa;
        private $costo;
        private $descripcion;
        private $dias_maximos_multa;

        public function __construct(){
            $this->id=0;
            $this->multa="";
            $this->costo=0;
            $this->descripcion="";
        }

        public function mostrarMultas(){
            include 'Connection.php';	
            $connection = Database::connect();
            $query =("SELECT * FROM multas");
            $multas = $connection->query($query);
            Database::disconnect();
            return $multas;
        }
        
        public function modificarMulta($id_multa, $costo, $descripcion, $dias_maximos_multa){
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("UPDATE multas SET costo=?, descripcion=?, dias_maximos_multa=? WHERE id=?");
            $query->execute(array($costo,$descripcion, $dias_maximos_multa, $id_multa));
            Database::disconnect();
        }
    }
?>