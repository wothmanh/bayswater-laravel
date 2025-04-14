<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $settings->websiteName; ?></title>
    <!-- Bootstrap -->
    <link href="<?php echo $this->config->item('base_url2');?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('base_url2');?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('base_url2');?>css/lgn.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">  
        var base_url = "<?php echo site_url(); ?>"; 
        var base_url2 = "<?php echo $this->config->item('base_url2'); ?>"; 
    </script>
    
</head>
<body class="login-screen">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="login-box">
                    <div class="login-content">
                        <img id="cnwst_bc_1c" src="<?php echo $this->config->item('base_url2'),'img/EOBW.jpg' ?>">

                    </div>
                    <div id="erdsplr">
                        <?php  if ($this->session->flashdata('error') != ''): 
                        echo $this->session->flashdata('error').'<br>'; 
                        endif; ?>
                        <?php echo validation_errors(); ?>
                    </div>
                    <div class="login-form">
                    

                <?php echo form_open('',array('class'=>'form-horizontal ls_form')); ?>
                      <div class="input-group ls-group-input">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" placeholder="Username" name="username">
                            </div>
                    
                    <div class="input-group ls-group-input">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" placeholder="Password" name="password" class="form-control" value="">
                            </div>
                            
                            <div class="input-group ls-group-input login-btn-box">
                            <input class="btn ls-dark-btn ladda-button col-md-12 col-sm-12 col-xs-12 lgn" type="submit" value="Login">
                            </div>
                
                <?php echo form_close(); ?>
</div>
                    
                    </div>

                </div>
            </div>
        </div>
    


                

</body>
</html>