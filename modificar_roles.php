<?php
    $id_rol = $_GET["id"];

    include_once "class/Connection.php";
    $connection = Database::connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $query = $connection->prepare("SELECT * FROM roles WHERE id=?");
    $query->execute(array($id_rol));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
?>

<form action="#" method="POST">
    <div class="row g-3 align-items-center">
        <div class="col-2">
            <label for="rol" class="col-form-label">Rol de usuario: </label>
        </div>
        <div class="col-10">
            <input type="text" readonly class="form-control" id="rol" name="rol" value="<?php echo $data['rol']?>">
        </div>

        <div class="col-2">
            <label for="descripcion" class="col-form-label">Descripcion: </label>
        </div>
        <div class="col-10">
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $data['descripcion']?>">
        </div>

        <div class="col-2">
            <label for="cantidad_libros" class="col-form-label">Cantidad maxima de libros prestados: </label>
        </div>
        <div class="col-10">
            <input type="text" class="form-control" id="cantidad_libros" name="cantidad_libros" value="<?php echo $data['cantidad_libros']?>">
        </div>

        <div class="col-2">
            <label for="dias_maximos_prestamo" class="col-form-label">Cantidad maxima de dias de prestamos: </label>
        </div>
        <div class="col-10">
            <input type="text" class="form-control" id="dias_maximos_prestamo" name="dias_maximos_prestamo" value="<?php echo $data['dias_maximos_prestamo']?>">
        </div>
    </div>
    <br> <button id="modificar_rol" name="enviar" type="submit" class="btn btn-success">Guardar cambios</button>
    <a href="page.php?pag=configuracion.php&opc=conf.libro.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php
    if(isset($_POST["enviar"])){
        $descripcion = $_POST["descripcion"];
        $cantidad_libros = $_POST["cantidad_libros"];
        $dias_maximos_prestamo = $_POST["dias_maximos_prestamo"];

        include "class/Roles.php";
        $rol = new Roles();
        $rol->modificarRol($id_rol, $descripcion, $cantidad_libros, $dias_maximos_prestamo);
        echo "<script>window.location.href = 'page.php?pag=configuracion.php&opc=conf.libro.php&modificado=si';</script>";
    }
?>