<?php 
    function agregarUsuario($nombre, $telefono, $correo, $indice="none"){
        include PROJECT_ROOT_PATH."/includes/funciones/db_conexion.php";
        
        try{
            if($indice=="none"){
                $stmt=$con->prepare("INSERT INTO usuario(nombre, telefono, correo) VALUES(?,?,?)");//Se preparamos
                $stmt->bind_param("sss", $nombre, $telefono, $correo);
                $stmt->execute();

                $stmt->close();
                $con->close();
            }
        }catch(Exception $e){
            echo "Existió un error: ".$e;
        }
    }

    function buscarCliente($nombre, $telefono, $correo){
        include PROJECT_ROOT_PATH."/includes/funciones/db_conexion.php";
        
        try{
            $sql= "SELECT id_usuario, nombre, telefono, correo FROM usuario WHERE nombre =\"".$nombre."\""." AND telefono= \"".$telefono."\""." AND correo=\"".$correo."\"";
            $resultado= $con->query($sql);
            if($cliente= $resultado->fetch_assoc()){
                $con->close();
                return $cliente["id_usuario"];
            }else{
                $con->close();
                return "none";
            }
        }catch(Exception $e){
            echo "Existió un error: ".$e;
        }

    
    }
    
    function agregarPeticion($idUsuario, $plan){
        include PROJECT_ROOT_PATH."/includes/funciones/db_conexion.php";
        
        try{
            $fecha= date('Y-m-d H:i:s');
            $stmt=$con->prepare("INSERT INTO solicitud(id_usuario, id_plan, valor_mercado, fecha) VALUES(?,?,?,?)");//Se preparamos
            $stmt->bind_param("iids", 
            $idUsuario, 
            $plan["id_plan"], 
            $plan["precio"], 
            $fecha);
            
            $stmt->execute();
            $stmt->close();
            $con->close();

        }catch(Exception $e){
            echo "Existió un error: ".$e;
        }

    }

    function agregarSolicitud($nombre, $telefono, $correo, $plan){
       //buscar cliente

        $resultado=buscarCliente($nombre, $telefono, $correo);
        
        agregarUsuario($nombre, $telefono, $correo, $resultado);

        if($resultado=="none"){
            $resultado=buscarCliente($nombre, $telefono, $correo);
        }

        agregarPeticion($resultado, $plan);

    }
?>