<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo path_home; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo path_home; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo path_home; ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="<?php echo path_home; ?>vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo path_home; ?>vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo path_home; ?>vendor/datatables/dataTables.bootstrap4.js"></script>


<!-- <script src="https://unpkg.com/popper.js@1.14.7/dist/umd/popper.js"></script> -->
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


<link href="<?php echo path_home; ?>cmr/includes/libs/select2/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo path_home; ?>cmr/includes/libs/select2/js/select2.min.js"></script>
<script>
// $(document).ready(function() { $('.search-select2-basic-single').select2(); });
</script>