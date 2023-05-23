
<h2 class="mb-3">Confirmed purchases</h2>
<div class="table-responsive table--no-card m-b-30" id="cart_details">
<table class="table table-borderless table-striped table-earning">
<thead>
    <tr class="red">
        <th>Name</th>
        <th>City</th>
        <th>Street</th>
        <th>Inserted at</th>
        <th class="text-right">Total price</th>
        <th class="text-right">Details</th>
    </tr>
</thead>
<tbody id="modelsList">
  <?php 
      $status=1;
      $purchases=get_complete_purchases($status);
      foreach($purchases as $purchase):
  ?>
      <tr class="red">
        <td><?= $purchase->first_name. " " .$purchase->last_name ?></td>
        <td><?= $purchase->city_name ?></td>
        <td><?= $purchase->street. " " .$purchase->street_number ?></td>
        <td><?= $purchase->inserted_at ?></td>
        <th class="text-right"><?= $purchase->total_price. ",00$" ?></th>
        <td class="text-center"><a class="btn-potvrdiNek details" href="#" id="cart" data-id="<?= $purchase->cart_id?>"><i class="fa fa-eye"></i></a></td>
    </tr>
  <?php
      endforeach;
  ?>
</tbody>

<div class="modal-bg">
    <div class="nes col-4">
        <div class="card-body" id="cartDetails">

        </div>
    </div>
</div> 