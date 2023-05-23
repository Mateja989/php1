<body class="reg">
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
				<form action="models/registration.php" method="POST" id="registration_form">
					<label for="chk" aria-hidden="true">Register</label>
					<input type="text" name="first_name" id="first_name" placeholder="First name" >
					<p class="error-text hidden">First name isn`t in right format</p>
					<?php if(isset($_SESSION['first_name'])) : ?>
						<p class="error-text"><?= $_SESSION['first_name'] ?></p>
					<?php endif; ?>
					<input type="text" name="last_name" id="last_name" placeholder="Last name" >
					<p class="error-text hidden">Last name isn`t in right format</p>
					<?php if(isset($_SESSION['last_name'])): ?>
						<p class="error-text"><?= $_SESSION['last_name'] ?></p>
					<?php endif; ?>
					<input type="text" name="username" id="username" placeholder="Username" >
					<p class="error-text hidden">Username isn`t in right format</p>
					<?php if(isset($_SESSION['username'])) : ?>
						<p class="error-text"><?= $_SESSION['username'] ?></p>
					<?php endif; ?>
					<input type="email" name="email" id="email" placeholder="Email" >
					<p class="error-text hidden">Email isn`t in right format</p>
					<?php if(isset($_SESSION['email'])) : ?>
						<p class="error-text"><?= $_SESSION['email'] ?></p>
					<?php endif; ?>
					<input type="password" name="password" id="password" placeholder="Password" >
					<p class="error-text hidden">Password isn`t in right format</p>
					<?php if(isset($_SESSION['password'])) : ?>
						<p class="error-text"><?= $_SESSION['password'] ?></p>
					<?php endif; ?>
					<select name="city-ddl" id="city-ddl">
						<option value="0">Choose your city</option> 
						<?php
							
							$cities=get_data('city');
							foreach($cities as $city): 
						?>
						<option value="<?= $city->city_id ?>"><?= $city->city_name ?></option>
						<?php endforeach; ?>
					</select>
					<p class="error-text hidden">Choose only available city</p>
					<input type="text" name="street" id="street" placeholder="Street name" >
					<p class="error-text hidden">Street isn`t in right format</p>
					<?php if(isset($_SESSION['street'])) : ?>
						<p class="error-text"><?= $_SESSION['street'] ?></p>
					<?php endif; ?>
					<input type="text" name="street_number" id="street_number" placeholder="Street number">
					<p class="error-text hidden">Street number isn`t in right format</p>
					<input type="submit" value="Sign up" name="submit-btn" id="submit-btn"></input>
				</form>
			</div>
	</div>
	<script src="assets/js/main.js"></script>
</body>
</html>

  
<?php
	unset($_SESSION['first_name']);
	unset($_SESSION['last_name']);
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['street']);
	unset($_SESSION['email']);
?>