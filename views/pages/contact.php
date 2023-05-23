<main>
    <div class="container mt-5">
      <div class="row">
          <div class="col-12">
              <ul class="d-flex stay">
                  <li>Home</li>
                  <span><li>/</li></span>
                  <li>Contact</li>
              </ul>
          </div>
          <h1>Contact</h1>
      </div>
      <hr class="line"/>
  </div>
  <div class="container mb-5">
    <div class="row">
      <div class="col-lg-7 col-md-12">
        <form action="models/contact.php" method="POST" id="contactForm">
          <div class="kontaktForma">
            <input type="text" class="" placeholder="First name" value="<?= isset($_SESSION['user']->first_name)?$_SESSION['user']->first_name : ''?>" id="firstName" name="firstName"/>
            <?php if(isset($_SESSION['firstNameError'])): ?>
              <p class="error-text"><?= $_SESSION['firstNameError'] ?></p>
            <?php endif; ?>
          </div>
          <div class="kontaktForma">
            <input type="text" class="" placeholder="Last name" value="<?= isset($_SESSION['user']->last_name)?$_SESSION['user']->last_name : ''?>"  id="lastName" name="lastName"/>
            <?php if(isset($_SESSION['lastNameError'])): ?>
              <p class="error-text"><?= $_SESSION['lastNameError'] ?></p>
            <?php endif; ?>
          </div>
          <div class="kontaktForma">
            <input type="text" class="" placeholder="Headline" value=""  id="headline" name="headline"/>
            <?php if(isset($_SESSION['headerError'])): ?>
              <p class="error-text"><?= $_SESSION['headerError'] ?></p>
            <?php endif; ?>
          </div>
          <textarea type="text" rows="5"  class="mt-3 form-control kontaktPoljeZaTekst" placeholder="Describe yourself here..." value=""  id="message" name="message">
          </textarea>
          <input type="submit" class="btn btnContact" id="btnCont" value="Send message" name="btn-contact"/>
          <?php if(isset($_SESSION['success'])): ?>
              <p class="error-text green"><?= $_SESSION['success'] ?></p>
            <?php endif; ?>
        </form>
      </div>
      <div class="col-lg-5 col-md-12 mt-5">
        <h3 class="text-center">Company info</h3>
        <p class="text-center pKontakt">Buzz Sneakers</p>
        <p class="text-center pKontakt">Abbey Road11,London</p>
        <p class="text-center pKontakt">England</p>
        <p class="text-center pKontakt">Mobile: +381 61 12 13 148</p>
        <p class="text-center pKontakt">Email: info@buzz.com</p>
      </div>
    </div>
  </div>
  </main>

  <?php
    unset($_SESSION['firstNameError']);
    unset($_SESSION['lastNameError']);
    unset($_SESSION['headerError']);
    unset($_SESSION['success']);
?>