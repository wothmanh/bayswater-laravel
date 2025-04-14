

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">General Settings</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php  if ($this->session->flashdata('result') != ''): 
                                    echo $this->session->flashdata('result').'<br>'; 
                                endif; ?>
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart("settings/index"); ?>
                                    <div class="box-body">


                                        <label for="exampleInputFile">Company Logo</label><br>
                                        <div class="hpgerpho">
                                            <div class="form-group btn btn-primary btn-file lghld5" style="background:#fff;">
                                                <br><img id="wst_bc_2ca" src="<?php echo $this->config->item('base_url2'),'img/',$settings->logo; ?>" style='width:200px'><br><br>
                                                <input type="file" id="exampleInputFile " name="logo" onchange="loadFile_lca(event)">
                                                <div class="chnglgo2">Change Logo</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company Name</label>
                                            <?php echo form_input(array('name' => 'websiteName', 'value'=> set_value('websiteName', $settings->websiteName), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Footer showed in pdf ( Address , contacts numbers, ... )</label>
                                            <?php echo form_textarea(array('name' => 'pdf_footer', 'value'=> set_value('pdf_footer', $settings->pdf_footer), 'class' => 'form-control ermce' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title (showed in pdf)</label>
                                            <?php echo form_input(array('name' => 'pdf_title', 'value'=> set_value('pdf_title', $settings->pdf_title), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">website favicon</label>
                                            <br><img id="wst_bc_3" src="<?php echo $this->config->item('base_url2'),'img/',$settings->favicon; ?>" style='width:20px;margin:10px;margin-bottom:20px;'><br>
                                            <input type="file" id="exampleInputFile " name="favicon" onchange="loadFile_f(event)">
                                            <p class="help-block" style="color:red">alowed format ico,png dimontion (20x20)</p>
                                        </div>
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                <?php echo form_close(); ?>
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
