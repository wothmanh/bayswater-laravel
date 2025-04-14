


                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All groups</h3>
                                    <div class="box-tools">
                                    	<?php echo anchor('user/edit_group', '<button class="btnsmall12 btn btn-primary plus_btn_icon"> Add new group</button>', array('class' => 'link_add_new')); ?>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>ID</th>
                                            <th>Group name</th>
                                            <th>Description</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        <?php if(count($users_groups)): foreach($users_groups as $key): ?>
                                        <tr>
                                            <td><?php echo $key->id; ?></td>
                                            <td><?php echo $key->name; ?></td>
                                            <td><?php echo $key->description; ?></td>
                                            <td><?php echo anchor('user/edit_group/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad">Edit</button>'); ?></td>
                                            <td><?php echo anchor('user/delete_group/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad">Delete</button>'); ?></td>
                                        </tr>                                        
										<?php endforeach; ?>
										<?php else: ?>
												<tr>
													<td colspan="3">We could not find any groups.</td>
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
