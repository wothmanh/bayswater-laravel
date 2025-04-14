
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Notes </h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Note</th>
                                            <th>Client</th>
                                            <th>Added by</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                        <?php if(count($notes)): foreach($notes as $key): ?>
                                        <tr>
                                            <td> <?php echo anchor('notes/note/'. $key->id, short_text($key->note, 30, 60)); ?> </td>
                                            <td><?php echo anchor('clients/single/'. $key->client_id, $this->clients_m->id_to_field($key->client_id, 'first_name').' '.$this->clients_m->id_to_field($key->client_id, 'last_name') ); ?></td>
                                            <td><?php echo $this->user_m->id_to_name($key->made_by)->name; ?></td>
                                            <td><?php echo $key->at; ?></td>
                                            <td>
                                                <?php echo anchor('notes/edit/'.$key->client_id.'/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad"><i class="fa fa-pencil"></i></button>'); ?>
                                                <?php echo anchor('notes/deleten/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad"><i class="fa fa-trash-o"></i></button>'); ?>
                                            </td>
                                        </tr>                                        
										<?php endforeach; ?>
										<?php else: ?>
												<tr>
													<td colspan="3">We could not find any notes.</td>
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
