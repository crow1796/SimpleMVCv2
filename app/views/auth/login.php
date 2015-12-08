<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			$title = 'Login';
      view('partials/_assets', compact('title'));
    ?>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-5 col-sm-offset-7">
					<h1 class="text-center page-header">Login</h1>
					<?php
						view('partials/_messages');
						view('partials/_errors');
					?>
					<form action="<?php echo url('login/attempt'); ?>" method="POST">
						<input type="hidden" name="<?php echo App\Classes\Utils\Globals::TOKEN_NAME; ?>" value="<?php echo App\Classes\Utils\Token::generate(); ?>">
						<div class="form-group">
							<label for="username" class="control-label">Username:</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Enter Your Username">
						</div>
						<div class="form-group">
							<label for="password" class="control-label">Password:</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
						</div>
						<div class="form-group">
							<label for="remember-me" class="control-label"><input type="checkbox" name="remember-me" id="remember-me"> Remember Me?</label>
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-md btn-primary">Login</button>
						</div>
						<div class="form-group">
							<p>Don't have any account? <a href="<?php echo url('register'); ?>">Sign Up</a></p>
							<p>Forgot password? <a href="<?php echo url('forgot-password'); ?>">Recover Password</a></p>
						</div>
					</form>
					<button class="btn btn-md btn-danger" type="button" id="sampleajaxbtn">Ajax</button>
					<div class="ajax-result"></div>
				</div>
			</div>
		</div>
	</body>
</html>
