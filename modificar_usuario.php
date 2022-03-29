<form action="#" method="POST">
    <div class="row g-3 align-items-center">
        <div class="col-2">
            <label for="password" class="col-form-label">Contraseña: </label>
        </div>
        <div class="col-10">
            <input type="text" class="form-control" id="password" name="password" value="<?php echo $_SESSION['password']?>">
        </div>
    </div>
    <br> <button id="modificar_usuario" name="enviar" type="submit" class="btn btn-success">Guardar cambios</button>
    <a href="page.php?pag=configuracion.php&opc=conf.cuenta.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php
    if(isset($_POST["enviar"])){
        if(!$_POST["password"]==""){
            include_once "class/Usuario.php";
            $usuario = new Usuario();
            $usuario->modificarUsuario($_POST["password"],$_SESSION["id"]);
            echo "<script>window.location.href = 'page.php?pag=configuracion.php&opc=conf.cuenta.php&modificado=si';</script>";
        }
    }
?>