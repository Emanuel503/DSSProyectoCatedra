<?php
    include_once "class/Libro.php";
    $libro = new Libro();
    $datos = $libro->mostrarLibro($_GET["id"]);
?>
<h1>¿Estas seguro que quieres eliminar el libro?</h1><br>
<form action="#" method="POST">
    <div class="row">
    <div class="col-lg">
        <label for="isbn" class="col-form-label">N° ISBN: </label>
        <input type="text" class="form-control" id="isbn" name="isbn" readonly="true" value="<?php echo $datos["isbn"];?>">

        <label for="nombre" class="col-form-label">Titulo del libro: </label>
        <input type="text" class="form-control" id="titulo" name="titulo" readonly="true" value="<?php echo $datos["titulo"];?>"> 

        <label for="autor" class="col-form-label">Autores: </label>
        <input type="text" class="form-control" id="autor" name="autor" readonly="true" value="<?php echo $datos["autor"];?>">

        <label for="editorial" class="col-form-label">Editorial: </label>
        <input type="text" class="form-control" id="editorial" name="editorial" readonly="true" value="<?php echo $datos["editorial"];?>"> 

        <label for="ejemplares" class="col-form-label">N° de ejemplares registados: </label>
        <input type="text" class="form-control" id="ejemplares" name="ejemplares" readonly="true" value="<?php echo $datos["ejemplares"];?>"> 

        <label for="ejemplares_disponibles" class="col-form-label">N° de ejemplares disponibles: </label>
        <input type="text" class="form-control" id="ejemplares_disponibles" name="ejemplares_disponibles" readonly="true" value="<?php echo $datos["ejemplares"]-$datos["ejemplares_prestados"];?>"> 

        <label for="edicion" class="col-form-label">Edicion: </label>
        <input type="text" class="form-control" id="edicion" name="edicion" readonly="true" value="<?php echo $datos["edicion"];?>"> 

        <label for="fecha_registro" class="col-form-label">Fecha de registro: </label>
        <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" readonly="true" value="<?php echo $datos["fecha_registro"];?>"> 

        <label for="id_estado" class="col-form-label">Estado del libro: </label>
        <input type="text" class="form-control" id="id_estado" name="id_estado" readonly="true" value="<?php echo $datos["estado"];?>"> 
    </div>
    
    <div class="col-auto m-2">
        <img alt="portada" width="300px" class="img-fluid" src="img/libros/<?php echo $datos["imagen"];?>">
        <input hidden name="imagen" value="<?php echo $datos["imagen"];?>">
    </div>
    </div><br>
    <button name="enviar" type="submit" class="btn btn-danger">Eliminar</button>
    <a class="btn btn-secondary" href="page.php?pag=ver_lib.php">Cancelar</a>
</form>
<?php

    if(isset($_POST["enviar"])){
        $libro->eliminarLibro($_GET["id"],$_POST["imagen"]);
        echo "<script>window.location.href = 'page.php?pag=ver_lib.php&eliminado=si';</script>";
    }
?>