<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');
	tinymce.init({
		selector: '.wysiwyg',
		statusbar:  false,
		menubar:    false,
		rel_list:   [ { title: 'Lightbox', value: 'lightbox' } ],
		setup: function(editor) {
			editor.on('change', function(e) {
				var isi = this.getContent();
				$('.fake_tinymce').val(isi);
			});
		}
	});

	function show_this(x)
    {
        console.log(x);
        $("#modal_vmr_mrk_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
        $.ajax({
			type: 'GET',
			url : '<?=base_url();?>ajax/get_task_comment/'+x,
			success: function(res){
				var response = $.parseJSON(res);
				$('#show_komentar_div').empty();
				append_tag = '';
				if (response.data.length > 0) {
					const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
					for (var i = 0; i < response.data.length; i++) {
						var tanggal = new Date(response.data[i].date_post*1000);
						var tanggal_array = {
							'tahun' : tanggal.getFullYear(),
							'bulan' : ('0'+(tanggal.getMonth()+1)).slice(-2),
							'tanggal' : ('0'+tanggal.getDate()).slice(-2),
							'jam' : ('0'+tanggal.getHours()).slice(-2),
							'menit' : ('0'+tanggal.getMinutes()).slice(-2),
							'detik' : ('0'+tanggal.getSeconds()).slice(-2)
						};
						var tanggal_post = tanggal_array.tanggal+' '+monthNames[tanggal_array.bulan-1]+' '+tanggal_array.tahun+' '+tanggal_array.jam+':'+tanggal_array.menit;
						// var tanggal_post = '';

						append_tag += '<div class="row"><div class="col-md-12"><div class="media-body">'+response.data[i].content+'<div class="media-annotation">'+response.data[i].author_name+' pada '+tanggal_post+'</div></div></div></div>';
					}
					append_tag += '<br>';
				}
				append_tag += '<a class="btn btn-primary" onclick="addComment('+x+');"><i class="icon-comments"></i> Komentar</a>';
				$('#show_komentar_div').append(append_tag);
			}
		});
        $('#modal_vmr_mrk').modal('show');
    }

	function update(id)
    {
		// alert('oye');
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
        // var action = '<?php echo base_url(); ?>pekerjaan_teknis/update/'+id;
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

				var arr = [];
				$.each(response.user_assigned, function( index, value ) {
                    // console.log(value);
					arr.push(value);
                    // $('#chk_'+value).prop('checked', true);
                });

				set_option('<?php echo base_url(); ?>select_option/request/task_teknis/assigned_user', 'user_assigned_update', arr);

				location_picker(response.location, response.location_id, 'location_update', 'location_id_update');
				assigned_picker('custom', '', 'user_assigned_structure_update', 'user_assigned_id_update');

				set_option('<?php echo base_url(); ?>select_option/request/task_teknis/jenis_pekerjaan_teknis', 'category_id_update', response.category);
				getajax('<?php echo base_url(); ?>marketing_request/show/'+response.id+'/echo', 'info_request_update');

				// form customize
				$("#form_<?php echo $modul['code']?>_update").attr('action', '<?php echo base_url(); ?>xhr/view_marketing_request/create_task');
                $("#form_<?php echo $modul['code']?>_update #subject_update").val(response.subject);
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
                $("#form_<?php echo $modul['code']?>_update #date_start_update").val(response.date_start);
                $("#form_<?php echo $modul['code']?>_update #date_due_update").val(response.date_due);
                $("#form_<?php echo $modul['code']?>_update #progress_id_update").val(response.progress_id);
                $("#form_<?php echo $modul['code']?>_update #up_update").val(response.id);
				tinyMCE.get('body_update').setContent(response.body);
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);

                $('#modal_request_update').modal('show');
            }
        });
        return false;
    }

	function assigned_picker(assigned_structure, assigned_id, fassigned_structure, fassigned_id)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>user_assign_picker/index/'+assigned_structure+'/'+assigned_id,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#'+fassigned_structure).html(response.structure).val(assigned_structure).chosen().trigger('chosen:updated');
				$('#'+fassigned_id).html(response.assigned).val(assigned_id).chosen().trigger('chosen:updated');
			}
		});
	}


	function location_picker(location, location_id, flocation, flocation_id)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>location_picker/all/'+location+'/'+location_id,
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#'+flocation).html(response.location).val(location).chosen().trigger('chosen:updated');
				$('#'+flocation_id).html(response.location_id).val(location_id).chosen().trigger('chosen:updated');
			}
		});
	}

	if( $('#location_insert').length ){
		$('#location_insert').change(function(){
			var location = $(this).val();
			location_picker(location, '', 'location_insert', 'location_id_insert');
		});
	}

	if( $('#location_update').length ){
		$('#location_update').change(function(){
			var location = $(this).val();
			location_picker(location, '', 'location_update', 'location_id_update');
		});
	}


	if( $('#user_assigned_structure_update').length ){
		$('#user_assigned_structure_update').change(function(){
			var structure = $(this).val();
			// alert(structure);
			assigned_picker(structure, '', 'user_assigned_structure_update', 'user_assigned_id_update');
		});
	}

	function addComment(x) {
		$('#comment_task_id').val(x);
		$('#modal_add_comment').modal('show');
	}

	$('#form_add_comment').on('submit', function(){
		var task_id = $("input#comment_task_id").val();
		$.ajax({
			type: 'POST',
			url : $(this).attr('action'),
			data: $(this).serialize(),
			success: function(res){
				var response = $.parseJSON(res);
				if (response.status=='success') {
					$('#modal_vmr_mrk').modal('hide');
					$('#modal_add_comment').modal('hide');
					show_this(task_id);
					$('#show_komentar').tab('show');
				} else {
					alert(response.status);
				}
			}
		});
		return false;
	});

</script>
