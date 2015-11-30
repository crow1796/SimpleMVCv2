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
				<h1 class="text-center page-header">Login</h1>
					<?php
						view('partials/_messages');
					?>
					<form action="?controller=AuthController&amp;action=postLogin" method="POST">
						<div class="form-group">
							<label for="username" class="control-label">Username:</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Enter Your Username">
						</div>
						<div class="form-group">
							<label for="password" class="control-label">Password:</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-md btn-primary">Login</button>
						</div>
						<div class="form-group">
							No account? <a href="?controller=AuthController&amp;action=getRegister">Sign Up</a>
						</div>
					</form>
					<?php 
						view('partials/_errors');
					 ?>
				</div>
			</div>
		</div>
	</body>
</html>