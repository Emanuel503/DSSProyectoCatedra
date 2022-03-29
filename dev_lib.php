<h1>Devolucion de libros</h1><br>
<?php 
    if($_SESSION["id_rol"]==1){
        echo '<button data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-primary">Devolucion libro</button>';
        echo '<a href="" class="btn btn-danger btn-pdf">PDF</a><br><br>';
    }

    include_once "class/Libro.php";
    include_once "class/Usuario.php";
    $libros = new Libro();
    $usuarios = new Usuario();
?>
<div class="table-responsive">
<table class="table table-active table-striped table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>Titulo y N° ISBN del libro</td>
            <td>Nombre e identificacion de usuario</td>
            <td>Fecha del prestamos</td>
            <td>Fecha de devolucion</td>
            <td>Multa</td>
            <td>Estado</td>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Devolver Libro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
        <div class="row g-3 align-items-center">
              <div class="col-2">
                  <label for="isbn" class="col-form-label">Seleccionar libro: </label>
              </div>
              <div class="col-10">
                  <select name="libro" class="form-select">
                    <?php
                      $datos = $libros->mostrarLibros();
                      foreach($datos as $libro){
                        echo '<option value="'.$libro["id"].'">'.$libro["titulo"].'</option>';
                      }
                    ?>
                  </select>
              </div>

              <div class="col-2">
                  <label for="isbn" class="col-form-label">Seleccionar el usuario: </label>
              </div>
              <div class="col-10">
                  <select name="libro" class="form-select">
                    <?php
                      $datos2 = $usuarios->mostrarUsuarios();
                      foreach($datos2 as $usuario){
                        echo '<option value="'.$usuario["id"].'">'.$usuario["nombre"].'</option>';
                      }
                    ?>
                  </select>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Devolver</button>
      </div>
      </form>
    </div>
  </div>
</div>