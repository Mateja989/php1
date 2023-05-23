<header>
      <nav class="navHeader">
        <label class="logo"><img src="assets/images/logo.jpg"></label>
        <ul class="ulNav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php?page=products">Products</a></li>
                    <li><a href="index.php?page=contact">Contact</a></li>
                    <li><a href="index.php?page=author">Author</a></li>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->role_id==1): ?>
                        <li><a href="index.php?page=profile">Profile</a></li>
                        <li class="btn"><a href="models/logout.php">Log out</a></li>
                    <?php elseif(isset($_SESSION['user']) && $_SESSION['user']->role_id==2): ?>
                        <li class="btn" id="btnLog"><a href="index.php?page=cart">Cart</a></li>
                        <li class="btn"><a href="models/logout.php">Log out</a></li>
                    <?php else: ?>
                        <li class="btn" id="btnLog"><a href="index.php?page=log_in">Sign up</a></li>
                        <li class="btn"><a href="index.php?page=registration">Registration</a></li>
                    <?php endif; ?>
                    </ul>
        <label for="" id="icon">
          <i class="fa fa-bars"></i>
        </label>
      </nav>
</header>
