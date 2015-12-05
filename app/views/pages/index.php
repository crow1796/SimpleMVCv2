<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<?php
		view('partials/_assets');
	?>
</head>
<body>
	<div class="container">
		<h1 class="page-header text-center">Welcome</h1>
		<form action="<?php echo url('user/logout'); ?>" method="POST">
			<input type="hidden" name="<?php echo App\Classes\Utils\Globals::TOKEN_NAME; ?>" value="<?php echo App\Classes\Utils\Token::generate(); ?>">
			<button type="submit" class="btn btn-md btn-link">Logout</button>
		</form>
	</div>
</body>
</html>
