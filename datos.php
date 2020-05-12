<?php 
    echo '<h2 class="fw-300">Datos de Contacto</h3>
    <ul class="detalle plan-seleccion" style="display: block;">';

    echo '<li class="fw-bold">Nombre: <span class="fw-300">'. $_POST["nombre"] .'</span></li>';
    echo '<li class="fw-bold">Teléfono celular: <span class="fw-300">'. $_POST["telefono"] .'</span></li>';
    echo '<li class="fw-bold">Correo: <span class="fw-300">'. $_POST["correo"] .'</span></li>';

    echo '</ul>
    <p>Ahora nos contacteremos con la información otorgada para concretar el pedido señor <span class="fw-bold">'.$_POST["nombre"].'</span>.</p>';
?>