<h1>Ver libros</h1><br>
<?php 
    if($_SESSION["id_rol"]==1){
        echo '<button data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-primary">Registrar libro</button>';
        echo '<a href="" class="btn btn-danger btn-pdf">PDF</a><br><br>';
    }
?>
<div class="table-responsive">
<table class="table table-active table-striped table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>ISBN</td>
            <td>Titulo</td>
            <td>Autores</td>
            <td>Editorial</td>
            <td>Estado</td>
            <td>N° de ejemplares disponibles</td>
            <td>Edicion</td>
            <td>Opciones</td>
        </tr>
    </thead>
    <tbody>
        <?php
            include_once "class/Libro.php";
            $libros=new Libro();
            $datos = $libros->mostrarLibros();
            $contador=0;
            
            foreach ($datos as $libro) {
                $contador++;
                echo "<tr>";
                    echo "<td>".$contador."</td>";
                    echo "<td>".$libro["isbn"]."</td>";
                    echo "<td>".$libro["titulo"]."</td>";
                    echo "<td>".$libro["autor"]."</td>";
                    echo "<td>".$libro["editorial"]."</td>";
                    echo "<td>".$libro["estado"]."</td>";
                    echo "<td>".($libro["ejemplares"]-$libro["ejemplares_prestados"])."</td>";
                    echo "<td>".$libro["edicion"]."</td>";
                    echo "<td>";
                        echo "<a href='page.php?pag=detalles_lib.php&id=".$libro["0"]."' class='btn btn-primary'>Ver</a>";
                    if($_SESSION["id_rol"]==1){
                        echo " <a href='page.php?pag=modificar_lib.php&id=".$libro["0"]."' class='btn btn-success'>Modificar</a>";
                        echo " <a href='page.php?pag=eliminar_lib.php&id=".$libro["0"]."' class='btn btn-danger'>Eliminar</a>";
                    }
                    echo "</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Libro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data">

            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label for="isbn" class="col-form-label">N° ISBN: </label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control" id="isbn" name="isbn" required>
                </div>

                <div class="col-2">
                    <label for="titulo" class="col-form-label">Titulo del libro: </label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>

                <div class="col-2">
                    <label for="autor" class="col-form-label">Autores: </label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control" id="autor" name="autor" required>
                </div>

                <div class="col-2">
                    <label for="editorial" class="col-form-label">Editorial: </label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control" id="editorial" name="editorial" required>
                </div>
                
                <div class="col-2">
                    <label for="ejemplares" class="col-form-label">N° de ejemplares: </label>
                </div>
                <div class="col-10">
                    <input type="number" class="form-control" id="ejemplares" name="ejemplares" required>
                </div>

                <div class="col-2">
                    <label for="edicion" class="col-form-label">N° de edicion: </label>
                </div>
                <div class="col-10">
                    <input type="number" class="form-control" id="edicion" name="edicion" required>
                </div>

                <div class="col-2">
                    <label for="imagen" class="col-form-label">Imagen de portada: </label>
                </div>
                <div class="col-10">
                    <input type="file" class="form-control" id="imagen" name="imagen" required accept="image/*">
                </div>

                <div class="col-2">
                    <label for="id_estado" class="col-form-label">Estado del libro: </label>
                </div>
                <div class="col-10">
                    <select class="form-select" name="id_estado">
                        <?php
                            $estados = $libros->mostrarEstadosLibro();
                            foreach ($estados as $estado) {
                                echo '<option value="'.$estado["id"].'">'.$estado["estado"].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" name="enviar" class="btn btn-primary">Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
    if(isset($_POST["enviar"])){
        $isbn = $_POST["isbn"];
        $titulo = $_POST["titulo"];
        $autor = $_POST["autor"];
        $editorial = $_POST["editorial"];
        $ejemplares = $_POST["ejemplares"];
        $edicion = $_POST["edicion"];
        $imagen = $_FILES;
        $id_estado = $_POST["id_estado"];

        $libros->agregarLibro($isbn,$titulo,$autor,$editorial,$ejemplares,$edicion,$imagen,$id_estado);
        echo "<script>window.location.href = 'page.php?pag=ver_lib.php&guardado=si';</script>";
    }

    if(isset($_GET["eliminado"])){
        echo '
        <div class="alert alert-danger alert-dismissible fade show fixed-top text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <b>Libro eliminado correctamente</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }

    if(isset($_GET["guardado"])){
        echo '
        <div class="alert alert-success alert-dismissible fade show fixed-top text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <b>Libro guardado correctamente</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
?>