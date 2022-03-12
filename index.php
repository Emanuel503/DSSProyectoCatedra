<?php
    include_once "header.php";
?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col login shadow-lg rounded">
                    <h1 class="text-center">Inicio de sesion</h1>
                    <h2 class="text-center">Sistema bibliotecario</h2>
                    <img src="img/libros.png" class="" alt="Libros">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label"><b>Correo electronico:</b></label>
                            <input type="email" class="form-control" id="email" aria-describedby="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><b>Contraseña:</b></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button name="enviar" type="submit" class="btn btn-primary">Iniciar sesion</button>
                        </div>  
                    </form>
                </div>
                <div class="col"></div>
            </div>
        </div> 
    </body>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" ></script>
</html>
<?php
    if(isset($_POST['enviar'])){

        include 'class/connection.php';	
        $connection = Database::connect();
        $sql =("SELECT * FROM usuarios");

        foreach ($connection->query($sql) as $row) {
            if($row["email"] == $_POST["email"] && $row["password"]==$_POST["password"]){
                session_start();
                $_SESSION["sesion"]="si";
                $_SESSION["id"]=$row["id"];
                $_SESSION["id_rol"]=$row["id_rol"];
                $_SESSION["email"]=$row["email"];
                $_SESSION["password"]=$row["password"];
                $_SESSION["nombre"]=$row["nombre"];
                $_SESSION["identificacion"]=$row["identificacion"];
                $_SESSION["telefono"]=$row["telefono"];
                $_SESSION["direccion"]=$row["direccion"];
                $_SESSION["estado"]=$row["estado"];
                header("Location: content.php");
            }
        }
        Database::disconnect();
        echo '
        <div class="alert alert-warning alert-dismissible fade show fixed-top text-center" role="alert">
            <b>Email o contaseña incorrectos</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
?>