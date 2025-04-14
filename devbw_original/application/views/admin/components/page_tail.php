	<script src="<?php echo $this->config->item('base_url2');?>js/jQuery.print.js"></script>
	<script src="<?php echo $this->config->item('base_url2');?>js/bootstrap.min.js"></script>
	<script src="<?php echo $this->config->item('base_url2');?>js/bootbox.min.js"></script>
	<script src="<?php echo $this->config->item('base_url2');?>js/tinymce/tinymce.min.js"></script>
	<script src="<?php echo $this->config->item('base_url2');?>js/html2canvas.js"></script>
	<script src="<?php echo $this->config->item('base_url2');?>js/jquery.plugin.html2canvas.js"></script>
    <script src="<?php echo $this->config->item('base_url2');?>js/er_admin.js" type="text/javascript"></script>
	<script src="<?php echo $this->config->item('base_url2');?>js/er.js"></script>
	
	
	<?php if(isset($sortable) && $sortable === TRUE): ?>
	<script src="<?php echo $this->config->item('base_url2');?>js/jquery-ui-1.9.1.custom.min.js"></script>
	<?php endif; ?>
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

</body>
</html>