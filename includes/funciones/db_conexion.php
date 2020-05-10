<?php 

    $con= new mysqli("localhost", "root", "", "planes");

    if($con->connect_errno){
        die ("Error en la conexión: ".$con->connect_errno." ".$con->connect_error);

    }
    /*$sql= "SELECT `EM`.`razon_social`, `PL`.`nombre_plan`, `PL`.`precio`, `SV`.`tipo_servicio`, `PQ`.`descripcion`, `PQ`.`caracteristica` FROM `paquete` `PQ` 
    INNER JOIN `plan` `PL` ON `PL`.`id_plan`=`PQ`.`id_plan`
    INNER JOIN `servicio` `SV` ON `SV`.`id_servicio`=`PQ`.`id_servicio`
    INNER JOIN `empresa` `EM` ON `EM`.`id_empresa` = `PL`.`id_empresa`;";
    

    $valores = $con->query($sql);*/


    //mysqli_close($con);
?>