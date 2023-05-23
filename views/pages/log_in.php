<body class="reg">
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
				<form action="models/log_in.php" method="POST" id="log_in_form">
					<label for="chk" aria-hidden="true">Log In</label>
					<input type="text" name="username" id="username-login" placeholder="Username" >
					<p class="error-text hidden">Username isn`t in right format</p>
					<?php if(isset($_SESSION['username'])) : ?>
						<p class="error-text"><?= $_SESSION['username'] ?></p>
					<?php endif; ?>
					<input type="password" name="password" id="password-login" placeholder="Password" >
					<p class="error-text hidden">Password isn`t in right format</p>
					<?php if(isset($_SESSION['password'])) : ?>
						<p class="error-text"><?= $_SESSION['password'] ?></p>
					<?php endif; ?>
					<input type="submit" value="Log in" name="log-btn" id="log-btn">
                    <?php if(isset($_SESSION['noUser'])) : ?>
						<p class="error-text"><?= $_SESSION['noUser'] ?></p>
					<?php endif; ?>
				</form>
			</div>
	</div>
	<!--<script src="assets/js/main.js"></script>-->
</body>
</html>

<?php
    unset($_SESSION['noUser']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
?>