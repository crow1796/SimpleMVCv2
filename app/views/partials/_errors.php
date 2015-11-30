<?php if(App\Classes\Utils\Session::has('errors')){ ?>
	<div class="alert alert-danger flash">
		<ul>
			<?php foreach(App\Classes\Utils\Session::flash('errors') as $error){ ?>
				<li><?php echo $error; ?></li>
			<?php } ?>
		</ul>
	</div>
<?php } ?>