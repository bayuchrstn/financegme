<?php 
	$triwulan = ceil(intval(date('m'))/3);
?>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url : '<?php echo base_url(); ?>marketing_fee/detail',
			type: 'POST',
			data: {id: '<?php echo my_id(); ?>', triwulan: '<?php echo $triwulan; ?>'},
			success: function(ret){
				$('#content_marketing_fee').empty().append(ret);
				$('#modal_mf_search').modal('hide');
			}
		});
	});

	function search_mf() {
		$('#modal_mf_search').modal('show');
	}

	//submit form_mf_search
	$('#form_mf_search').submit(function(){
		$.ajax({
			url : $('#form_mf_search').attr('action'),
			type: 'POST',
			data: $('#form_mf_search').serialize(),
			success: function(ret){
				$('#content_marketing_fee').empty().append(ret);
				$('#modal_mf_search').modal('hide');
			}
		});
		return false;
	});
</script>