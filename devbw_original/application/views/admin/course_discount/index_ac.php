


                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Course discount</h3>
                                    <div class="box-tools">
                                    	<?php echo anchor('course_discount/edit_ac/'.$course_id, '<button class="btnsmall12 btn btn-primary plus_btn_icon"> Add discount</button>', array('class' => 'link_add_new')); ?>
                                        
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Weeks</th>
                                            <th>Discount (%)</th>
                                            <th>Region</th>
                                            <th>Added by</th>
                                            <th>Date</th>
                                            <th>State</th>
                                            <th></th>
                                        </tr>
                                        <?php if(count($course_discount)): foreach($course_discount as $key): ?>
                                        <tr>
                                            <td><?php echo $key->ends; ?></td>
                                            <td><?php echo $key->discount; ?>%</td>
                                            <td><?php echo $this->regions_m->id_to_name($key->region_id)->name; ?></td>
                                            <td><?php echo $this->user_m->id_to_name($key->made_by)->name; ?></td>
                                            <td><?php echo $key->timestamp; ?></td>
                                            <td><?php if ($key->active == 1) echo "Active"; else echo "Not active"; ?></td>
                                            <td>
                                                <?php echo anchor('course_discount/edit_ac/'.$course_id.'/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad"><i class="fa fa-pencil"></i></button>'); ?>
                                                <?php echo anchor('course_discount/delete_ac/'.$course_id.'/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad"><i class="fa fa-trash-o"></i></button>'); ?>
                                            </td>
                                        </tr>                                        
										<?php endforeach; ?>
										<?php else: ?>
												<tr>
													<td colspan="3">We could not find any discount.</td>
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
