<?php function informacion($empresa, $servicio="internet", $plan="none"){

$sql= "SELECT `EM`.`razon_social`,`PL`.`id_plan`, `PL`.`nombre_plan`, `PL`.`precio`, `SV`.`tipo_servicio`, `PQ`.`descripcion`, `PQ`.`caracteristica` FROM `paquete` `PQ` 
INNER JOIN `plan` `PL` ON `PL`.`id_plan`=`PQ`.`id_plan`
INNER JOIN `servicio` `SV` ON `SV`.`id_servicio`=`PQ`.`id_servicio`
INNER JOIN `empresa` `EM` ON `EM`.`id_empresa` = `PL`.`id_empresa`
WHERE `EM`.`razon_social`= \"".$empresa."\" ";
if($plan!="none"){
    $sql= $sql."AND `PL`.`nombre_plan` = \"".$plan."\"";
}
include PROJECT_ROOT_PATH."/includes/funciones/db_conexion.php";

//Revisar que todo se haya cumplido
if($consulta = $con->query($sql)){

}else{//Se ejecuta si no haya nada
    die("Existió un error en la consulta: ".$con->error);
}

    $planes=array();
    $detalles= array();
    while( ($resultado = $consulta->fetch_assoc()) != null ){
        $planes[$resultado["nombre_plan"]]=array(
            "id_plan"=>$resultado["id_plan"],
            "razon_social" => $resultado["razon_social"],
            "nombre_plan" => $resultado["nombre_plan"],
            "precio" => $resultado["precio"],
            "tipo_servicio" => $resultado["tipo_servicio"]
        );
        $detalles[$resultado["nombre_plan"]][]= array(
            "descripcion" => $resultado["descripcion"],
            "caracteristica" => $resultado["caracteristica"]
        );

        array_push($planes[$resultado["nombre_plan"]], $detalles[$resultado["nombre_plan"]]);
    }
    mysqli_close($con);
return $planes;
}?>
<?php function consultarSolicitud(){
include PROJECT_ROOT_PATH."/includes/funciones/db_conexion.php";
$sql= "SELECT `solicitud`.`id_solicitud`,`US`.`nombre`, `US`.`telefono`, `US`.`correo` FROM `solicitud` INNER JOIN `usuario` `US` ON `US`.`id_usuario`=`solicitud`.`id_usuario` ORDER BY `id_solicitud` DESC LIMIT 1";

try{
    $elemento = $con->query($sql);
    $resultado= $elemento->fetch_all(MYSQLI_ASSOC);

    $con->close();
    return reset($resultado);
}catch(Exception $e){
    die("Existió un error: ".$con->errno."  <br>Además: ".$con->error);
}

}

?>
<?php function consultaInformacion($empresa, $servicio="internet"){
$planes =informacion($empresa, $servicio);

foreach( $planes as  $plan):
    echo '<div class="plan">';
        echo '<h3>'.$plan["nombre_plan"].'</h3>';
        echo '<p>Ver detalle ></p>';
        echo '<div class="detalle">';
            echo '<ul>';
                echo '<li>Precio '.'<span class="fw-bold">$'.$plan["precio"].'</span>'.'</li>';
                foreach($plan[0] as $detalle):
                    echo '<li>'.$detalle["descripcion"].' <span class="fw-bold">'.$detalle["caracteristica"].'</span>'.'</li>';
                endforeach;
            echo "</ul>";
            echo '<a href="compra.php?razon_social='.$plan["razon_social"].'&nombre_plan='.$plan["nombre_plan"].'" class="boton boton-siguiente mayuscula">Contratar ></a>';
        echo "</div>";
    echo "</div>";
endforeach;
}?>
<?php

function consultarPlan($empresa, $servicio="internet", $plan){
$planes =informacion($empresa, $servicio, $plan);

foreach( $planes as  $plan):
echo '<div class="informacion-plan">';
    echo '<div class="detalle plan-seleccion" style="display: block;">';
        echo '<ul>';
            echo '<h3 class="centrar-txt">'.$plan["nombre_plan"].'</h3><br><br>';
            foreach($plan[0] as $detalle):
                echo '<li>'.$detalle["descripcion"].' <span class="fw-bold">'.$detalle["caracteristica"].'</span>'.'</li>';
            endforeach;
            echo '<br><br><li>Precio: $'.'<span class="fw-bold">'.$plan["precio"].'</span>'.'</li>';
        echo "</ul>";
    echo "</div>";
echo '</div>';
return $plan;
endforeach;

}
?>
