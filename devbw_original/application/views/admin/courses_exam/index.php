

                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All Courses Exam Preparation</h3>
                                    <div class="box-tools">
                                    	<?php echo anchor('courses_exam/edit', '<button class="btnsmall12 btn btn-primary plus_btn_icon"> Add New</button>', array('class' => 'link_add_new')); ?>
                                        <?php echo form_dropdown('usrs', $schools_all, set_value('usrs', $school_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_crsexm1(this);"'); ?>
                                        <?php echo form_dropdown('usrs', $cities_all, set_value('usrs', $city_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_crsexm2(this);" id="ctis_id"'); ?>
                                        <?php echo form_dropdown('usrs', $countries_all, set_value('usrs', $country_id), 'class="form-control usrs_clnt_drpdwn" onchange="filter_crsexm3(this);" id="cntrie_id2"'); ?>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Course</th>
                                            <th>School</th>
                                            <th>Prices</th>
                                            <th>Dates</th>
                                            <th>BY</th>
                                            <th>AT</th>
                                            <th>State</th>
                                            <th></th>
                                        </tr>
                                        <?php if(count($courses)): foreach($courses as $key): ?>
                                        <tr>
                                            <td>
                                                <?php echo $key->name; ?>
                                                <br /><span style="color: #aaa;"><?php //echo $key->notes; ?></span>
                                            </td>
                                            <td><?php echo $this->schools_m->id_to_name($key->school_id)->name; ?></td>
                                            <td>
                                                <?php echo anchor('courses_exam_prices/index/'.$key->id, 'Prices'); ?> 
                                            </td>
                                            <td><?php echo $key->start_dates; ?></td>
                                            <td><?php echo $this->user_m->id_to_name($key->created_by)->name; ?></td>
                                            <td>
                                                <?php echo date('Y-m-d', strtotime($key->created_at)); ?>
                                                <br />
                                                <?php echo date('H:i:s', strtotime($key->created_at)); ?>
                                            </td>
                                            <td><?php if ($key->active == 1) echo "Active"; else echo "Not active"; ?></td>
                                            <td>
                                                <?php echo anchor('Courses_Exam/edit/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad"><i class="fa fa-pencil"></i></button>'); ?>
                                                <?php echo anchor('Courses_Exam/delete/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad"><i class="fa fa-trash-o"></i></button>'); ?>
                                            </td>
                                        </tr>                                        
										<?php endforeach; ?>
										<?php else: ?>
												<tr>
													<td colspan="3">We could not find any courses exams.</td>
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
