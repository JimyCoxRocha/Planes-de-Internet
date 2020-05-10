<?php include_once "includes/templates/header.php";?>
<?php define('PROJECT_ROOT_PATH', __DIR__);?>
<?php
    //Recolectar información de la página anterior
    if(isset($_GET["razon_social"])){
        $razon_social= $_GET["razon_social"];
        $nombre_plan= $_GET["nombre_plan"];
    }     
?>

<section class="contenedor clearfix info-compra" id="solicitar">
    <?php
        $confirmarEnvio=0;
            if(isset($_POST["submit"])){
                $nombre= $_POST["nombre"];
                $telefono=$_POST["telefono"];
                $correo=$_POST["correo"];
            }
                
    ?>
    <h1>Solicitud de plan</h1>
    <?php include_once "includes/funciones/funciones.php";?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?razon_social='.$_GET["razon_social"].'&nombre_plan='.$_GET["nombre_plan"].''?>" method="POST" target="frame"><!--Este atributo especifica una ventana de navegador de destino-->
            
            <label id="nombre">*Nombre completo<input type="text" placeholder="Nombre y Apellido" name="nombre" id="nombre" onkeypress="return soloLetras(event)" required></label><br>
            <?php if(isset($_POST["submit"])){ validarNombre($nombre, $confirmarEnvio);}?>
            
            <label id="telefono">*Teléfeno celular<input type="text" placeholder="Teléfeno" name="telefono" id="telefono" pattern="[0-9]{10}" required></label><br><!--Patter nos permite modelar un formato que recibiremos Pattern = modelo-->
            <?php if(isset($_POST["submit"])){ validarTel($telefono, $confirmarEnvio);}?>
            
            <label id="correo">*Correo electrónico<input type="email" placeholder="Correo electrónico" name="correo" id="correo" required></label>
            <?php if(isset($_POST["submit"])){ validarCorreo($correo, $confirmarEnvio);}?>
            
            <a href="index.php" class="boton boton-cancelar">&lt; Cancelar</a>
            <input type="submit" class="boton boton-siguiente" id="submit" value="Siguiente >" name="submit">
            
        </form>
        <!--Imprimir el plan-->
        <?php include "includes/funciones/cargar_informacion.php";
            $informacion_plan=consultarPlan($razon_social, "internet", $nombre_plan);
        ?>
    <?php
    
        //Vamos a enviar la información a la base de datos
            if( $confirmarEnvio == 3 ){
                include "includes/funciones/subir_informacion.php";
                
                agregarSolicitud($nombre, $telefono, $correo, $informacion_plan);
            }
    ?>
</section>

<section id="mostrar-resultado" class="contenedor clearfix info-compra">
    <iframe name="frame" style="display: none;"></iframe>
    <div class="resultado-agradecimiento clearfix">
        <h2>¡Gracias por su tiempo!</h2>
        <i class="fas fa-tv"></i>
        <i class="fas fa-wifi"></i>
        <i class="fas fa-phone"></i>
    </div>
    <div class="resultado-informacion">
        <h2 class="fw-300">Datos de Contacto</h3>
        <ul class="detalle plan-seleccion" style="display: block;">
        <?php 
                    
            $datosCliente=consultarSolicitud();
        ?>
            <li class="fw-bold">Nombre: <span class="fw-300"><?php echo $datosCliente["nombre"];?></span></li>
            <li class="fw-bold">Teléfono celular: <span class="fw-300"><?php echo $datosCliente["telefono"];?></span></li>
            <li class="fw-bold">Correo: <span class="fw-300"><?php echo $datosCliente["correo"];?></span></li>
        </ul>
        <p>Ahora nos contacteremos con la información otorgada para concretar el pedido señor <span class="fw-bold"><?php echo $datosCliente["nombre"];?></span>.</p>
    </div>
    <div class="resultado-plan">
        <h2 class="fw-300">Resumen Plan</h3>
        <div class="centrar-txt">
            <?php consultarPlan($razon_social, "internet", $nombre_plan);?>
        </div>
    </div>
    <div class="resultado-precio clearfix">
        <h3 class="fw-300">El Total a Pagar: </h3>
        <span class="fw-bold">$<?php echo $informacion_plan["precio"];?></span>
    </div>
    <a href="index.php" class="boton boton-siguiente">Continuar ></a>
</section>



<?php include_once "includes/templates/footer.php";?>