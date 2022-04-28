<script type="text/javascript">
	$(document).ready(function(){

		//input pre_customer
		$("#form_marketing_progress_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                subject: {required: true},
                body_fake: {required: true},
                location_id: {required: true},
                category: {required: true},
            },

            messages: {
                subject: {required: "Judul harus diisi"},
                body_fake: {required: "isi harus diisi"},
                location_id: {required: "Pelanggan harus dipilih"},
                category: {required: "Kategori harus dipilih"},
            },

            submitHandler: function(form) {
                block_this('form_marketing_progress_insert');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_marketing_progress_insert').attr('action'),
                    data  : $('#form_marketing_progress_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						$('#js_table_marketing_progress').DataTable().ajax.reload( null, false );
						$('.modal').modal('hide');
                        unblock_this('form_marketing_progress_insert');
                    },
                    error: function (e, status) {
                        unblock_this('form_marketing_progress_insert');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		//input pre_customer
		$("#form_marketing_progress_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                subject: {required: true},
                body_fake: {required: true},
            },

            messages: {
                subject: {required: "Judul harus diisi"},
                body_fake: {required: "isi harus diisi"},
            },

            submitHandler: function(form) {
                block_this('form_marketing_progress_update');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_marketing_progress_update').attr('action'),
                    data  : $('#form_marketing_progress_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						// console.log(response);
						$('#js_table_marketing_progress').DataTable().ajax.reload( null, false );
						$('.modal').modal('hide');
                        unblock_this('form_marketing_progress_update');
                    },
                    error: function (e, status) {
                        unblock_this('form_marketing_progress_update');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

	});
</script>
<?php
    //insert
    // $arr_insert = array();
    // $arr_insert['form_id'] = 'form_marketing_progress_insert';
    // $arr_insert['div_loader'] = 'form_marketing_progress_insert';
    // $arr_insert['console_log'] = 'no';
    // $arr_insert['alert'] = 'alert_modal_insert';
    // $arr_insert['cos'] = 'yes';
    // $arr_insert['datatables_reload'] = 'js_table_marketing_progress';
    // $arr_insert['hide_modal'] = 'no';
    // $arr_insert['rules'] = array(
    //     'subject'             					=> array('required' => 'true'),
    // );
    // $arr_insert['messages'] = array(
    //     'subject'            					 => array('required' => $this->lang->line('marketing_progress_subject_required')),
    // );
    // echo $this->ui->load_template('validation',$arr_insert);

    //update
    $arr_update = array();
    $arr_update['form_id'] = 'form_marketing_progress_update';
    $arr_update['div_loader'] = 'form_marketing_progress_update';
    $arr_insert['console_log'] = 'yes';
    $arr_update['alert'] = 'alert_modal_update';
    $arr_update['cos'] = 'no';
    $arr_update['datatables_reload'] = 'js_table_marketing_progress';
    $arr_update['hide_modal'] = 'no';
    $arr_insert['rules'] = array(
        'marketing_progress_name'             => array('required' => 'true'),
        'marketing_progress_address'          => array('required' => 'true'),
        'marketing_progress_telephone'        => array('required' => 'true'),
    );
    $arr_insert['messages'] = array(
        'marketing_progress_name'             => array('required' => $this->lang->line('marketing_progress_name_required')),
        'marketing_progress_address'          => array('required' => $this->lang->line('marketing_progress_address_required')),
        'marketing_progress_telephone'         => array('required' => $this->lang->line('marketing_progress_telephone_required')),
    );
    echo $this->ui->load_template('validation',$arr_update);

    //delete
    $arr_delete = array();
    $arr_delete['form_id'] = 'form_marketing_progress_delete';
    $arr_delete['div_loader'] = 'form_marketing_progress_delete';
    $arr_delete['console_log'] = 'yes';
    $arr_delete['alert'] = 'yes';
    $arr_delete['cos'] = 'yes';
    $arr_delete['datatables_reload'] = 'js_table_marketing_progress';
    $arr_delete['hide_modal'] = 'yes';
    $arr_delete['rules'] = array(
        'id'          => array('required' => 'true'),
    );
    // pre($arr_marketing_progress);
    echo $this->ui->load_template('validation',$arr_delete);
?>
