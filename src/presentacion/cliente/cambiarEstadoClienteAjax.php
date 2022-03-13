<?php
$cliente = new Cliente($_GET["idCliente"], "", "", "", "", "", $_GET["nuevoEstado"]);
$cliente -> cambiarEstado();
echo ($_GET["nuevoEstado"]==1)?"<div id='icono" . $_GET["idCliente"] . "'><span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'></span></div>":"<div id='icono" . $_GET["idCliente"] . "'><span class='fas fa-times-circle' data-toggle='tooltip' data-placement='left' title='Deshabilitado'></span></div>";
?>
