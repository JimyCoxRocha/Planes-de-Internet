//JQuery
$(function(){
    
    //variables
    let contador=0;

    //Escogiendo elementos del DOM
    let elemento= $(".plan");
    let detalle= $(".detalle");

    //Operaciones
    elemento.hover(function(){
        $(this).css("cursor","pointer");
    });

    $("article").on("click",".plan",function(){

        //$(this).children("div.detalle").show();

        console.log($(this).children("div.detalle").is(':visible'));

        if ($(this).children("div.detalle").is(':visible')) {//Comprueba si todo está visible
            $(this).children("div.detalle").slideUp();
        } else {
            $(this).children("div.detalle").slideDown();
        }

    });
    
});
    //Validar que solo se ingrese letras
    function soloLetras(e){
        key=e.keyCode || e.which;
        letra= String.fromCharCode(key).toLowerCase();
        letras= " abcdefghijklmnñopqrstuvwxyzáéíóú";
        especiales= "8-37-38-46-164";
        teclado_especial= false;
        
        for(var i in especiales){
            if(key == especiales[i]){
                teclado_especial=true;
                break;
            }
        }
        if(!teclado_especial && letras.indexOf(letra)==-1){
            return false;
        }
    }
$(function(){
    let contador=0;

    //Escogiendo elementos del DOM Formulario
    let formulario = $("form input");

    
    /**************************Validación de formularios*********************************/
    //Nombre completo - Validación
    let validarNombre= function(e){
        let nuevoTexto= $.trim($(formulario[0]).val());
        if(nuevoTexto=="" || nuevoTexto.indexOf(" ")==-1){
            if($($("#nombre p")).length==0){
                $(formulario[0]).after('<p class="error">* Debe ingresar un nombre y un apellido.</p>');
            }
            e.preventDefault();
        }else{
            contador++;
            if($($("#nombre p")).length>0){
                $($("#nombre p")).remove();
            }
        } 
    }

    //Correo completo - Validación
    let validarCorreo= function(e){
        nuevoTexto= $.trim($(formulario[2]).val());
        if(nuevoTexto=="" || (nuevoTexto.indexOf(".com")==-1 || nuevoTexto.indexOf("@")==-1)){
            if($($("#correo p")).length==0){
                $(formulario[2]).after('<p class="error">* Correo no válido.</p>');
            }
            e.preventDefault();
        }else{
            contador++;
            if($($("#correo p")).length>0){
                $($("#correo p")).remove();
            } 
        }
    }

    //Telefono completo - Validación
    let validarTelefono= function(e){
        nuevoTexto= $.trim($(formulario[1]).val());
        if(nuevoTexto=="" || nuevoTexto.slice(0,2)!="09" || nuevoTexto.length!=10){
            if($($("#telefono p")).length==0){
                $(formulario[1]).after('<p class="error">* Ingrese correctametne su teléfono celular.</p>');
            }
            e.preventDefault();
        }else{
            contador++;
            if($($("#telefono p")).length>0){
                $($("#telefono p")).remove();
            } 
        }
    }

    $(formulario.get(3)).off('click').on('click',function(e){
        contador=0;
        validarNombre(e);
        validarCorreo(e);
        validarTelefono(e);
        
    });

    $("#solicitar").show();
    $("#mostrar-resultado").hide();

    
    $("form #submit").click(function(){
        if(contador==3){
            $("#solicitar").hide();
            $("#mostrar-resultado").show();
        } 
    });
    
});