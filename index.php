<?php
    session_start();
    if(isset($_SESSION["sesion"])){
        header("Location: page.php?pag=pre_lib.php");
    }
    include_once "header.php";
?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col-xl login shadow-lg rounded">
                    <h1 class="text-center">Inicio de sesión</h1>
                    <h2 class="text-center">Sistema bibliotecario</h2>
                    <img src="img/libros.png" class="" alt="Libros">
                    <form action="#" method="POST">

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="name@example.com"  name="email" required>
                            <label for="email">Correo electronico</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                            <label for="password">Contraseña</label>
                        </div>
                        <br>
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

        include_once 'class/Usuario.php';
        $usuario = new Usuario();

        if($usuario->inciarSesion($_POST["email"], $_POST["password"])){
            header("Location: page.php?pag=pre_lib.php");
        }else{
            echo '
            <div class="alert alert-warning alert-dismissible fade show fixed-top text-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <b>Email o contaseña incorrectos</b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
    }
?>