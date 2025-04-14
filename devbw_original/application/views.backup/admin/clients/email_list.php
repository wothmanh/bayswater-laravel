<div style="color:#000;">

    <div style="text-align:center">
        <img  src="<?php echo $this->config->item('base_url2').'img/'.$settings->logo; ?>" style='width:150px;'>
    </div>

    <h3 style="text-align:center"><?php echo $subject; ?></h3>

         		<div >
                    <table align="center" border="1" cellpadding="10" cellspacing="0"style="margin:auto;border:1px;">
                       <tr>
                            <th>File num.</th>
                            <th>Full name</th>
                            <th>Email</th>
                            <th>Branch</th>
                            <th>Country</th>
                            <th>Registred by</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>State</th>
                        </tr>
                        <?php if(count($erclients)): foreach($erclients as $key): ?>
                        <tr>
                            <td><?php echo $key->file_num; ?></td>
                            <td><?php echo $key->first_name.' '.$key->last_name; ?> </td>
                            <td><?php echo $key->email; ?></td>
                            <td><?php if ($key->branch != '') echo $allbranches[$key->branch]; ?></td>
                            <td><?php echo $this->libre->country($key->country); ?></td>
                            <td><?php echo $this->user_m->id_to_name($key->made_by)->name; ?></td>
                            <td><?php echo date('Y/m/d', $key->timestamp); ?></td>
                            <td><?php if ($key->registered_type != '') echo $registered_type[$key->registered_type]; ?></td>
                            <td><?php if ($key->active != '') echo $status[$key->active]; ?> </td>
                        </tr>                                        
                        <?php endforeach; ?>
                        <?php else: ?>
                                <tr>
                                    <td colspan="3">We could not find any clients.</td>
                                </tr>
                        <?php endif; ?> 
                    </table>
                </div><!-- /.box-body -->


    <div style="text-align:center"><?php echo $settings->pdf_footer;; ?></div>

</div>