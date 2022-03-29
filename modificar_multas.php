<?php
    $id_multa = $_GET["id"];

    include_once "class/Connection.php";
    $connection = Database::connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $query = $connection->prepare("SELECT * FROM multas WHERE id=?");
    $query->execute(array($id_multa));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
?>

<form action="#" method="POST">
    <div class="row g-3 align-items-center">
        <div class="col-2">
            <label for="rol" class="col-form-label">Multa: </label>
        </div>
        <div class="col-10">
            <input type="text" readonly class="form-control" id="multa" name="multa" value="<?php echo $data['multa']?>">
        </div>

        <div class="col-2">
            <label for="descripcion" class="col-form-label">Descripcion: </label>
        </div>
        <div class="col-10">
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $data['descripcion']?>">
        </div>

        <div class="col-2">
            <label for="costo" class="col-form-label">Costo: </label>
        </div>
        <div class="col-10">
            <input type="text" class="form-control" id="costo" name="costo" value="<?php echo $data['costo']?>">
        </div>

        <div class="col-2">
            <label for="dias_maximos_multa" class="col-form-label">Cantidad maxima de dias de multa: </label>
        </div>
        <div class="col-10">
            <input type="text" class="form-control" id="dias_maximos_multa" name="dias_maximos_multa" value="<?php echo $data['dias_maximos_multa']?>">
        </div>
    </div>
    <br> <button id="modificar_multa" name="enviar" type="submit" class="btn btn-success">Guardar cambios</button>
    <a href="page.php?pag=configuracion.php&opc=conf.tarifa.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php
    if(isset($_POST["enviar"])){
        $descripcion = $_POST["descripcion"];
        $costo = $_POST["costo"];
        $dias_maximos_multa = $_POST["dias_maximos_multa"];

        include "class/Multas.php";
        $rol = new Multas();
        $rol->modificarMulta($id_multa, $costo, $descripcion,$dias_maximos_multa);
        echo "<script>window.location.href = 'page.php?pag=configuracion.php&opc=conf.tarifa.php&modificado=si';</script>";
    }
?>