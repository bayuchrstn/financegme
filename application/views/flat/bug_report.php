<?php
    $arr = array();
    $arr['modal_icon'] = 'icon-bug2';
    $arr['modal_id'] = 'modal_bug';
    $arr['modal_title'] = 'Bug Report';
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';

	$main = array(
		'<p class="alert alert-styled-left bg-success">Gunakan form berikut untuk melaporkan Kesalahan / Error pada Aplikasi ini </p>',
		$this->ui->load_template('form_group_dropdown',
		    array(
		        'label'         => 'Kategori',
		        'name'          => 'kategori',
		        'ext'           => 'class="form-control chosen" id="kategori_bug"',
		        'option'        => array(
					'error'		=> 'Error',
					'request'		=> 'Request',
				),
		    )
		),
		$this->ui->load_template('form_group_text',
		    array(
		        'label'         => 'Subject / Judul',
		        'id'            => 'subject_bug',
		        'name'          => 'subject_bug',
		        'class'         => 'form-control',
		        'maxlength'     => '',
				'value'			=> ''
		    )
		),
		$this->ui->load_template('form_group_text',
		    array(
		        'label'         => 'URL Error',
		        'id'            => 'url_bug',
		        'name'          => 'url_bug',
		        'class'         => 'form-control',
		        'maxlength'     => '',
				'value'			=> ''
		    )
		),
		$this->ui->load_template('form_group_textarea_wysiwyg',
			array(
				'label'         => 'Catatan',
				'id'            => 'note_bug',
				'name'          => 'note_bug',
				'class'         => 'cos form-control wysiwyg',
				'maxlength'     => '200',
				'value'			=> ''
			)
		),
		$this->ui->load_template('form_group_dropdown',
		    array(
		        'label'         => 'Status',
		        'name'          => 'status',
		        'ext'           => 'class="form-control chosen" id="kategori_bug"',
		        'option'        => array(
					'urgent'		=> 'Urgent',
					'medium'		=> 'Medium',
				),
		    )
		),
		'<div class="uploader"><input class="file-styled" type="file"><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action btn btn-default legitRipple" style="-moz-user-select: none;">Choose File</span></div>'
	);

	$main_cont = '';
	foreach($main as $row):
		$main_cont .= $row;
	endforeach;

	$arr['main_content'] = $main_cont;

    echo $this->ui->load_template('modal_default', $arr, TRUE);
?>
