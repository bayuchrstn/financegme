<div class="form-group">
	<label for="">Attachment</label>
	<?php
		// pre($attachments);
		if(!empty($attachments)):
	?>
	<table class="table table-attachment">
		<tbody>
			<?php
				foreach($attachments as $row):
			?>
			<tr id="tr_<?php echo $row['id']; ?>">
				<td width="30" class="text-left"><a class="text-danger" onclick="delete_attachment('<?php echo $row['id']; ?>')" href="javascript:void(0);"><i class="icon-trash"></i></a></td>
				<td><a href="javascript:void(0);"><?php echo $row['file_name']; ?></a></td>
			</tr>
			<?php
				endforeach;
			?>
		</tbody>
	</table>
	<?php
		endif;
	?>
</div>
