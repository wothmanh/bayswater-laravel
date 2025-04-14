                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo empty($prices->id) ? 'Add a new Price' : 'Edit Price '; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Duration (in week)</label>
                                            <?php echo form_input(array('name' => 'duration', 'value'=> set_value('duration', $prices->duration), 'class' => 'form-control', 'type' => 'number', 'min' => '1' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Price</label>
                                            <?php echo form_input(array('name' => 'price', 'value'=> set_value('price', $prices->price), 'class' => 'form-control', 'type' => 'number', 'min' => '0' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">State</label>
                                            <?php echo form_dropdown('active', $status, set_value('active', $prices->active), 'class="form-control"'); ?>
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
