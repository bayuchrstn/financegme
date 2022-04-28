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
