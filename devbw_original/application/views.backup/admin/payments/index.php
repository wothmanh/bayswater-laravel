
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><?php if ($client_id)
                                        echo $this->clients_m->id_to_field($client_id, 'first_name').' '.$this->clients_m->id_to_field($client_id, 'last_name');  ?> payments</h3>
                                    <div class="box-tools">
                                    	<?php if ($client_id)
                                         echo anchor('payments/edit/'.$client_id, '<button class="btnsmall12 btn btn-primary plus_btn_icon"> Add payment</button>', array('class' => 'link_add_new')); ?>
                                        <?php echo form_input(array('name' => 'price', 'value'=> set_value('price', $total_paid), 'class' => 'form-control usrs_clnt_drpdwn', 'disabled' => 'disabled' )); ?>
                                        <div class="ttlprc5"> Total : </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Payment</th>
                                            <th>Added by</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                        <?php if(count($payments)): foreach($payments as $key): ?>
                                        <tr>
                                            <td><?php echo $key->price.' '.$this->currency_m->id_to_field($key->currency_id, 'name'); ?></td>
                                            <td><?php echo $this->user_m->id_to_name($key->made_by)->name; ?></td>
                                            <td><?php echo $key->timestamp; ?></td>
                                            <td>
                                                <?php echo anchor('payments/edit/'.$client_id.'/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad"><i class="fa fa-pencil"></i></button>'); ?>
                                                <?php echo anchor('payments/delete/'.$client_id.'/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad"><i class="fa fa-trash-o"></i></button>'); ?>
                                            </td>
                                        </tr>                                        
										<?php endforeach; ?>
										<?php else: ?>
												<tr>
													<td colspan="3">We could not find any payments.</td>
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
