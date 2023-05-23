
                                
                                <div id="responseDelete">

                                </div>
                                <h2 class="mb-3">Active models</h2>
                                <div class="table-responsive table--no-card m-b-30" id="models">
                                <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr class="red">
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th class="text-right">View</th>
                                        <th class="text-right">Edit price</th>
                                        <th class="text-right">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="modelsList">
                                  <?php 
                                      $models=get_data('sneaker');
                                      foreach($models as $model):
                                  ?>
                                      <tr class="red">
                                        <td><?= $model->sneaker_name ?></td>
                                        <td><?= $model->inserted_at ?></td>
                                        <td class="text-center"><a class="btn-potvrdiNek" href="index.php?page=product_page&&id=<?= $model->sneaker_id?>" id="realEstate" data-id=""><i class="fa fa-eye"></i></a></td>
                                        <td class="text-center"><a class="btn-potvrdiNek editbtn" href="#" id="changePrice" data-id="<?= $model->sneaker_id?>"><i class="fa fa-pen"></i></a></td>
                                        <td class="text-center"><a class="btn-obrisiNek deleteModel" href="#" id="deleteAd" data-iddelete="<?= $model->sneaker_id?>"
                                        ><i class="fa fa-trash"></a></a></td>
                                    </tr>
                                  <?php
                                      endforeach;
                                  ?>
                                </tbody>
                                      
                                </div>                          
<div class="modal-bg">
    <div class="nes col-4">
        <div class="card-body" id="modelPrice">

        </div>
    </div>
</div> 