                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
          
                            <div class="col-xs-12  toppad" id="printclntdv">


                                      <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <span class="panel-title"><?php $clientname =  $this->clients_m->id_to_field($note->client_id, 'first_name').' '.$this->clients_m->id_to_field($note->client_id, 'last_name'); echo $clientname; ?></span>
                                         
                                        </div>
                                        <div class="panel-body">
                                          <div class="row">
                                     
                                            <div class=" col-md-9 col-lg-9 clnt_tbl_info"> 
                                              <table class="table table-user-information">
                                                <tbody>
                                                    <tr>
                                                        <td>Date</td>
                                                        <td><?php echo $note->at; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Made by</td>
                                                        <td><?php echo $this->user_m->id_to_name($note->made_by)->name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Client</td>
                                                        <td> <?php echo anchor('clients/single/'. $note->client_id, $clientname ); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Note</td>
                                                        <td><?php echo $note->note; ?></td>
                                                    </tr>                                                 
                                                </tbody>
                                              </table>
                                            </div>
                                          </div>
                                        </div>            
                                      </div>
                                      <div id="wbstfooter">
                                          <?php // echo $settings->description; ?>
                                      </div>
                                    </div>

                        </div>
                    </div>
                </section><!-- /.content -->
