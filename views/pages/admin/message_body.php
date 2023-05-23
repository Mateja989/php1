<?php 
    $messages=get_data('contact');
    $arrayIds=[];
    foreach($messages as $x){
        $arrayIds[]=$x->contact_id;
    }
    if(in_array($_GET['id'],$arrayIds)):


    $message=get_message($_GET['id']);
    if(!$message->message_read){
        $read_message=mark_as_message_read($_GET['id']);
    }


?>
<h2 class="mb-3">Message</h2>
<div class="table-responsive table--no-card m-b-30" id="models">
<table class="table table-borderless table-striped table-earning">
<thead>
    <tr class="red">
        <th>Sender name: <?= $message->first_name. " " .$message->last_name ?></th>
    </tr>
</thead>
<tbody id="modelsList">
      <tr class="red">
        <td>Header: <?= $message->message_header ?></td>
    </tr>
    <tr class="red">
        <td><?= $message->message_body ?></td>
    </tr>
</tbody>
<?php else: header('location: index.php') ?>
<?php endif; ?>