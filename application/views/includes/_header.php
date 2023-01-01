<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Store</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/dataTables.bootstrap.css'?>">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/font-awesome/css/font-awesome.min.css'?>">
	<!-- Custom css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/custom.css'?>">
	
	
	
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.dataTables.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/dataTables.bootstrap.js'?>"></script>
	<!-- Plugins js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
	<script type="text/javascript">
		jQuery.browser = {};
		(function () {
			jQuery.browser.msie = false;
			jQuery.browser.version = 0;
			if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
				jQuery.browser.msie = true;
				jQuery.browser.version = RegExp.$1;
			}
		})();
		
		var csfr_token_name = "<?php echo $this->security->get_csrf_token_name(); ?>";
		var csfr_cookie_name = "<?php echo $this->config->item('csrf_cookie_name'); ?>";
		var base_url = "<?php echo base_url(); ?>";
	</script>
</head>
<body class="hold-transition skin-blue">
<div class="container">