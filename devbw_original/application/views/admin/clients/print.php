



                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header dfsjdd4">
                                    <h3 class="box-title" style="margin-right:50px;">Print clients</h3>
                                    <div class="box-tools">
                                        <span style="float:right">
                                            <button class="btnsmall12 btn btn-primary" id="print_clntall"> <i class="fa fa-print"></i> Print list </button>
                                            <button class="btnsmall12 btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="fa fa-envelope"></i> Send list </button>
                                        </span>
                                    </div>
                                </div><!-- /.box-header -->

                                <div class="box-tools" style="background:#ddd;padding:10px">
                                        <div class="box-footer srchds5">
                                            <form  method="get" name="erprntfrm" id="qsdfezgger"> 



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send clients list</h4>
      </div>
      <div class="modal-body" id="msgssldfsd">
            <div class="form-group">
                <label for="exampleInputEmail1">Send list to :</label>
                <input type="email" name="toemail" value="" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">List title</label>
                <input type="text" name="subject" value="" placeholder="Title" class="form-control">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  id="send_clntall">Send list</button>
      </div>
    </div>
  </div>
</div>












                                            <?php
                                            $erbranch=$eruser=$erregistered_type=$eractive=$ercountry=$ercity=$erschool='';
                                            $erc_start= 'Start';$erc_ends='End';
                                            if (isset($_GET['branch']) && $_GET['branch'] != '') $erbranch = $_GET['branch'];
                                            if (isset($_GET['usrs']) && $_GET['usrs'] != '') $eruser = $_GET['usrs'];
                                            if (isset($_GET['registered_type']) && $_GET['registered_type'] != '') $erregistered_type = $_GET['registered_type'];
                                            if (isset($_GET['active']) && $_GET['active'] != '') $eractive = $_GET['active'];
                                            if (isset($_GET['country']) && $_GET['country'] != '') $ercountry = $_GET['country'];
                                            if (isset($_GET['city']) && $_GET['city'] != '') $ercity = $_GET['city'];
                                            if (isset($_GET['school']) && $_GET['school'] != '') $erschool = $_GET['school'];
                                            if (isset($_GET['c_start']) && $_GET['c_start'] != '') $erc_start = $_GET['c_start'];
                                            if (isset($_GET['c_ends']) && $_GET['c_ends'] != '') $erc_ends = $_GET['c_ends'];
                                                if ($this->session->userdata('admin') == 1 ) {
                                                    echo form_dropdown('branch', $allbranches, set_value('branch', $erbranch ), 'class="form-control usrs_clnt_phhldr" ');
                                                }  
                                                if ($this->session->userdata('admin') == 1 || $this->session->userdata('admin') == 2 ) {
                                                    echo form_dropdown('usrs', $users_all, set_value('usrs', $eruser), 'class="form-control usrs_clnt_phhldr" ');
                                                }  
                                                echo form_dropdown('registered_type', $registered_type, set_value('registered_type', $erregistered_type), 'class="form-control usrs_clnt_phhldr" style="width:150px" '); 
                                                echo form_dropdown('active', $status, set_value('active', $eractive), 'class="form-control usrs_clnt_phhldr" style="width:150px" '); 
                                                echo form_dropdown('country', $countries_all, set_value('country', $ercountry), 'class="form-control usrs_clnt_phhldr" style="width:150px" '); 
                                                echo form_dropdown('city', $cities_all, set_value('city', $ercity), 'class="form-control usrs_clnt_phhldr" style="width:150px" '); 
                                                echo form_dropdown('school', $centers_all, set_value('school', $erschool), 'class="form-control usrs_clnt_phhldr" style="width:150px" '); 
                                                echo form_input(array('name' => 'c_start', 'value'=> set_value('c_start', $erc_start)  , 'class' => 'form-control usrs_clnt_phhldr','id' => 'nrmdatepicker', 'data-date-format' => 'yyyy-mm-dd' )); 
                                                echo form_input(array('name' => 'c_ends', 'value'=> set_value('c_ends', $erc_ends)  , 'class' => 'form-control usrs_clnt_phhldr','id' => 'nrmdatepicker2', 'data-date-format' => 'yyyy-mm-dd'));  ?>
                                                <div class="clear"></div>
                                                </div>
                                                <div class="box-footer" style="padding-top:0px">
                                                    <button type="submit" class="btn btn-primary" name="search_query">Submit</button>
                                                </div> 
                                            </form>
                                        <div class="clear"></div>
                                </div>




                                <div class="box-body table-responsive no-padding" id="prntcallby">
                                    <div id="wbstlogo">
                                        <img id="wbstlogoimg" src="<?php echo $this->config->item('base_url2'),'img/',$settings->logo; ?>">
                                    </div>
                                    <table class="table table-hover" id="clients_table">
                                        <tr>
                                            <th>File num.</th>
                                            <th>Full name</th>
                                            <th>Country</th>
                                            <th>Registred by</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>State</th>
                                        </tr>
                                        <?php if(count($clients)): foreach($clients as $key): ?>
                                        <tr>
                                            <td><?php echo $key->file_num; ?></td>
                                            <td><?php echo $key->first_name.' '.$key->last_name; ?> </td>
                                            <td><?php if($key->country) echo $this->libre->country($key->country); ?></td>
                                            <td><?php echo $this->user_m->id_to_name($key->made_by)->name; ?></td>
                                            <td><?php echo date('Y/m/d', $key->timestamp); ?></td>
                                            <td><?php if ($key->registered_type != '') echo $registered_type[$key->registered_type]; ?></td>
                                            <td><?php if ($key->active != '') echo $status[$key->active]; ?> </td>
                                        </tr>                                        
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                                <tr>
                                                    <td colspan="3">We could not find any clients.</td>
                                                </tr>
                                        <?php endif; ?> 
                                    </table>
                                    <div id="pagination">
                                        <ul class="tsc_pagination">
                                        <?php 
                                            foreach ($links as $link) {
                                                echo "<li>". $link."</li>";
                                            } ?>
                                        </ul>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
