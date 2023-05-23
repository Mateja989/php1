<?php 
    $sneakers=get_data('sneaker');
    
    $arrayIds=[];
    foreach($sneakers as $sneaker){
        $arrayIds[]=$sneaker->sneaker_id;
    }
    if(in_array($_GET['id'],$arrayIds)):
?>
<div class="container mt-5 pt-3">
                <div class="row mt-5">
                    <?php
                        if(isset($_GET['id'])){
                            $id=$_GET['id'];
                            $model=get_model_with_sizes($id);
                            stranaPregled($model->sneaker_name);
                        }
                    ?>
                    <div class="col-lg-6 col-md-12 ovj mt-3">
                        <img src="<?= $model->cover_picture ?>" alt="">
                    </div>
                    <div class="col-lg-5 col-md-12  text-div mt-5">
                        <h4><?= $model->brand_name?> Sneakers <br><?= $model->sneaker_name ?></h4>
                        <p class="cenaPr"><?= $model->price ?>,00$</p>
                        <ul>
                            <li class="spec"><img src="assets/images/stiklica.svg" alt="">Brand: <?= $model->brand_name?></li>
                            <li class="spec"><img src="assets/images/stiklica.svg" alt="">Gender: <?= $model->gender_name?></li>
                            <li class="spec"><img src="assets/images/stiklica.svg" alt="">Category: <?= $model->category_name?></li>
                        </ul>
                        <p class="size-header">Pick your size</p>
                        <ul class="size">
                            <?php   
                                foreach($model->sizes as $x): 
                            ?>
                            <li class="nO" data-id="<?= $x->sneaker_size_id ?>"><?= $x->size_eu ?></li>
                            <?php
                                endforeach;
                            ?>
                        </ul>
                        <?php 
                            if(isset($_SESSION['user']) && $_SESSION['user']->role_id == 2): 
                        ?>
                            
                                <button class="btn" id="addBtn"><a href="#" id="cartBtn" data-sneakerid="<?= $x -> sneaker_id ?>">Add to cart</a></button>
                            <div id="addInfo">
                            </div>
                        <?php elseif(isset($_SESSION['user']) && $_SESSION['user']->role_id == 1): ?>
                            <p>Admin je car</p>
                        <?php else: ?>
                            <h3 class="txtForReg">Only register users can make a purchase</h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
<?php else: header('location: index.php') ?>
<?php endif; ?>