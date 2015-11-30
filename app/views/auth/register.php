<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<?php
			view('partials/_assets');
		?>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
				<h1 class="text-center page-header">Register</h1>
				<?php
					view('partials/_errors');
				?>
					<form action="?controller=AuthController&amp;action=postRegister" method="POST">
						<div class="form-group">
							<label for="username" class="control-label">Username:</label>
							<input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
						</div>
						<div class="form-group">
							<label for="password" class="control-label">Password:</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
						</div>
						<div class="form-group">
							<label for="confirm-password" class="control-label">Confirm Password:</label>
							<input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Re-enter your password">
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="firstname" class="control-label">First Name:</label>
								<input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name">
							</div>
							<div class="col-sm-6">
								<label for="lastname" class="control-label">Last Name:</label>
								<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">E-mail:</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter your E-mail">
						</div>
						<div class="form-group">
							<label for="address" class="control-label">Address:</label>
							<input type="text" name="address" id="address" class="form-control" placeholder="Enter your address">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-md btn-block btn-primary">Register!</button>
						</div>
					</form>
					Already have an account? <a href="?=controller=AuthController&amp;action=getLogin">Click here!</a>
				</div>
			</div>
		</div>
	</body>
</html>