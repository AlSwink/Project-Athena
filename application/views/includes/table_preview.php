<table class="table table-sm table-hover table-bordered" style="font-size: 10px;">
	<thead>
		<tr class="table-primary">
			<?php foreach($headers as $header){ ?>
			<th><?= strtoupper($header); ?></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach($rows as $row){ ?>
			<tr>
				<?php foreach($headers as $header){ ?>
					<td><?= $row[$header]; ?></td>
					<input type="hidden" name="<?= $header; ?>[]" value="<?= $row[$header]; ?>"/>
				<?php } ?>	
			</tr>
		<?php } ?>
	</tbody>
</table>