<?php
	// pre($detail);
	$data = array();
?>
<div id="msg_alert"></div>
<div class="panel panel-flat">
	<div class="panel-heading">
		<h6 class="panel-title"><?php echo $detail['title'] ?></h6>
		<div class="heading-elements">
			<span class="heading-text">
				<i class="icon-comments"></i> <a href="javascript:void(0);" onclick="progress_comment('<?php echo $detail['id']; ?>')">Komentar</a>
			</span>
		</div>
    </div>

	<div class="panel-body">
		<div id="tab_div">
			<?php echo $this->load->view('progress/tabby', $data, TRUE); ?>
		</div>
	</div>
</div>
<?php
	echo $modal_view;
?>
