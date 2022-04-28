function show_alert(title="Kosong", content="Sample",icon="",href="https://www.google.com") {
	Push.create(title, {
	    body: content,
	    icon: icon,
	    // timeout: 400
	    onClick: function () {
	        location.href = href;
	        // window.focus();
	        this.close();
	    }
	});
}