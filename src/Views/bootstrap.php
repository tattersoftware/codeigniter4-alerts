
	<aside id="<?= $prefix ?>wrapper">
<?php
foreach ($alerts as $alert):
?>
		<div role="alert" class="alert alert-<?= $alert['class'] ?> alert-dismissible fade show">
			<?= $alert['text'] ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
<?php
endforeach;
?>
	</aside>
