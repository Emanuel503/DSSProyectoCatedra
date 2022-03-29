<h1>Detalles de usuario</h1><br>
<a href="page.php?pag=ver_users.php" class="btn btn-outline-secondary">Regresar</a><br><br>
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
        <select disabled class="form-select">
            <?php
                $consul2 = $usuario->mostrarEstadoUsuario();
                foreach ($consul2 as $estado) {
                    if($estado["id"] == $datos["id_estado"]){
                        echo "<option>".$estado["estado"]."</option>";
                    }
                }
            ?>
        </select>
    </div>
</div><br>
<a href="page.php?pag=modificar_estado_user.php&id=<?php echo $_GET["id"]?>" class="btn btn-success">Modificar estado</a>

<br><br><h3>Libros prestados del usuario</h3>

<div class="table-responsive">
<table class="table table-active table-striped table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>Titulo y N° ISBN del libro</td>
            <td>Nombre e identificacion de usuario</td>
            <td>Fecha del prestamos</td>
            <td>Fecha de devolucion</td>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
</div>

<?php

    if(isset($_GET["modificado"]) && $_GET["modificado"]="si"){
        echo '
        <div class="alert alert-success alert-dismissible fade show fixed-top text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <b>Estado modificado</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
?>