<?php
global $site;

$pageActive = ".../modules/{$site->module}/{$site->section}.php";
?>


<h1 class="display-1 text-center">400 </h1>
<h1 class="text-center"> Bad application</h1>
<p class="lead text-center">
	La URL o el Route no estan configurados
	<br>
	Puede <a href="javascript:history.back()">volver</a> a la página anterior, 
	<br>o volver a la <a href="index.html">pagina principal.</a>.
	<br><?php echo $pageActive; ?>
</p>