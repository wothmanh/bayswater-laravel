                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo empty($accommodation->id) ? 'Add a new accommodation' : 'Edit accommodation ' . $accommodation->name; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Accommodation type</label>
                                            <?php 
                                            echo form_dropdown('type', $course_type, set_value('type', $accommodation->type), 'class="form-control" '); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <?php echo form_input(array('name' => 'name', 'value'=> set_value('name', $accommodation->name), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">School</label>
                                            <?php 
                                            echo form_dropdown('school_id', $schools_all, set_value('school_id', $accommodation->school_id), 'class="form-control"'); ?>
                                        </div>

                                        

                                        <div class="row">
                                                                                    
                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Guardianship fee</label>
                                                    <?php echo form_dropdown('guardianship_on', $guardianship_ons, set_value('guardianship_on', $accommodation->guardianship_on), 'class="form-control"'); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Christmas fee</label>
                                                    <?php echo form_dropdown('christmas_on', $christmas_ons, set_value('christmas_on', $accommodation->christmas_on), 'class="form-control"'); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Summer Supplement</label>
                                                    <?php echo form_input(array('name' => 'a_summer_fees', 'value'=> set_value('a_summer_fees', $accommodation->a_summer_fees), 'class' => 'form-control' )); ?>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                        
                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group" >
                                                    <label for="exampleInputEmail1">Summer Supplement date start</label>
                                                    <div class="input-group">
                                                        <?php echo form_input(array('name' => 'a_smr_s_dt_start', 'value'=> set_value('a_smr_s_dt_start', $accommodation->a_smr_s_dt_start), 'class' => 'form-control','id' => 'datepicker-autoclose2', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                        <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group" >
                                                    <label for="exampleInputEmail1">Summer Supplement date ends</label>
                                                    <div class="input-group">
                                                        <?php echo form_input(array('name' => 'a_smr_s_dt_ends', 'value'=> set_value('a_smr_s_dt_ends', $accommodation->a_smr_s_dt_ends), 'class' => 'form-control','id' => 'datepicker-autoclose', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                        <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Summer Supplement note</label>
                                            <?php echo form_input(array('name' => 'a_smr_s_note', 'value'=> set_value('a_smr_s_note', $accommodation->a_smr_s_note), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="row">
                                        
                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Promo Christmas</label>
                                                    <?php echo form_input(array('name' => 'promo_christmas', 'value'=> set_value('promo_christmas', $accommodation->promo_christmas), 'class' => 'form-control', 'type' => 'number' )); ?>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                <label for="exampleInputEmail1">Promo Price</label>
                                                    <?php echo form_input(array('name' => 'promo_price', 'value'=> set_value('promo_price', $accommodation->promo_price), 'class' => 'form-control', 'type' => 'number' )); ?>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Promo Min Weeks</label>
                                                    <?php echo form_input(array('name' => 'promo_minweeks', 'value'=> set_value('promo_minweeks', $accommodation->promo_minweeks), 'class' => 'form-control', 'type' => 'number' )); ?>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Use</label>
                                                    <?php echo form_dropdown('promo_combinable', $combinable_ons, set_value('promo_combinable', $accommodation->promo_combinable), 'class="form-control"'); ?>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Promo Stays Start date</label>
                                                    <?php echo form_input(array('name' => 'promo_staysstart', 'value'=> set_value('promo_staysstart', $accommodation->promo_staysstart), 'class' => 'form-control', 'type' => 'date' )); ?>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Promo Stays End date</label>
                                                    <?php echo form_input(array('name' => 'promo_staysend', 'value'=> set_value('promo_staysend', $accommodation->promo_staysend), 'class' => 'form-control', 'type' => 'date' )); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Promo Received before</label>
                                                    <?php echo form_input(array('name' => 'promo_receivedbefore', 'value'=> set_value('promo_receivedbefore', $accommodation->promo_receivedbefore), 'class' => 'form-control', 'type' => 'date' )); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File link</label>
                                                    <?php echo form_input(array('name' => 'file_link', 'value'=> set_value('file_link', $accommodation->file_link), 'class' => 'form-control', 'type' => 'url' )); ?>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">State</label>
                                            <?php echo form_dropdown('active', $status, set_value('active', $accommodation->active), 'class="form-control"'); ?>
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
