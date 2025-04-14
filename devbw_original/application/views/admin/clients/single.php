


                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header dfsjdd4">
                                    <h3 class="box-title" style="margin-right:10px;"> Clients </h3>
                                </div><!-- /.box-header -->


                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover" id="clients_table">
                                        <tr>
                                            <th>File num.</th>
                                            <th>Full name</th>
                                            <th>Registred by</th>
                                            <th>Course</th>
                                            <th>Payments</th>
                                            <th>Notes</th>
                                            <th>Country</th>
                                            <th>Added</th>
                                            <th>State</th>
                                            <th>type</th>
                                            <th></th>
                                        </tr>
                                        <?php if(count($clients)): foreach($clients as $key): ?>
                                        <tr>
                                            <td><?php echo $key->file_num; ?></td>
                                            <td><?php echo anchor('clients/client/'.$key->id, $key->first_name.' '.$key->last_name); ?> </td>
                                            <td><?php echo $this->user_m->id_to_name($key->made_by)->name; ?></td>
                                            <td><?php echo anchor('clients/show_course/'.$key->id, 'Course'); ?> </td>
                                            <td><?php echo anchor('payments/index/'.$key->id, 'Payments'); ?> </td>
                                            <td><?php echo anchor('notes/index/'.$key->id, 'Notes'); ?> </td>
                                            <td><?php if($key->country) echo $this->libre->country($key->country); ?></td>
                                            <td><?php echo date('Y/m/d', $key->timestamp); ?></td>
                                            <td><?php if ($key->active != '') echo $status[$key->active]; ?> </td>
                                            <td><?php if ($key->registered_type != '') echo $registered_type[$key->registered_type]; ?> </td>
                                            <td>
                                                <?php echo anchor('clients/edit/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad"><i class="fa fa-pencil"></i></button>'); ?>
                                                <?php echo anchor('clients/delete/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad"><i class="fa fa-trash-o"></i></button>'); ?>
                                            </td>
                                        </tr>                                        
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                                <tr>
                                                    <td colspan="3">We could not find any clients.</td>
                                                </tr>
                                        <?php endif; ?> 
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
