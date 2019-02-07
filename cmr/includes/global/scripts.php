
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo path_home; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo path_home; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	  
<!-- Core plugin JavaScript-->
<script src="<?php echo path_home; ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="<?php echo path_home; ?>vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo path_home; ?>vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo path_home; ?>vendor/datatables/dataTables.bootstrap4.js"></script>

<?php
$site = new Route();
$routes = $site->getRoutes();
#echo json_encode($routes);

$pageActiveScripts = "cmr/content/modules/{$site->module}/scripts/{$site->section}.php";
if(file_exists($pageActiveScripts)){
	include($pageActiveScripts);
}else{
	include("Scripts no encontrados");
}
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>


<script src="<?php echo path_home; ?>js/TweenMax.min.js"></script>
<script src="<?php echo path_home; ?>js/notify.min.js"></script>


<script>
</script>