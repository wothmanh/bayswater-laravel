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
                                            <?php echo form_dropdown('region_id', $regions, set_value('region_id', $fixed_discount->region_id), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Note for Course Fixed Discount</label>
                                            <?php echo form_input(array('name' => 'text_course', 'value'=> set_value('text_course', $fixed_discount->text_course), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Fixed Discount</label>
                                            <?php echo form_input(array('name' => 'sum_course', 'value'=> set_value('sum_course', $fixed_discount->sum_course), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Note for Accoommodation Fixed Discount</label>
                                            <?php echo form_input(array('name' => 'text_accommo', 'value'=> set_value('text_accommo', $fixed_discount->text_accommo), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Accoommodation Fixed Discount</label>
                                            <?php echo form_input(array('name' => 'sum_accommo', 'value'=> set_value('sum_accommo', $fixed_discount->sum_accommo), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Statu</label>
                                            <?php echo form_dropdown('active', $status, set_value('active', $fixed_discount->active), 'class="form-control"'); ?>
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
