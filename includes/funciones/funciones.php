<?php
    function validarNombre($nombre, &$confirmarEnvio){
        $confirmarEnvio=0;
        if(empty($nombre)){
            echo  '<p class="error">* Debe ingresar su nombre correctamente</p>';
        }else{
            $confirmarEnvio++;
        }
    }
    function validarTel($telefono, &$confirmarEnvio){
        if(empty($telefono)){
            echo  '<p class="error">* Debe ingresar su número de teléfono</p>';
        }else{
            if(!is_numeric($telefono)){
                echo  '<p class="error">* Debe ingresar su número de teléfono</p>';
            }else{
                $confirmarEnvio++;
            }
        }  
    }
    function validarCorreo($correo, &$confirmarEnvio){
        if(empty($correo)){
            echo  '<p class="error">* Debe ingresar su correo correctamente</p>';
        }else{
            if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                echo  '<p class="error">* Debe ingresar su correo correctamente</p>';
            }else{
                $confirmarEnvio++;
            }
        }  
    }
?>