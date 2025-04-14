                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Edit discount :</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Region</label>
                                            <?php echo form_dropdown('region_id', $regions, set_value('region_id', $other_discount->region_id), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Registration fees waved after week</label>
                                            <?php echo form_input(array('name' => 'registration_fee_off', 'value'=> set_value('registration_fee_off', $other_discount->registration_fee_off), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Accommodation fees waved after week</label>
                                            <?php echo form_input(array('name' => 'accommodation_fee_off', 'value'=> set_value('accommodation_fee_off', $other_discount->accommodation_fee_off), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Arrival fees waved after week</label>
                                            <?php echo form_input(array('name' => 'arrival_off', 'value'=> set_value('arrival_off', $other_discount->arrival_off), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Statu</label>
                                            <?php echo form_dropdown('active', $status, set_value('active', $other_discount->active), 'class="form-control"'); ?>
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
