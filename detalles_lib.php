<h1>Detalles del libro</h1>
<a href="page.php?pag=ver_lib.php" class="btn btn-outline-secondary">Regresar</a><br><br>

<?php
    include_once "class/Libro.php";
    $libro = new Libro();
    $datos = $libro->mostrarLibro($_GET["id"]);
?>

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
    </div>
    
</div>

<?php
    if(isset($_GET["modificado"])){
        echo '
        <div class="alert alert-success alert-dismissible fade show fixed-top text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <b>Libro modificado correctamente</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
?>