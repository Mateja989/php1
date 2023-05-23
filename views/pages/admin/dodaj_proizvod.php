<div class="container rounded bg-white mt-5 mb-5 back">
    <div class="row">
        <div class="col-md-8 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Add new product</h4>
                </div>
            <form action="models/noviProizvod.php" method="post" enctype='multipart/form-data'>
                
                   <div class="col-md-12">
                      <label class="labels">Cover picture</label>
                      <input type="file" class="form-control" placeholder="Enter model picture" value="" name="cover_picture">
                
                    </div>     
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience">
                  <span>Chose available sizes</span>
                </div>
                <br>
                <section class="content">
                  <ul class="list" style="list-style: none;">
                    <?php 
                      $sizes=get_data('size');
                      foreach($sizes as $size):
                    ?>
                    <li class="list_item">
                        <input type="checkbox" class="checkbox2" name="chbSize[]" value="<?= $size->size_id ?>"><?= $size->size_eu ?>EU <?= $size->size_uk ?>UK <?= $size->size_us ?>US <?= $size->size_cm ?>cm
                    </li>
                    <?php
                      endforeach;
                    ?>
                  </ul>
                  <?php if(isset($_SESSION['sizesError'])) : ?>
						              <p class="error-text"><?= $_SESSION['sizesError'] ?></p>
					        <?php endif; ?>
                  <div class="mt-5 text-center">
                    <input class="btn btn-primary profile-button" type="submit" value="SAVE PRODUCT" name="btn-product">
                  </div>
                  <button class="btn mt-3 btn-primary yellow profile-button"><a href="index.php?page=profile">Back to panel<a/a></button>
                    <?php if(isset($_SESSION['successModel'])) : ?>
						              <p class="error-text green"><?= $_SESSION['successModel'] ?></p>
					        <?php endif; ?>
                  </div>
                </section>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>

<?php
/*	unset($_SESSION['modelError']);
	unset($_SESSION['brandError']);
	unset($_SESSION['categoryError']);
	unset($_SESSION['genderError']);
	unset($_SESSION['priceError']);
	unset($_SESSION['pictureError']);
  unset($_SESSION['sizesError']);
  unset($_SESSION['successModel']);*/
?>