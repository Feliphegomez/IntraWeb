
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">×</span>
		</button>
	  </div>
	  <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
	  <div class="modal-footer">
		<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
		<a class="btn btn-primary" href="<?php echo path_home; ?>out">Cerrar sesión</a>
	  </div>
	</div>
  </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<img class="modal-content" id="recipient-src">
				<hr>
				<div id="myModalLabelCaption">URL de la Imagen </div>
				<a class="btn btn-sm btn-default" target="blank" id="myModalLabelURL"></a>
			</div>			
		</div>
	</div>  
</div>
