                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
          
                            <div class="col-xs-12  toppad" id="printclntdv">

                                <div id="wbstlogo">
                                    <img id="wbstlogoimg" src="<?php echo $this->config->item('base_url2'),'img/',$settings->logo; ?>">
                                </div>
                                      <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <span class="panel-title"><?php echo  $client->first_name.' '.$client->last_name; ?></span>
                                            <span class="printclnt">
                                                <button class="btnsmall12 btn btn-primary" id="print_clnt"> <i class="fa fa-print"></i> Print Result </button>
                                            </span>
                                        </div>
                                        <div class="panel-body">
                                          <div class="row">
                                            <div class="col-md-3 col-lg-3 clnt_img" align="center"> 
                                                <?php if ($client->img) { ?>
                                                    <img alt="Client Pic" src='<?php echo $this->config->item('base_url2')."uploads/".$client->img;?>' width="200" height="200" class="img-circle img-responsive"> 
                                                <?} ?>
                                            </div>
                                     
                                            <div class=" col-md-9 col-lg-9 clnt_tbl_info"> 
                                              <table class="table table-user-information">
                                                <tbody>
                                                    <tr>
                                                        <td>Registration date</td>
                                                        <td><?php echo date('Y/m/d', $client->timestamp); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Registred by</td>
                                                        <td><?php echo $this->user_m->id_to_name($client->made_by)->name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Registration ID</td>
                                                        <td><?php echo $client->id; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>File number</td>
                                                        <td><?php echo $client->file_num; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Full name</td>
                                                        <td><?php echo  $client->first_name.' '.$client->last_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td><a href="mailto:<?php echo $client->email; ?>"><?php echo $client->email; ?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone Number</td>
                                                        <td><?php echo $client->phone; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date of Birth</td>
                                                        <td><?php echo $client->birthday; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender</td>
                                                        <td><?php if ($client->gender == 0) echo "Male"; else echo "Female" ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td><?php if($client->country) echo $this->libre->country($client->country); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td><?php echo $client->city; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address</td>
                                                        <td><?php echo $client->address; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Post code</td>
                                                        <td><?php echo $client->post_code; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Heard about us</td>
                                                        <td><?php echo $client->heard_about_us; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Visa type</td>
                                                        <td><?php if ($client->visa_type != '') echo $visa_types[$client->visa_type]; ?></td>
                                                    </tr>
                                                    <?php if($client->passport != '') { ?>
                                                    <tr>
                                                        <td>Passport</td>
                                                        <td>
                                                            <p> <a href='<?php echo $this->config->item('base_url2')."uploads/".$client->passport;?>' download title='Download Passport'><i class='fa fa fa-download '></i> Download Passport</a></p>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    <?php if($client->certificates != '') { ?>
                                                    <tr>
                                                        <td>Certificates</td>
                                                        <td>
                                                            <p> <a href='<?php echo $this->config->item('base_url2')."uploads/".$client->certificates;?>' download title='Download Certificates'><i class='fa fa fa-download '></i> Download Certificates</a></p>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    <?php if($client->pdf_course != '') { ?>
                                                    <tr>
                                                        <td>Course</td>
                                                        <td>
                                                            <p> <a href='<?php echo $this->config->item('base_url2')."uploads/pdf/".$client->pdf_course;?>' download title='Download Course (pdf)'><i class='fa fa fa-download '></i> Download Course (pdf)</a></p>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td>Payments</td>
                                                        <td><?php echo $total_paid; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>State</td>
                                                        <td> <?php if ($client->active != '')  echo $status[$client->active]; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Registered from</td>
                                                        <td> <?php if ($client->registered_from) echo $registered_from[$client->registered_from]; ?> </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Registered type</td>
                                                        <td> <?php if ($client->registered_type)  echo $registered_type[$client->registered_type]; ?></td>
                                                    </tr>
                                                    
                                                    <?php foreach ($notes as $note) { ?>
                                                    <tr>
                                                        <td>Note </td>
                                                        <td>
                                                            <div class="clsddf">Date :  <?php echo $note->timestamp; ?></div>
                                                            <?php echo $note->note; ?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                        
                                                    
                                                 
                                                </tbody>
                                              </table>
                                            </div>
                                          </div>
                                        </div>            
                                      </div>
                                      <div id="wbstfooter">
                                          <?php echo $settings->pdf_footer; ?>
                                      </div>
                                    </div>

                        </div>
                    </div>
                </section><!-- /.content -->
