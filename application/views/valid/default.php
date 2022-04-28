<?php 

//highlight: function(element) {
//  $(element).closest('.form-group').addClass('has-error');
//},
//unhighlight: function(element) {
//  $(element).closest('.form-group').removeClass('has-error');
//},

$js = "errorElement: 'span',";

$js .= "errorPlacement: function(error, element) {
        
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else if (element.is('select')) {
            error.insertAfter(element.siblings(\".chosen-container\"));
        } else if (element.parent('.text-center').length) {
            error.insertAfter($(\"table.table-product-picker\"));

        } else {
            error.insertAfter(element);
        }
    },
ignore: [],";
echo $js;
?>
