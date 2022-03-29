<h1>Configuracion</h1><br>
<div class="row">
    <div class="col-sm-4">
        <h5>Opciones</h5>
        <hr>
        <div class="submenu">
            <span><a class="<?php if($_GET["opc"]=="conf.cuenta.php") echo "submenu-selected"?>" href="page.php?pag=configuracion.php&opc=conf.cuenta.php">Datos de la cuenta</a></span>
            <?php
                if($_SESSION["id_rol"]==1){
                    ?>
                    <span><a class="<?php if($_GET["opc"]=="conf.libro.php") echo "submenu-selected"?>" href="page.php?pag=configuracion.php&opc=conf.libro.php">Prestamos de libros</a></span>
                    <span><a class="<?php if($_GET["opc"]=="conf.tarifa.php") echo "submenu-selected"?>" href="page.php?pag=configuracion.php&opc=conf.tarifa.php">Tarifas de multas</a></span>
                    <?php 
                }   
            ?>
            </div>
        <hr><br>
    </div>
    <div class="col-xl">
        <?php
            if(isset($_GET["opc"])){
                $pagConf = $_GET["opc"];
            }else{
                $pagConf = "conf.cuenta.php";
            }
            include_once $pagConf;
        ?>
    </div>
</div>