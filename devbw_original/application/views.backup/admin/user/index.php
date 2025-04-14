


                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All Admins</h3>
                                    <div class="box-tools">
                                    	<?php echo anchor('user/edit', '<button class="btnsmall12 btn btn-primary plus_btn_icon"> Add new Admin</button>', array('class' => 'link_add_new')); ?>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Group</th>
                                            <th>Branch</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        <?php if(count($users)): foreach($users as $key): ?>
                                        <tr>
                                            <td><?php echo $key->id; ?></td>
                                            <td><?php echo anchor('user/edit/' . $key->id, $key->name); ?></td>
                                            <td><?php echo $users_groups[$key->users_groups]; ?></td>
                                            <td><?php echo $allbranches[$key->branch]; ?></td>
                                            <td><?php echo anchor('user/edit/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad">Edit</button>'); ?></td>
                                            <td><?php echo anchor('user/delete/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad">Delete</button>'); ?></td>
                                        </tr>                                        
										<?php endforeach; ?>
										<?php else: ?>
												<tr>
													<td colspan="3">We could not find any Admins.</td>
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
