                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo empty($user->id) ? 'Add a new Admin' : 'Edit Admin ' . $user->name; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>
                                    <div class="box-body">
                                        <label for="exampleInputFile"> Admin picture <span style="color:red">allowed type jpg,png </span></label><br>
                                        <div class="hpgerpho">
                                            <div class="form-group btn btn-primary btn-file" >
                                                <br><img id="wst_bc_2ca" src="<?php echo $this->config->item('base_url2'),'img/',$user->img; ?>" style='width:200px'><br><br>
                                                <input type="file" id="exampleInputFile " name="img" onchange="loadFile_lca(event)">
                                                <div>Change Picture</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Admin username</label>
                                            <?php echo form_input(array('name' => 'name', 'value'=> set_value('name', $user->name), 'class' => 'form-control' )); ?>
                                        </div>
                                        <!-- <?php if($user_group->admins == 1) { ?>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Admin type</label>
                                                <?php echo form_dropdown('admin', $alladmins, set_value('admin', $user->admin), 'class="form-control"'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Branch</label>
                                                <?php echo form_dropdown('branch', $allbranches, set_value('branch', $user->branch), 'class="form-control"'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">User group</label>
                                                <?php echo form_dropdown('users_groups', $users_groups, set_value('users_groups', $user->users_groups), 'class="form-control"'); ?>
                                            </div>
                                        <?php } ?> -->
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Branch</label>
                                            <?php echo form_dropdown('branch', $allbranches, set_value('branch', $user->branch), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">User group</label>
                                            <?php echo form_dropdown('users_groups', $users_groups, set_value('users_groups', $user->users_groups), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <?php echo form_input(array('name' => 'email', 'value'=> set_value('email', $user->email), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <?php echo form_input(array('name' => 'password', 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Repet Password</label>
                                            <?php echo form_input(array('name' => 'password_confirm', 'class' => 'form-control' )); ?>
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
