
	<aside id="<?= $prefix ?>wrapper">
<?php
foreach ($alerts as $alert)
:?>
		<dialog class="<?= $prefix ?>alert <?= $prefix ?>alert-<?= $alert['class'] ?>" onclick="this.remove();" open ><?= $alert['text'] ?></dialog>
<?php
endforeach;
?>
	</aside>
