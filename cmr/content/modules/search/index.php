<?php
	global $session;
	global $site;
	
	$searchQuery = '';
	if(isset($site->fields['q']))
	{
		$searchQuery = "{$site->fields['q']}";
	}
?>
<div class="container">
	<div class="row">
	    <div class="col-12"><h2>¿Que estas buscando?</h2></div>
	    <div class="col-12">
			<form action="/search" method="SEARCH">
				<div id="custom-search-input">
					<div class="input-group">
						<input name="q" type="text" class="search-query form-control" placeholder="Buscar..." />
						<span class="input-group-btn">
							<button type="button" type="submit">
								<span class="fa fa-search"></span>
							</button>
						</span>
					</div>
				</div>
			</form>
        </div>
	    <div class="col-12">
			<?php 
				if($searchQuery !== '')
				{
					echo "Estas buscando: {$searchQuery} ";
				}
				else
				{
					echo "Escribe tu busqueda y pulsa Enter.";
				}
			?>
        </div>
	</div>
</div>


<style>
.container{
	margin-top: calc(25vh);
    padding: calc(-10vh);
    text-align: center;
}
#custom-search-input {
    margin:0;
    margin-top: 10px;
    padding: 0;
}
 
#custom-search-input .search-query {
    width:100%;
    padding-right: 3px;
    padding-left: 15px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
    margin-bottom: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 0;
}
 
#custom-search-input button {
    border: 0;
    background: none;
    /** belows styles are working good */
    padding: 2px 5px;
    margin-top: 2px;
    position: absolute;
    right:0;
    /* IE7-8 doesn't have border-radius, so don't indent the padding */
    margin-bottom: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    color:#D9230F;
    cursor: unset;
    z-index: 2;
}
 
.search-query:focus{
    z-index: 0;   
}

</style>