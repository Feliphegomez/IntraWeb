
    <!-- js -->
    <script src="<?php echo path_homeClients; ?>js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    <!--  menu toggle -->
    <script src="<?php echo path_homeClients; ?>js/menu.js"></script>
    <!-- color switch -->
    <script src="<?php echo path_homeClients; ?>js/blast.min.js"></script>
    <!-- light box -->
    <script src="<?php echo path_homeClients; ?>js/lightbox-plus-jquery.min.js"></script>
    <!-- Scrolling Nav JavaScript -->
    <script src="<?php echo path_homeClients; ?>js/scrolling-nav.js"></script>
    <!-- start-smooth-scrolling -->
    <script src="<?php echo path_homeClients; ?>js/move-top.js"></script>
    <script src="<?php echo path_homeClients; ?>js/easing.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script>
        $(document).ready(function () {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="<?php echo path_homeClients; ?>js/SmoothScroll.min.js"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo path_homeClients; ?>js/bootstrap.js"></script>
	
	
	
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