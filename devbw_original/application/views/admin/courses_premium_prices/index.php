
<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Prices</h3>
                    <div class="box-tools">
                        <?php echo anchor('courses_premium_prices/edit/'.$course_premium_id, '<button class="btnsmall12 btn btn-primary plus_btn_icon"> Add Price</button>', array('class' => 'link_add_new')); ?>
                        
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Weeks</th>
                            <th>Price</th>
                            <th>BY</th>
                            <th>AT</th>
                            <th>State</th>
                            <th></th>
                        </tr>
                        <?php if(count($prices)): foreach($prices as $key): ?>
                        <tr>
                            <td><?php echo $key->duration; ?></td>
                            <td><?php echo $key->price; ?></td>
                            <td><?php echo $this->user_m->id_to_name($key->created_by)->name; ?></td>
                            <td>
                                <?php echo date('Y-m-d', strtotime($key->created_at)); ?>
                                <br />
                                <?php echo date('H:i:s', strtotime($key->created_at)); ?>
                            </td>
                            <td><?php if ($key->active == 1) echo "Active"; else echo "Not active"; ?></td>
                            <td>
                                <?php echo anchor('courses_premium_prices/edit/'.$course_premium_id.'/' . $key->id, '<button class="btnsmall btn btn-success" id="ghad"><i class="fa fa-pencil"></i></button>'); ?>
                                <?php echo anchor('courses_premium_prices/delete/'.$course_premium_id.'/' . $key->id, '<button class="btnsmall btn btn-danger" id="ghad"><i class="fa fa-trash-o"></i></button>'); ?>
                            </td>
                        </tr>                                        
                        <?php endforeach; ?>
                        <?php else: ?>
                                <tr>
                                    <td colspan="5">We could not find any prices.</td>
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
