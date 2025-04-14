


                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All schools</h3>
                                    <div class="box-tools">
                                    	<?php echo anchor('schools/edit', '<button class="btnsmall12 btn btn-primary plus_btn_icon"> Add school</button>', array('class' => 'link_add_new')); ?>
                                        <?php echo form_dropdown('usrs', $cities_all, set_value('usrs', $city_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_ctrs1(this);"'); ?>
                                        <?php echo form_dropdown('usrs', $countries_all, set_value('usrs', $country_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_cts2(this);" id="cntrie_id"'); ?>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>School</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>Added by</th>
                                            <th>Date</th>
                                            <th>State</th>
                                            <th></th>
                                        </tr>
                                        <?php if(count($schools)): foreach($schools as $key): ?>
                                        <tr>
                                            <td><?php echo $key->name; ?></td>
                                            <td><?php echo $this->cities_m->id_to_name($key->city_id)->name; ?></td>
                                            <td><?php echo $this->libre->country($this->countries_m->id_to_name($key->country_id)->name); ?></td>
                                            <td><?php echo $this->user_m->id_to_name($key->made_by)->name; ?></td>
                                            <td><?php echo $key->timestamp; ?></td>
                                            <td><?php if ($key->active == 1) echo "Active"; else echo "Not active"; ?></td>
                                            <td>
                                                <?php echo anchor('schools/edit/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad"><i class="fa fa-pencil"></i></button>'); ?>
                                                <?php echo anchor('schools/delete/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad"><i class="fa fa-trash-o"></i></button>'); ?>
                                            </td>
                                        </tr>                                        
										<?php endforeach; ?>
										<?php else: ?>
												<tr>
													<td colspan="3">We could not find any schools.</td>
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
