
<?php foreach ($alerts as $alert): ?>
<?php [$class, $content] = $alert; ?>
		<dialog class="alert alert-<?= $class ?>" onclick="this.remove();" open><?= $content ?></dialog>
<?php endforeach; ?>
