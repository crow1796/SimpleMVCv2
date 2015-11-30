<?php if(App\Classes\Utils\Session::has('messages')){ ?>
	<div class="alert alert-success flash">
		<ul>
			<?php foreach(App\Classes\Utils\Session::flash('messages') as $message){ ?>
				<li><?php echo $message; ?></li>
			<?php } ?>
		</ul>
	</div>
<?php } ?>