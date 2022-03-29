<h1>Modificar libro</h1>

<?php
    include_once "class/Libro.php";
    $libro = new Libro();
    $datos = $libro->mostrarLibro($_GET["id"]);
?>
<form action="#" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg">
            <label for="isbn" class="col-form-label">N° ISBN: </label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $datos["isbn"];?>">

            <label for="nombre" class="col-form-label">Titulo del libro: </label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $datos["titulo"];?>"> 

            <label for="autor" class="col-form-label">Autores: </label>
            <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $datos["autor"];?>">

            <label for="editorial" class="col-form-label">Editorial: </label>
            <input type="text" class="form-control" id="editorial" name="editorial" value="<?php echo $datos["editorial"];?>"> 

            <label for="ejemplares" class="col-form-label">N° de ejemplares registados: </label>
            <input type="text" class="form-control" id="ejemplares" name="ejemplares" value="<?php echo $datos["ejemplares"];?>"> 

            <label for="edicion" class="col-form-label">Edicion: </label>
            <input type="text" class="form-control" id="edicion" name="edicion" value="<?php echo $datos["edicion"];?>"> 

            <label for="id_estado" class="col-form-label">Estado del libro: </label>
            <select class="form-select" name="id_estado">
                <?php
                    $estados = $libro->mostrarEstadosLibro();
                    foreach ($estados as $estado) {
                        if($datos["id_estado"] == $estado["id"]){
                            echo '<option selected value="'.$estado["id"].'">'.$estado["estado"].'</option>';
                        }else{
                            echo '<option value="'.$estado["id"].'">'.$estado["estado"].'</option>';
                        }
                        
                    }
                ?>
            </select>

            <label for="imagen" class="col-form-label">Imagen de portada: </label>        
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            <input hidden name="imagen_guardada" value="<?php echo $datos["imagen"];?>"><br><br>

            <button name="enviar" type="submit" class="btn btn-success">Modificar</button>
            <a href="page.php?pag=ver_lib.php" class="btn btn-secondary">Cancelar</a><br><br>
    
        </div>
    </div>
</form>

<?php
    if(isset($_POST["enviar"])){
        $isbn = $_POST["isbn"];
        $titulo = $_POST["titulo"];
        $autor = $_POST["autor"];
        $editorial = $_POST["editorial"];
        $ejemplares = $_POST["ejemplares"];
        $edicion = $_POST["edicion"];
        $id_estado = $_POST["id_estado"];
        $imagen_guardada = $_POST["imagen_guardada"];
        $imagen = $_FILES;

        $libro->modificarLibro($isbn,$titulo,$autor,$editorial,$id_estado,$ejemplares,$edicion,$imagen,$imagen_guardada,$_GET["id"]);
        echo "<script>window.location.href = 'page.php?pag=detalles_lib.php&id=".$_GET["id"]."&modificado=si';</script>";
    }
?>