<?php if(isset($_SESSION['user']) && $_SESSION['user']->role_id == 1): ?>
<div class="container adminColor">
    <div class="main-body " id="">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="assets/img/profile.jpg" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                        <?php 
                            if(isset($_SESSION['user']) && $_SESSION['user']->role_id==1)
                            {
                                $user=get_user($_SESSION['user']->user_id);
                            }
                        ?>
                      <h4><?= $user->first_name. " " .$user->last_name?></h4>
                      <p class="text-secondary mb-1"><?= $user->role_name ?></p>
                      <p class="text-muted font-size-sm"><?= $user->mail ?></p>
                      <a href="index.php?page=add_product"><button class="btn btn-primary">Add product</button></a>
                      <a href="models/export_brand.php"><button class="btn btn-outline-primary">Download brand</button></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Models</h6>
                    <a href="index.php?page=admin_sneakers"><span class="text-secondary">View All</span></a>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Users</h6>
                    <a href="index.php?page=admin_users"><span class="text-secondary">View All</span></a>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Purchases</h6>
                    <a href="index.php?page=purchase"><span class="text-secondary">View all</span></a>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Message</h6>
                    <a href="index.php?page=message"><span class="text-secondary">View all</span></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
                
            <div class="row">
                            <div>
                              <form action="models/add_brand.php" method="post">
                                <h4>Add new brand</h4>
                                <input type="text" class="form-control" name="brand"/>
                                <?php if(isset($_SESSION['existBrand'])): ?>
                                  <p class="error-text"><?= $_SESSION['existBrand'] ?></p>
                                <?php elseif(isset($_SESSION['nameError'])): ?>
                                  <p class="error-text"><?= $_SESSION['nameError'] ?></p>
                                <?php elseif(isset($_SESSION['uploaded'])): ?> 
                                  <p class="error-text green"><?= $_SESSION['uploaded'] ?></p>
                                <?php endif; ?>
                                <input type="submit" value="Save brand" name="newBrand" class="mb-5" id="srcBtn"/>
                              </form>
                    </div>
<?php else: header('location: index.php'); ?>
<?php endif; ?>