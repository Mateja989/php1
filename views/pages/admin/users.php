


<h2 class="mb-3">Active users</h2>
<div class="table-responsive table--no-card m-b-30" id="users">
<table class="table table-borderless table-striped table-earning">
<thead>
    <tr class="red">
        <th>Full Name</th>
        <th>Username</th>
        <th>Mail</th>
        <th class="text-right">Details</th>
        <th class="text-right">Deactive/Active</th>
    </tr>
</thead>
<tbody id="modelsList">
  <?php 
      $users=get_data('user');
      foreach($users as $user):
        if($user->user_id != $_SESSION['user']->user_id):
  ?>
    
      <tr class="red">
        <td><?= $user->first_name. " " .$user->last_name ?></td>
        <td><?= $user->username ?></td>
        <td><?= $user->mail ?></td>
        <td class="text-center"><a class="btn-potvrdiNek" href="#" id="userInfo" data-id="<?= $user->user_id ?>"><i class="fa fa-eye"></i></a></td>
        <td class="text-center"><a class="btn-obrisiNek deleteModel" href="#" id="deleteAd" data-iddelete="<?= $user->user_id?>"
        ><i class="fa fa-trash"></a></a></td>
    </tr>
  <?php
        endif;
      endforeach;
  ?>
</tbody>
      
</div>                          


<div class="modal-bg">
        <div class="nes col-4">
                <div class="card-body" id="infoForUser">

              </div>
</div>