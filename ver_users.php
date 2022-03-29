<h1>Ver usuarios</h1><br>
<a href="" class="btn btn-danger btn-pdf">PDF</a><br><br>
<div class="table-responsive">
<table class="table table-active table-striped table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>Nombre</td>
            <td>Email</td>
            <td>Identificacion</td>
            <td>Telefono</td>
            <td>Direccion</td>
            <td>Estado</td>
            <td>Rol</td>
            <td>Fecha de registro</td>
            <td>Opciones</td>
        </tr>
    </thead>
    <tbody>
        <?php
            include_once 'class/Usuario.php';
            $usuarios = new Usuario();
            $datos = $usuarios->mostrarUsuarios();

            $contador=0;
            foreach ($datos as $usuario) {
                $contador++;
                echo "<tr>";
                    echo "<td>".$contador."</td>";
                    echo "<td>".$usuario["nombre"]."</td>";
                    echo "<td>".$usuario["email"]."</td>";
                    echo "<td>".$usuario["identificacion"]."</td>";
                    echo "<td>".$usuario["telefono"]."</td>";
                    echo "<td>".$usuario["direccion"]."</td>";
                    echo "<td>".$usuario["estado"]."</td>";
                    echo "<td>".$usuario["rol"]."</td>";
                    echo "<td>".$usuario["fecha_registro"]."</td>";
                    echo "<td>
                            <a href='page.php?pag=detalles_usuario.php&id=".$usuario["0"]."' class='btn btn-primary'>Ver detalles</a>
                          </td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
</div>