<script type="text/javascript">
$(function() {
	var pageUri = $('#pageUri').val();

	$("#formulir_modal").validate({
		rules: {
			coa_from: {required: true},
			card_from: {required: true},
			coa_to: {required: true},
			card_to: {required: true},
		},
		submitHandler: function(form) {
			$.ajax({
				type:'POST', 
				url:pageUri+'edit_data', 
				data:$('#formulir_modal').serialize(),
				beforeSend: function(){
					blockUI();
				},
				success: function(response) {
					if(response == '1'){
						alert('Data berhasil disimpan');
					}else if(response == '0'){
						alert('Data gagal disimpan');
					}else{
						alert(response);
					}
					unBlockUI();
				}
			});
			return false;
		}
	});
	
});

function select_card_from(){
	var pageUri = $('#pageUri').val();
	var coa_from = $('#coa_from').val();
	
	$.ajax({
		type:'POST', 
		url: pageUri+'select_card_from',
		data:{coa_from:coa_from},
		beforeSend: function(){
			blockUI();
		},
		success: function(html){
			$('#card_from').html(html);
			unBlockUI();
		}
	});
	return false;
}

function select_card_to(){
	var pageUri = $('#pageUri').val();
	var coa_to = $('#coa_to').val();
	
	$.ajax({
		type:'POST', 
		url: pageUri+'select_card_to',
		data:{coa_to:coa_to},
		beforeSend: function(){
			blockUI();
		},
		success: function(html){
			$('#card_to').html(html);
			unBlockUI();
		}
	});
	return false;
}
</script>
