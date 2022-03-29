<h1>Modificar estado del usuario</h1><br>
<form action="#" method="POST">
<h3>Datos del usuario</h3>
<?php
    include_once "class/Usuario.php";
    $usuario = new Usuario();
    $datos = $usuario ->mostrarUsuario($_GET["id"]);
?>

<div class="row g-3 align-items-center">
    <div class="col-2">
        <label for="nombre" class="col-form-label">Nombre completo: </label>
    </div>
    <div class="col-10">
        <input type="text" class="form-control" id="nombre" name="nombre" readonly="true" value="<?php echo $datos["nombre"]?>">
    </div>

    <div class="col-2">
        <label for="identificacion" class="col-form-label">Identificacion: </label>
    </div>
    <div class="col-10">
        <input type="text" class="form-control" id="identificacion" name="identificacion" readonly="true" value="<?php echo $datos["identificacion"]?>">
    </div>

    <div class="col-2">
        <label for="telefono" class="col-form-label">Numero de telefono: </label>
    </div>
    <div class="col-10">
        <input type="text" class="form-control" id="telefono" name="telefono" readonly="true" value="<?php echo $datos["telefono"]?>">
    </div>

    <div class="col-2">
        <label for="direccion" class="col-form-label">Direccion: </label>
    </div>
    <div class="col-10">
        <input type="text" class="form-control" id="direccion" name="direccion" readonly="true" value="<?php echo $datos["direccion"]?>">
    </div>

    <div class="col-2">
        <label for="fecha_registro" class="col-form-label">Fecha de registro: </label>
    </div>
    <div class="col-10">
        <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" readonly="true" value="<?php echo $datos["fecha_registro"]?>">
    </div>

    <div class="col-2">
        <label for="email" class="col-form-label">Email: </label>
    </div>
    <div class="col-10">
        <input type="text" class="form-control" id="email" name="email" readonly="true" value="<?php echo $datos["email"]?>">
    </div>

    <div class="col-2">
        <label for="rol" class="col-form-label">Rol de la cuenta: </label>
    </div>
    <div class="col-10">
        <select disabled class="form-select">
            <?php
                include_once "class/Roles.php";
                $roles = new Roles();
                $consul = $roles->mostrarRoles();
                foreach ($consul as $rol) {
                    if($rol["id"]==$datos["id_rol"]){
                        echo "<option>".$rol["rol"]."</option>";
                    }
                }
            ?>
        </select>
    </div>

    <div class="col-2">
        <label for="id_estado" class="col-form-label">Estado de la cuenta: </label>
    </div>
    <div class="col-10">
        <select name="id_estado" class="form-select">
            <?php
                $consul2 = $usuario->mostrarEstadoUsuario();
                foreach ($consul2 as $estado) {
                    if($estado["id"]==$datos["id_estado"]){
                        echo "<option selected value='".$estado["id"]."'>".$estado["estado"]."</option>";
                    }else{
                        echo "<option value='".$estado["id"]."'>".$estado["estado"]."</option>";
                    }
                }
            ?>
        </select>
    </div>
</div><br>
    <button id="enviar" name="enviar" type="submit" class="btn btn-primary">Guardar cambios</button>
    <a href="page.php?pag=detalles_usuario.php&id=<?php echo $_GET["id"]?>" class="btn btn-secondary">Cancelar</a>
</form>

<?php
    if(isset($_POST["enviar"])){
        $usuario->cambiarEstadoUsuario($_GET["id"],$_POST["id_estado"]);
        echo "<script>window.location.href = 'page.php?pag=detalles_usuario.php&id=".$_GET["id"]."&modificado=si';</script>";
    }
?>