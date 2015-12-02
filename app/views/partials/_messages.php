<?php if(App\Classes\Utils\Session::has('messages')){ ?>
	<div class="alert alert-success flash">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<ul>
			<?php foreach(App\Classes\Utils\Session::flash('messages') as $message){ ?>
				<li><?php echo $message; ?></li>
			<?php } ?>
		</ul>
	</div>
<?php } ?>