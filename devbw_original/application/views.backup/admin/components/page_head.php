<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $settings->websiteName; ?></title>
	<!-- Bootstrap -->
	<link href="<?php echo $this->config->item('base_url2');?>css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('base_url2');?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('base_url2');?>css/admin.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('base_url2');?>css/er_admin.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->config->item('base_url2');?>css/datepicker.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->config->item('base_url2');?>css/pagination.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->config->item('base_url2');?>css/timepicker.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->config->item('base_url2');?>css/jquery.ui.autocomplete.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo $this->config->item('base_url2');?>js/jquery.min.js"></script>
	<script src="<?php echo $this->config->item('base_url2');?>js/jquery.ui.autocomplete.min.js"></script>
	<script type="text/javascript">  
        var base_url = "<?php echo site_url(); ?>"; 
        var base_url2 = "<?php echo $this->config->item('base_url2'); ?>"; 
    </script>
	<script src="<?php echo $this->config->item('base_url2');?>js/bootstrap-datepicker.js"></script>
	<script src="<?php echo $this->config->item('base_url2');?>js/timepicker.js"></script>
	<script src="<?php echo $this->config->item('base_url2');?>js/mmt.js"></script>
	<script src="<?php echo $this->config->item('base_url2');?>js/date_p.js"></script>
	

	
</head>
