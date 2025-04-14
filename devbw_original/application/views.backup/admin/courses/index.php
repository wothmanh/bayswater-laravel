

                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All courses</h3>
                                    <div class="box-tools">
                                    	<?php echo anchor('courses/edit', '<button class="btnsmall12 btn btn-primary plus_btn_icon"> Add course</button>', array('class' => 'link_add_new')); ?>
                                        <?php echo form_dropdown('usrs', $schools_all, set_value('usrs', $school_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_schls1(this);"'); ?>
                                        <?php echo form_dropdown('usrs', $cities_all, set_value('usrs', $city_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_ctrs2(this);" id="ctis_id"'); ?>
                                        <?php echo form_dropdown('usrs', $countries_all, set_value('usrs', $country_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_cts3(this);" id="cntrie_id2"'); ?>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Course</th>
                                            <th>School</th>
                                            <th>Prices</th>
                                            <th>Course discount</th>
                                            <th>Fixed discounts</th>
                                            <th>Other discounts</th>
                                            <th>Added by</th>
                                            <th>Date</th>
                                            <th>State</th>
                                            <th></th>
                                        </tr>
                                        <?php if(count($courses)): foreach($courses as $key): ?>
                                        <tr>
                                            <td><?php echo $key->name; ?></td>
                                            <td><?php echo $this->schools_m->id_to_name($key->school_id)->name; ?></td>
                                            <td><?php if($key->type == 0) echo anchor('prices/index/'.$key->id, 'prices'); else echo anchor('prices/index_ac/'.$key->id, 'prices'); ?> </td>
                                            <td><?php if($key->type == 0) echo anchor('course_discount/index/'.$key->id, 'Course discount'); else echo anchor('course_discount/index_ac/'.$key->id, 'Course discount'); ?> </td>
                                            <td><?php echo anchor('fixed_discount/index/'.$key->id.'/'.$school_id, 'Fixed discounts'); ?> </td>
                                            <td><?php echo anchor('other_discount/index/'.$key->id, 'Other discount'); ?> </td>
                                            <td><?php echo $this->user_m->id_to_name($key->made_by)->name; ?></td>
                                            <td><?php echo $key->timestamp; ?></td>
                                            <td><?php if ($key->active == 1) echo "Active"; else echo "Not active"; ?></td>
                                            <td>
                                                <?php echo anchor('courses/edit/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad"><i class="fa fa-pencil"></i></button>'); ?>
                                                <?php echo anchor('courses/delete/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad"><i class="fa fa-trash-o"></i></button>'); ?>
                                            </td>
                                        </tr>                                        
										<?php endforeach; ?>
										<?php else: ?>
												<tr>
													<td colspan="3">We could not find any courses.</td>
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
