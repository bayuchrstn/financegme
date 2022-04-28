<script type="text/javascript">

	function view_ref(prefix)
	{
		var task_ref = $('#up_select_'+prefix).val();
		// alert(task_ref);
		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>ajax/info_refe/'+task_ref,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
				$("#modal_rev_div").load("<?php echo base_url(); ?>"+response.url+"/show/"+task_ref+"/echo");
				$('#modal_rev').modal('show');
            }
        });
		return false;
	}

	function show_attachment(url, target_div)
	{
		$.ajax({
            type:'GET',
            url: url,
            success: function(res) {
                // var response = jQuery.parseJSON(res);
				// console.log(response);
                $('#'+target_div).html(res);
            }
        });
		return false;
	}

	function delete_attachment(id)
	{
		// alert('delete_attachment '+id);
		$.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>attachment/delete/'+id,
            success: function(res) {
				$('#tr_'+id).remove();
            }
        });
		return false;
	}

</script>
