


                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">My notifications</h3>
                                    <div class="box-tools">
                                    	<?php echo anchor('notifications/edit', '<button class="btnsmall12 btn btn-primary plus_btn_icon"> Add notification</button>', array('class' => 'link_add_new')); ?>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>time</th>
                                            <th>State</th>
                                            <th></th>
                                        </tr>
                                        <?php if(count($notifications)): foreach($notifications as $key): ?>
                                        <tr>
                                            <td><?php echo short_text($key->title,15,50); ?> </td>
                                            <td><?php echo $key->date; ?></td>
                                            <td><?php echo $key->time; ?></td>
                                            <td><?php if ($key->active == 1) echo "Active"; else echo "Not active"; ?></td>
                                            <td>
                                                <?php echo anchor('notifications/edit/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad"><i class="fa fa-pencil"></i></button>'); ?>
                                                <?php echo anchor('notifications/delete/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad"><i class="fa fa-trash-o"></i></button>'); ?>
                                            </td>
                                        </tr>                                        
										<?php endforeach; ?>
										<?php else: ?>
												<tr>
													<td colspan="3">We could not find any notifications.</td>
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
