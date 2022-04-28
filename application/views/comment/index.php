<div id="comment_lists_div">

</div>

<?php
	$prefix = 'comment_insert';
	$default_value = array();
	$default_value['parent'] = $parent;
	$default_value['modul'] = $modul;
	// pre($default_value);
	$forms = $this->ui->forms('comment', $default_value, $prefix);
    echo $forms['comment'];
    echo $forms['parent'];
    echo $forms['modul'];
	// pre($current);
?>

<script type="text/javascript">

    $(document).ready(function(){
		show_lists();
        $("#modal_comment_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                comment: {required: true},
            },

            messages: {
                comment: {required: "Komentar / pesan harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#modal_comment_form').attr('action'),
                    data  : $('#modal_comment_form').serialize(),
                    success : function(res){
                        // var response = jQuery.parseJSON(res);
                        // console.log(response);

                        // if(response.status=='sukses' || response.status=='success'){
                        //     create_alert('msg_alert', response.msg, 'bg-success');
                        // } else {
                        //     create_alert('msg_alert', response.msg, 'bg-danger');
                        // }
                        // $('.modal').modal('hide');
						show_lists();
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

    });

	function show_lists()
	{
		$('#comment_lists_div').load('<?php echo base_url('comment/lists/'.$modul.'/'.$parent); ?>');
	}

</script>
