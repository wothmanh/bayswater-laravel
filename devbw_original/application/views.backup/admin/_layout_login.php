<?php $this->load->view('admin/components/page_head'); ?>


	<div class="modal show" role="dialog">
		
<?php $this->load->view($subview); // Subview is set in controller ?>

	</div>

<?php $this->load->view('admin/components/page_tail'); ?>