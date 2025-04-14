


                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All airports</h3>
                                    <div class="box-tools">
                                    	<?php echo anchor('airports/edit', '<button class="btnsmall12 btn btn-primary plus_btn_icon"> Add airport</button>', array('class' => 'link_add_new')); ?>
                                        <?php echo form_dropdown('usrs', $schools_all, set_value('usrs', $school_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_airp2(this);"'); ?>
                                        <?php echo form_dropdown('usrs', $cities_all, set_value('usrs', $city_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_airp3(this);" id="ctis_id1"'); ?>
                                        <?php echo form_dropdown('usrs', $countries_all, set_value('usrs', $country_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_airp4(this);" id="cntrie_id3"'); ?>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>airports</th>
                                            <th>School</th>
                                            <th>Added by</th>
                                            <th>Date</th>
                                            <th>State</th>
                                            <th></th>
                                        </tr>
                                        <?php if(count($airports)): foreach($airports as $key): ?>
                                        <tr>
                                            <td><?php echo $key->name; ?></td>
                                            <td><?php echo $this->schools_m->id_to_name($key->school_id)->name; ?></td>
                                            <td><?php echo $this->user_m->id_to_name($key->made_by)->name; ?></td>
                                            <td><?php echo $key->timestamp; ?></td>
                                            <td><?php if ($key->active == 1) echo "Active"; else echo "Not active"; ?></td>
                                            <td>
                                                <?php echo anchor('airports/edit/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad"><i class="fa fa-pencil"></i></button>'); ?>
                                                <?php echo anchor('airports/delete/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad"><i class="fa fa-trash-o"></i></button>'); ?>
                                            </td>
                                        </tr>                                        
										<?php endforeach; ?>
										<?php else: ?>
												<tr>
													<td colspan="3">We could not find any airports.</td>
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
