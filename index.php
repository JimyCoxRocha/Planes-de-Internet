<?php define('PROJECT_ROOT_PATH', __DIR__);?>
<?php include_once "includes/templates/header.php";?>

    <div class="contenedor clearfix fondo-body">
        <main class="planes clearfix">
            <img src="icon/flecha-izquierda.png" alt="izquierda">
            <h2 class="mayuscula">Servicios de internet</h2>
            <img src="icon/flecha-derecha.png" alt="izquierda">
        </main>

        <article class="empresa_Claro centrar-txt">
            <img src="img/logo-claro.png" alt="Claro logo">
            <?php include_once "includes/funciones/cargar_informacion.php";
            consultaInformacion("Claro", "internet");
            ?>
                <!--Mi Claro 50 Megas GPON-->
                <!--Internet Sin Límites (Internet Inalámbrico)-->
        </article>
        <article class="empresa_TVCable centrar-txt">
            <img src="img/log-TVCable.png" alt="TVCable logo">
            <?php
                consultaInformacion("Tv Cable", "internet");
                
            ?>
        </article>
    </div>

<?php include_once "includes/templates/footer.php";?>