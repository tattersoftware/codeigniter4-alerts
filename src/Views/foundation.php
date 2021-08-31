
	<aside id="<?= $prefix ?>wrapper">
<?php
foreach ($alerts as $alert)
:?>
		<div class="callout alert" data-closable>
			<?= $alert['text'] ?>
			<button type="close-button" aria-label="Dismiss alert" type="button" data-close>
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
<?php
endforeach;
?>
	</aside>
