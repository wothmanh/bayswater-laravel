                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo empty($country->id) ? 'Add a new notification' : 'Edit notification : ' . $categorie->name; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <?php echo form_input(array('name' => 'title', 'value'=> set_value('title', $notifications->title), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Body</label>
                                            <?php echo form_textarea(array('name' => 'body', 'value'=> set_value('body', $notifications->body), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group" >
                                            <label for="exampleInputEmail1">Date</label>
                                            <div class="input-group">
                                                <?php echo form_input(array('name' => 'date', 'value'=> set_value('date', $notifications->date), 'onchange' => 'course_start_onchange(this)', 'class' => 'form-control','id' => 'nrmdatepicker', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Time</label>
                                            <div class="input-group bootstrap-timepicker timepicker">
                                            <?php echo form_input(array('name' => 'time', 'value'=> set_value('time', $notifications->time), 'class' => 'form-control','id' => 'timepicker1' )); ?>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Statu</label>
                                            <?php echo form_dropdown('active', $status, set_value('active', $notifications->active), 'class="form-control"'); ?>
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
