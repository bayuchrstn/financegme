<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Upload Dropbox</title>
        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <link rel="author" href="humans.txt">
    </head>
    <body>
    	<form method="post" enctype="multipart/form-data" action="upload_file.php" target="_blank" id="my-form">
    		<input type="text" name="path" placeholder="Path file" id="path">
            <input type="hidden" name="code" value="apaseh">
			<input type="file" name="file_gambar" id="file_gambar" onchange="upload_file('my-form','file_gambar');" /><br />
            <span id="status_upload"></span>
			<!-- <input type="submit" value="Send" /> -->
		</form>
        <img id="image-prev" src="#" alt="">
        <script src="../assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            function upload_file(form_id, input_id) {
                var form = $('#'+form_id);
                var input = $('#'+input_id);

                var file_data = input.prop('files')[0];
                var form_data = new FormData(); 
                form_data.append('path', $('input#path').val() );
                form_data.append(input_id, file_data);

                $.ajax({
                    type: 'POST',
                    data: form_data,
                    url : form.attr('action'),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response){
                        // var response = $.parseJSON(res);
                        $('#status_upload').empty().append(response.url);
                        get_thumbnail(response.path, "image-prev");
                    }
                });
            }

            function get_thumbnail(path, image_id){
                var action = "get_thumbnail.php"
                $.ajax({
                    type: 'POST',
                    data: {path : path},
                    url : action,
                    success: function(response){
                        $('#'+image_id).attr('src',response);
                    }
                });
            }
        </script>
    </body>
</html>