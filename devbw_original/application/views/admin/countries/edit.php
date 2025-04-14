                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo empty($country->id) ? 'Add a new country' : 'Edit country '; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">country Name</label>
                                            <?php $country_all = $this->libre->country(); 
                                            echo form_dropdown('name', $country_all, set_value('name', $country->name), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Statu</label>
                                            <?php echo form_dropdown('active', $status, set_value('active', $country->active), 'class="form-control"'); ?>
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
