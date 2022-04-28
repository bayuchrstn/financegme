<?php

//input text
$this->ui->load_template('form_group_text',
    array(
        'label'         => $this->lang->line('item_name'),
        'id'            => 'name_update',
        'name'          => 'name',
        'class'         => 'form-control',
        'maxlength'     => '200',
    )
    );

//select
$this->ui->load_template('form_group_dropdown',
    array(
        'label'         => $this->lang->line('patient_province'),
        'name'          => 'province',
        'ext'           => 'class="form-control" id="province_insert"',
        'option'        => array(),
    )
    );

//wysiwyg
$this->ui->load_template('form_group_textarea_wysiwyg',
	array(
		'label'         => $this->lang->line('marketing_progress_body'),
		'id'            => 'body_insert',
		'name'          => 'body',
		'class'         => 'cos form-control wysiwyg',
		'maxlength'     => '200',
		'value'			=> ''
	)
    );
