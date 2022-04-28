<?php
	$button_color = (isset($button_color)) ? $button_color : 'btn-info';
	$label = (isset($label)) ? $label : '';
	$id = (isset($id)) ? $id : 'fileupload';
	$name = (isset($name)) ? $name : 'attachment';
	$multiple = (isset($multiple) && $multiple !='') ? 'multiple="multiple"' : '';
?>

<div class="form-group">
	<span class="btn <?php echo $button_color; ?> btn-file">
		<i id="ibuttonuploader_<?php echo $prefix; ?>" class=""></i> <?php echo $label; ?> <input id="<?php echo $id; ?>" class="form-control" type="file" name="<?php echo $name; ?>" <?php echo $multiple; ?>>
	</span>
</div>
<!-- <div id="upload-loader"></div> -->
<div id="attachment_div_<?php echo $prefix; ?>"></div>
<ul id="attachment_ul_<?php echo $prefix; ?>" class="attachment_ul"></ul>

<!-- <ul class="attachment_ul">
	<li id="attachment_li_1" class="alert alert-primary no-border mb-5">Lorem ipsum dolor sit amet <a onclick="remove_this_attachment(1);" href="javascript:void(0);" class="pull-right"><i class="icon-trash position-left"></i>Remove</a></li>
	<li id="attachment_li_2" class="alert alert-primary no-border mb-5">Faucibus porta lacus fringilla vel <a onclick="remove_this_attachment(2);" href="javascript:void(0);" class="pull-right"><i class="icon-trash position-left"></i>Remove</a></li>
	<li id="attachment_li_3" class="alert alert-primary no-border mb-5">Aenean sit amet erat nunc <a onclick="remove_this_attachment(3);" href="javascript:void(0);" class="pull-right"><i class="icon-trash position-left"></i>Remove</a></li>
</ul> -->
