
<h2 class="mb-3">Message</h2>
<div class="table-responsive table--no-card m-b-30" id="models">
<table class="table table-borderless table-striped table-earning">
<thead>
    <tr class="red">
        <th>Sender name</th>
        <th>Header</th>
        <th>Inserted at</th>
        <th class="text-right">View</th>
    </tr>
</thead>
<tbody id="modelsList">
  <?php 
      $messages=get_data('contact');
      foreach($messages as $message):
  ?>
      <tr class="red">
        <td><?= $message->first_name. " " .$message->last_name ?></td>
        <td><?= $message->message_header ?></td>
        <td><?= $message->inserted_at ?></td>
        <?php if($message->message_read): ?>
        <td class="text-center"><a class="btn-potvrdiNek" href="index.php?page=message_body&&id=<?= $message->contact_id?>" id="realEstate" data-id=""><i class="fa fa-eye"></i></a></td>
        <?php else: ?>
        <td class="text-center"><a class="btn-potvrdiNek yellow" href="index.php?page=message_body&&id=<?= $message->contact_id?>" id="realEstate" data-id=""><i class="fa fa-eye"></i></a></td>
        <?php endif; ?>
    </tr>
  <?php
      endforeach;
  ?>
</tbody>
      
