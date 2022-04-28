<script type="text/javascript">
$(function() {
});

function select_date(){
	var id_val = $('#searchTanggal').val();
	
	if(id_val == '1'){
		$('#date_selected').css('display', '');
		$('#date_closed').css('display', 'none');
	}else if(id_val == '3'){
		$('#date_selected').css('display', 'none');
		$('#date_closed').css('display', '');
	}
}
</script>
