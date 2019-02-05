

<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="contact">Contactarme</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<p for="msj">Se enviará este mensaje a la persona que desea contactar, indicando que te quieres comunicar con el. Para esto debes de ingresar tu información personal.</p>
				</div>
				<div class="form-group">
					<label for="txtFullname">Nombre completo</label>
					<input type="text" id="txtFullname" class="form-control">
				</div>
				<div class="form-group">
					<label for="txtEmail">Email</label>
					<input type="text" id="txtEmail" class="form-control">
				</div>
				<div class="form-group">
					<label for="txtPhone">Teléfono</label>
					<input type="text" id="txtPhone" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-success" (click)="openModal()" data-dismiss="modal">Enviar</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="avatarModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="contact">Nuevo Avatar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
					<div class="col-xs-12"> <!-- // col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 --> 
						<!-- image-preview-filename input [CUT FROM HERE]-->
						<div class="input-group image-preview">
							<input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
							<span class="input-group-btn">
								<!-- image-preview-clear button -->
								<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
									<span class="glyphicon glyphicon-remove"></span> Borrar
								</button>
								<!-- image-preview-input -->
								<div class="btn btn-default image-preview-input">
									<span class="glyphicon glyphicon-folder-open"></span>
									<span class="image-preview-input-title">Explorar..</span>
									<input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
								</div>
							</span>
						</div><!-- /input-group image-preview [TO HERE]--> 
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-success" (click)="openModal()" data-dismiss="modal">Cambiar</button>
			</div>
		</div>
	</div>
</div>
<style>
.image-preview-input {
    position: relative;
	overflow: hidden;
	margin: 0px;    
    color: #333;
    background-color: #fff;
    border-color: #ccc;    
}
.image-preview-input input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
</style>
<script>
$(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Vista Previa</strong>"+$(closebtn)[0].outerHTML,
        content: "Esto no es una imagen",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Explorar"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Cambiar");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});
</script>
