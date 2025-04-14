                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo empty($airports->id) ? 'Add a new airport' : 'Edit airport ' . $airports->name; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <?php echo form_input(array('name' => 'name', 'value'=> set_value('name', $airports->name), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">School</label>
                                            <?php 
                                            echo form_dropdown('school_id', $schools_all, set_value('school_id', $airports->school_id), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Arrival price</label>
                                            <?php echo form_input(array('name' => 'arrival_price', 'value'=> set_value('arrival_price', $airports->arrival_price), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Departure price</label>
                                            <?php echo form_input(array('name' => 'departure_price', 'value'=> set_value('departure_price', $airports->departure_price), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Statu</label>
                                            <?php echo form_dropdown('active', $status, set_value('active', $airports->active), 'class="form-control"'); ?>
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
