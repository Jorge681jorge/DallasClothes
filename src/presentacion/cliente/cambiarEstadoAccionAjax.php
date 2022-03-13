<?php
$idCliente = $_GET["idCliente"];
$nuevoEstado = $_GET["nuevoEstado"];

echo "<a id='cambiarEstado" . $idCliente . "' href='#' >" . (($nuevoEstado==1)?"<span class='fas fa-user-times' data-toggle='tooltip' data-placement='left' title='Deshabilitar'></span>":"<span class='fas fa-user-check' data-toggle='tooltip' data-placement='left' title='Habilitar'></span>") . "</a>";
?>

<script>
$(document).ready(function(){
	$("#cambiarEstado<?php echo $idCliente ?>").click(function(e){
		$('[data-toggle="tooltip"]').tooltip('hide');
		var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/cliente/cambiarEstadoClienteAjax.php") ?>&idCliente=<?php echo $idCliente ?>&nuevoEstado=<?php echo (($nuevoEstado==1)?"0":"1")?>";		
		$("#icono<?php echo $idCliente ?>").load(url);
		var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/cliente/cambiarEstadoAccionAjax.php") ?>&idCliente=<?php echo $idCliente ?>&nuevoEstado=<?php echo (($nuevoEstado==1)?"0":"1")?>";
		$("#accion<?php echo $idCliente ?>").load(url);
	});		
});
</script>
