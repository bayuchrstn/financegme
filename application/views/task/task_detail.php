<div>
	<div class="table-responsive">
		<table class="table-info">
			<tr>
				<td width="150px">Judul</td>
				<td width="10px">:</td>
				<td><?php echo $subject; ?></td>
			</tr>
			<tr>
				<td width="150px">Status</td>
				<td width="10px">:</td>
				<td><?php echo ucwords(str_replace('_', ' ', $status)); ?></td>
			</tr>
			<tr>
				<td width="150px">Author</td>
				<td width="10px">:</td>
				<td><?php echo $author['name']; ?></td>
			</tr>
			<tr>
				<td width="150px">Tanggal</td>
				<td width="10px">:</td>
				<td><?php echo $date_created; ?></td>
			</tr>

			<!-- user assign -->
			<?php if (!empty($user_assinged)): ?>
				<tr>
					<td width="150px">Pelaksana</td>
					<td width="10px">:</td>
					<td>
						<?php 
						$i = 0;
						foreach ($user_assinged as $row_assign){
							if ($i>0) echo ', ';
							echo $row_assign['name'];
							$i++;
						}
						?>
							
					</td>
				</tr>
			<?php endif ?>

		</table>
	</div>
	<br>
	<?php echo $body; ?>
</div>