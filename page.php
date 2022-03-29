 <?php
    include_once "validar_sesion.php";
    include_once "header.php";
    include_once "nav_menu.php";

    if(isset($_GET["pag"])){
        $pagina = $_GET["pag"];
    }else{
        $pagina = "pre_lib.php";
    }
    
    include_once $pagina;
    include_once "footer.php";
?>