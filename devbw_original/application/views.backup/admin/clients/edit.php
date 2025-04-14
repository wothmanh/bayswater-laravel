                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo empty($client->id) ? 'Add a new client' : 'Edit client : ' . $client->first_name.' '.$client->last_name ; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>
                                    <div class="box-body">

                                        <label for="exampleInputFile"> Client picture <span style="color:red">allowed type jpg,png </span></label><br>
                                        <div class="hpgerpho">
                                            <div class="form-group btn btn-primary btn-file" >
                                                <br><img id="wst_bc_2ca" src="<?php echo $this->config->item('base_url2'),'uploads/',$client->img; ?>" style='width:200px'><br><br>
                                                <input type="file" id="exampleInputFile " name="img" onchange="loadFile_lca(event)">
                                                <div>Change Picture</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">File number</label>
                                            <?php echo form_input(array('name' => 'file_num', 'value'=> set_value('file_num', $client->file_num), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First name</label>
                                            <?php echo form_input(array('name' => 'first_name', 'value'=> set_value('first_name', $client->first_name), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Last name</label>
                                            <?php echo form_input(array('name' => 'last_name', 'value'=> set_value('last_name', $client->last_name), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Gender</label>
                                            <?php echo form_dropdown('gender', $genders, set_value('gender', $client->gender), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Birthday</label>
                                            <div class="input-group">
                                                <?php echo form_input(array('name' => 'birthday', 'value'=> set_value('birthday', $client->birthday),  'class' => 'form-control','id' => 'nrmdatepicker', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <?php echo form_input(array('name' => 'email', 'value'=> set_value('email', $client->email), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address</label>
                                            <?php echo form_input(array('name' => 'address', 'value'=> set_value('address', $client->address), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">City</label>
                                            <?php echo form_input(array('name' => 'city', 'value'=> set_value('city', $client->city), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Country</label>
                                            <?php $country_all = $this->libre->country(); 
                                            echo form_dropdown('country', $country_all, set_value('country', $client->country), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone</label>
                                            <?php echo form_input(array('name' => 'phone', 'value'=> set_value('phone', $client->phone), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Where did you heard about us</label>
                                            <?php echo form_input(array('name' => 'heard_about_us', 'value'=> set_value('heard_about_us', $client->heard_about_us), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Visa type</label>
                                            <?php echo form_dropdown('visa_type', $visa_types, set_value('visa_type', $client->visa_type), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Passport</label>
                                            <?php if ($client->passport != "") { ?>
                                                <p> <a href='<?php echo $this->config->item('base_url2')."uploads/".$client->passport;?>' download title='Download Passport'><i class='fa fa fa-download '></i> Download Passport</a></p>
                                            <?php } ?>
                                            <input type="file" id="exampleInputFile " name="passport" >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Certificates</label>
                                            <?php if ($client->certificates != "") { ?>
                                            <p> <a href='<?php echo $this->config->item('base_url2')."uploads/".$client->certificates;?>' downloadtitle='Download Certificates'><i class='fa fa fa-download '></i> Download Certificates</a></p>
                                            <?php } ?>
                                            <input type="file" id="exampleInputFile " name="certificates">
                                            <p class="help-block" style="color:red">Put all your certificates in rar or zip file than upload it</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Post code</label>
                                            <?php echo form_input(array('name' => 'post_code', 'value'=> set_value('post_code', $client->post_code), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Course (pdf)</label>
                                            <?php if ($client->pdf_course != "") { ?>
                                            <p> <a href='<?php echo $this->config->item('base_url2')."uploads/pdf/".$client->pdf_course;?>' download title='Download course (pdf)'><i class='fa fa fa-download '></i> Download course (pdf)</a></p>
                                            <?php } ?>
                                            <input type="file" id="exampleInputFile " name="pdf_get_valclient">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course price</label>
                                            <?php echo form_input(array('name' => 'course_price', 'value'=> set_value('course_price', $client->course_price), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course start</label>
                                            <div class="input-group">
                                                <?php echo form_input(array('name' => 'c_start', 'value'=> set_value('c_start', $client->c_start), 'class' => 'form-control','id' => 'datepicker-autoclose', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Number of Weeks ( course )</label>
                                            <?php echo form_dropdown('c_couse_weeks', $weeks_all, set_value('c_couse_weeks', $client->c_couse_weeks), 'class="form-control" id="slc_couse_weeks" '); ?>                                        
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">State</label>
                                            <?php echo form_dropdown('active', $status, set_value('active', $client->active), 'class="form-control"'); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Registered from</label>
                                            <?php echo form_dropdown('registered_from', $registered_from, set_value('registered_from', $client->registered_from), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Registered type</label>
                                            <?php echo form_dropdown('registered_type', $registered_type, set_value('registered_type', $client->registered_type), 'class="form-control"'); ?>
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
