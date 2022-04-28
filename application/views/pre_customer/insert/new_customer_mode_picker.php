<table id="input_mode_table" class="table table-hover table-striped">
	<tr>
		<td >Existing Customer</td>
		<td class="">
			<input type="text" id="existing_customer_picker_fake" class="typeahead tt-query form-control" autocomplete="off" spellcheck="false" placeholder="cari existing customer">
			<input type="hidden" name="existing_customer_picker" id="existing_customer_picker" value="">
			<?php
			// echo form_dropdown('existing_customer_picker', array(), '', 'class="form-control" id="existing_customer_picker"');
			?>
		</td>
		<td width="5" class="">
			<a onclick="new_customer_mode('existing');" class="btn btn-default" href="javascript:void(0)">Pilih</a>
		</td>
	</tr>
	<tr>
		<td class="border-bottom">Pelanggan Baru</td>
		<td class="border-bottom">&nbsp;</td>
		<td class="border-bottom">
			<a onclick="new_customer_mode('new');" class="btn btn-default" href="javascript:void(0)">Pilih</a>
		</td>
	</tr>
</table>
<script type="text/javascript">
	// set_option('<?php echo base_url(); ?>select_option/usergroup_active', 'existing_customer_picker', 'xxx');
	// $('#existing_customer_picker').html();
	// $.ajax({
	// 	type:'GET',
	// 	url: '<?php echo base_url('select_option/usergroup_active'); ?>',
	// 	success: function(res) {
	// 		$('#existing_customer_picker').html(res);
	// 	}
	// });
</script>

<script type="text/javascript">
	// $(document).ready(function(){
	//     var cars = ['Audi', 'BMW', 'ancok', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen'];
	//     var cars = new Bloodhound({
	//         datumTokenizer: Bloodhound.tokenizers.whitespace,
	//         queryTokenizer: Bloodhound.tokenizers.whitespace,
	//         local: cars
	//     });
	//     $('.typeahead').typeahead({
	//         hint: true,
	//         highlight: true, /* Enable substring highlighting */
	//         minLength: 1 /* Specify minimum characters required for showing result */
	//     },
	//     {
	//         name: 'cars',
	//         source: cars
	//     });
	// });

	// Instantiate the Bloodhound suggestion engine
	var movies = new Bloodhound({
		datumTokenizer: function(datum) {
	    	return Bloodhound.tokenizers.whitespace(datum.value);
	  	},
	  	queryTokenizer: Bloodhound.tokenizers.whitespace,
	  	remote: {
	    	wildcard: '%QUERY',
	    	// url: 'http://api.themoviedb.org/3/search/movie?query=%QUERY&api_key=f22e6ce68f5e5002e71c20bcba477e7d',
	    	url: '<?php echo base_url();?>xhr/customer/typeahead_all/%QUERY',
	    	// transform: function(response) {
	     //  		return $.map(response.results, function(movie) {
		    //     	return {
		    //       		value: movie.original_title
		    //     	};
	     //  		});
	    	// }
	  	}
	});

	// Instantiate the Typeahead UI
	$('.typeahead').typeahead(null, {
	  display: 'name',
	  source: movies
	});

	$('.typeahead').bind('typeahead:select', function(ev, suggestion) {
	        console.log(suggestion);
			$('#existing_customer_picker').val(suggestion.id);
	});
</script>
