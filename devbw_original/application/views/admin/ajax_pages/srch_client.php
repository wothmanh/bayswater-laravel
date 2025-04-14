<tr>
    <th>ID</th>
    <th>Full name</th>
    <th>Country</th>
    <th>Registred by</th>
    <th>Date</th>
    <th>State</th>
    <th></th>
</tr>
<?php if(count($clients)): foreach($clients as $key): ?>
<tr>
    <td><?php echo $key->id; ?></td>
    <td><?php echo anchor('clients/client/'.$key->id, $key->first_name.' '.$key->last_name); ?> </td>
    <td><?php echo $this->libre->country($key->country); ?></td>
    <td><?php echo $this->user_m->id_to_name($key->made_by)->name; ?></td>
    <td><?php echo $key->timestamp; ?></td>
    <td><?php if ($key->active == 0) echo "Not Paid"; elseif($key->active == 1) echo "Paid Advance"; else echo "Paid" ?></td>
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