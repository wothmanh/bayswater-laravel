                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo empty($user->id) ? 'Add a new group' : 'Edit group ' . $user->name; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Group username</label>
                                            <?php echo form_input(array('name' => 'name', 'value'=> set_value('name', $user->name), 'class' => 'form-control' )); ?>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Group description</label>
                                            <?php echo form_textarea(array('name' => 'description', 'value'=> set_value('description', $user->description), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">State</label>
                                            <?php echo form_dropdown('active', $state, set_value('active', $user->active), 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                    <div class="box-header">
                                        <h3 class="box-title"> Permissions : </h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit admins</label>
                                            <?php echo form_dropdown('admins', $permiss, set_value('admins', $user->admins), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit user's groups</label>
                                            <?php echo form_dropdown('users_groups', $permiss, set_value('users_groups', $user->users_groups), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit branches</label>
                                            <?php echo form_dropdown('branches', $permiss, set_value('branches', $user->branches), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit settings</label>
                                            <?php echo form_dropdown('settings', $permiss, set_value('settings', $user->settings), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit courses</label>
                                            <?php echo form_dropdown('courses', $permiss, set_value('courses', $user->courses), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit schools</label>
                                            <?php echo form_dropdown('schools', $permiss, set_value('schools', $user->schools), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit airports</label>
                                            <?php echo form_dropdown('airports', $permiss, set_value('airports', $user->airports), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit accommodation</label>
                                            <?php echo form_dropdown('accommodation', $permiss, set_value('accommodation', $user->accommodation), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit countries</label>
                                            <?php echo form_dropdown('countries', $permiss, set_value('countries', $user->countries), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit cities</label>
                                            <?php echo form_dropdown('cities', $permiss, set_value('cities', $user->cities), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit clients</label>
                                            <?php echo form_dropdown('clients', $permiss, set_value('clients', $user->clients), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Edit currency</label>
                                            <?php echo form_dropdown('currency', $permiss, set_value('currency', $user->currency), 'class="form-control"'); ?>
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
