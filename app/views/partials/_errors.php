<?php if(App\Classes\Utils\Session::has('errors')){ ?>
	<div class="alert alert-danger flash">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<ul>
			<?php foreach(App\Classes\Utils\Session::flash('errors') as $error){ ?>
				<li><?php echo $error; ?></li>
			<?php } ?>
		</ul>
		
	</div>
<?php } ?>