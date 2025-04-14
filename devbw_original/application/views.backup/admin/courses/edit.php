                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo empty($courses->id) ? 'Add a new course' : 'Edit course ' . $courses->name; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <?php echo form_input(array('name' => 'name', 'value'=> set_value('name', $courses->name), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course type</label>
                                            <?php 
                                            echo form_dropdown('type', $course_type, set_value('type', $courses->type), 'class="form-control" onchange="centre_ondfsfchange(this);"'); ?>
                                        </div>
                                        <div class="form-group" id="strcrssd" <?php if ($courses->type != 1) { ?> style="display:none" <?php } ?>>
                                            <label for="exampleInputEmail1">Start <span style="color: red;margin-left: 20px;font-weight: normal;"> Very important dates <b> without spaces </b> Example : 20-5-2016,16-8-2016,26-10-2016  </span></label>
                                            <?php echo form_input(array('name' => 'start', 'value'=> set_value('start', $courses->start), 'class' => 'form-control','style' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">School</label>
                                            <?php 
                                            echo form_dropdown('school_id', $schools_all, set_value('school_id', $courses->school_id), 'class="form-control"'); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Statu</label>
                                            <?php echo form_dropdown('active', $status, set_value('active', $courses->active), 'class="form-control"'); ?>
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



<script type="text/javascript">

function centre_ondfsfchange(sel) { 

    if (sel.value == 1) {
        $('#strcrssd').show();
    } else {
        $('#strcrssd').hide();
    }

}

</script>