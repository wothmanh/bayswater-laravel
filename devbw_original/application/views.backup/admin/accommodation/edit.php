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
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Guardianship fee</label>
                                            <?php echo form_dropdown('guardianship_on', $guardianship_ons, set_value('guardianship_on', $accommodation->guardianship_on), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Christmas fee</label>
                                            <?php echo form_dropdown('christmas_on', $christmas_ons, set_value('christmas_on', $accommodation->christmas_on), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Summer Supplement  </label>
                                            <?php echo form_input(array('name' => 'a_summer_fees', 'value'=> set_value('a_summer_fees', $accommodation->a_summer_fees), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group" >
                                            <label for="exampleInputEmail1">Summer Supplement date start</label>
                                            <div class="input-group">
                                                <?php echo form_input(array('name' => 'a_smr_s_dt_start', 'value'=> set_value('a_smr_s_dt_start', $accommodation->a_smr_s_dt_start), 'class' => 'form-control','id' => 'datepicker-autoclose2', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group" >
                                            <label for="exampleInputEmail1">Summer Supplement date ends</label>
                                            <div class="input-group">
                                                <?php echo form_input(array('name' => 'a_smr_s_dt_ends', 'value'=> set_value('a_smr_s_dt_ends', $accommodation->a_smr_s_dt_ends), 'class' => 'form-control','id' => 'datepicker-autoclose', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Summer Supplement note</label>
                                            <?php echo form_input(array('name' => 'a_smr_s_note', 'value'=> set_value('a_smr_s_note', $accommodation->a_smr_s_note), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Statu</label>
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
