<script type="text/javascript">
    $(document).ready(function() {

        //validasi form insert
        $("#form_profile").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    minlength: 8
                },
                password_confirm: {
                    minlength: 8,
                    equalTo: "#password"
                },
            },
            messages: {
                first_name: {
                    required: "Nama depan harus diisi"
                },
                last_name: {
                    required: "Nama belakang harus diisi"
                },
                email: {
                    required: "Email harus diisi",
                    email: "Format Email salah"
                },
                password: {
                    minlength: "Password minimal {0} karakter",
                },
                password_confirm: {
                    minlength: "Password minimal {0} karakter",
                    minlength: "Konfirmasi password tidak sama"
                }
            },

            submitHandler: function(form) {
                // $('#global_loading').addClass('global_loading');

                block_this('form_profile');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_profile').attr('action'),
                    data  : $('#form_profile').serialize(),
                    success : function(res){
                        // alert('ok');
                        // var response = jQuery.parseJSON(res);
                        // console.log(response.status);

                        // if(response.status=='sukses'){
                            ajax_response_success('Profile berhasil diupdate', 'response_profile');
                        // } else {
                        //     ajax_response_failed(response.msg, 'response_insert');
                        // }


                        // $('#global_loading').removeClass('global_loading');
                        unblock_this('form_profile');

                    }
                });
                return false;
            }
        });

    });

    $(document).ajaxComplete(function() {

    });


</script>
