
<?php foreach ($alerts as $alert): ?>
<?php [$class, $content] = $alert; ?>

		<div class="callout alert <?= $class ?>" data-closable>
			<?= $content ?>
			<button type="close-button" aria-label="Dismiss alert" type="button" data-close>
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

<?php endforeach; ?>
