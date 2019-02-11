<?php
	global $session,$site;

?>
<hr>
<div class="card mb-4">
	<div class="card-header">
		<i class="fas fa-users"></i>
		MODO DEBUG: 
	</div>
	<?php 
		echo "<div class=\"card-body\">";
			echo "<table>";
				if(DEBUG_SESSION == true){
					echo "<tr><th>session</th></tr>";
					echo "<tr><td><code>".json_encode($session)."</code></td></tr>";
				}
				if(DEBUG_SITE == true){
					echo "<tr><th>Site</th></tr>";
					echo "<tr><td><code>".json_encode($site)."</code></td></tr>";
				}
			echo "</table>";
		echo "</div>";
	?>
</div>