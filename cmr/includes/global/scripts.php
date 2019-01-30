
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

<!-- Custom scripts for all pages-->
<script src="<?php echo path_home; ?>js/sb-admin.min.js"></script>

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