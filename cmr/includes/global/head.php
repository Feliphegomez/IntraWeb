<?php
	global $site;
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="<?php echo pageDescription; ?>">
<meta name="author" content="FelipheGomez">
<title><?php echo "{$site->page_tite} - " . title_lg; ?></title>
<link href="<?php echo path_home; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="<?php echo path_home; ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link href="<?php echo path_home; ?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Vue And Axios -->
<script src="<?php echo path_home; ?>js/vue.js"></script>
<script src="<?php echo path_home; ?>js/vue-router.js"></script>
<script src="<?php echo path_home; ?>js/axios.js"></script>

<script>
	function formatMoneyGlobal(n, c, d, t) {
	  var c = isNaN(c = Math.abs(c)) ? 2 : c,
		d = d == undefined ? "." : d,
		t = t == undefined ? "," : t,
		s = n < 0 ? "-" : "",
		i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
		j = (j = i.length) > 3 ? j % 3 : 0;

	  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};
	/* ---------------------------------------------------------------------------------- */
	var apiIW = axios.create({
		baseURL: '/api',
	});
	
	var apiMV = apiIW;
	
	var aPiMap = axios.create({
		baseURL: 'https://nominatim.openstreetmap.org',
	});
</script>
<script src="//www.openlayers.org/api/OpenLayers.js"></script>