<?php
	global $session,$site;

?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-users"></i>
		MODO DEBUG: 
	</div>
	<div class="card-body">
		<table>
			<?php 
				if(DEBUG_SESSION == true){
					?>
					<tr>
						<th>session</th>
					</tr>
					<tr>
						<td>
							<code><?php echo json_encode($session); ?></code>
						</td>
					</tr>
					<?php
				}
				if(DEBUG_SITE == true){ 
					?>
					<tr>
						<th>Site</th>
					</tr>
					<tr>
						<td>
							<code><?php echo json_encode($site); ?></code>
						</td>
					</tr>
					<?php
				}
			?>
		</table>
	</div>
</div>