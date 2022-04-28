<?php
class Model_form_element extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function forms($modul='', $default_value=array(), $prefix='')
    {
		$arr = array();
		$this->db->order_by('sort', 'asc');
        $this->db->where('modul', $modul);
        $this->db->where('status', 'active');
        $forms = $this->db->get('form')->result_array();
		// pre($forms);
		if(!empty($forms)):
			foreach($forms as $form):
				// pre($form);
				$arr[$form['form_name']] = $this->build_params($form, $default_value, $prefix);
			endforeach;
		endif;
		// pre($arr);
        return $arr;
    }

    function forms_by_section($modul='', $section, $default_value=array(), $prefix='')
    {
		$arr = array();
		$this->db->order_by('sort', 'asc');
        $this->db->where('modul', $modul);
        $this->db->where('section', $section);
        $this->db->where('status', 'active');
        $forms = $this->db->get('form')->result_array();
		// pre($this->db->last_query());
		if(!empty($forms)):
			foreach($forms as $form):
				// pre($form);
				$arr[$form['form_name']] = $this->build_params($form, $default_value, $prefix);
			endforeach;
		endif;
		// pre($arr);
        return $arr;
    }

    function get_by_modul($modul='', $default_value=array(), $prefix)
    {
		$arr = array();
		$this->db->order_by('sort', 'asc');
        $this->db->where('modul', $modul);
        $this->db->where('status', 'active');
        $forms = $this->db->get('form')->result_array();
		// pre($forms);
		if(!empty($forms)):
			foreach($forms as $form):
				// pre($form);
				$arr[] = $this->build_params($form, $default_value, $prefix);
			endforeach;
		endif;
		// pre($arr);
        return $arr;
    }

	function get_by_section($modul='', $section='', $default_value=array())
    {
		$arr = array();
		$this->db->order_by('sort', 'asc');
        $this->db->where('modul', $modul);
        $this->db->where('section', $section);
        $this->db->where('status', 'active');
        $forms = $this->db->get('form')->result_array();
		// pre($forms);
		if(!empty($forms)):
			foreach($forms as $form):
				// pre($form);
				$arr[] = $this->build_params($form, $default_value);
			endforeach;
		endif;
		// pre($arr);
        return $arr;
    }

	function get_by_id($modul='', $section='', $id='', $default_value=array())
    {
		$arr = array();
		$this->db->order_by('sort', 'asc');
        $this->db->where('modul', $modul);
        $this->db->where('section', $section);
        $this->db->where('form_id', $id);
        $this->db->where('status', 'active');
        $form = $this->db->get('form')->row_array();
        return $this->build_params($form, $default_value);
    }

	function build_params($form_params, $default_value, $prefix='')
	{
		// pre($default_value);
		switch ($form_params['view']) {

			//input text
			case 'component/form/input_text':
				$format_value = ($form_params['form_value']=='') ? '' : ( isset($default_value[ $form_params['form_value']]) && $default_value[ $form_params['form_value']] !='' ) ? $default_value[ $form_params['form_value']] : $form_params['form_value'];
				$final_params = array(
					'label'         => ($this->lang->line($form_params['form_label'])!='') ? $this->lang->line($form_params['form_label']) : $form_params['form_label'],
					'id'            => ($form_params['form_id'] !='') ? $form_params['form_id'].'_'.$prefix : $form_params['form_name'].'_'.$prefix,
					'name'          => $form_params['form_name'],
					'class'         => $form_params['form_class'],
					'maxlength'     => $form_params['maxlength'],
					'readonly'     	=> $form_params['readonly'],
					'form_ext'     	=> $form_params['form_ext'],
					'value'     	=> $format_value
				);
				$opt_form = $this->load->view($form_params['view'], $final_params, TRUE);
			break;

			//password
			case 'component/form/password':
				$final_params = array(
					'label'         => ($this->lang->line($form_params['form_label'])!='') ? $this->lang->line($form_params['form_label']) : $form_params['form_label'],
					'id'            => ($form_params['form_id'] !='') ? $form_params['form_id'].'_'.$prefix : $form_params['form_name'].'_'.$prefix,
					'name'          => $form_params['form_name'],
					'class'         => $form_params['form_class'],
					'maxlength'     => $form_params['maxlength'],
				);
				$opt_form = $this->load->view($form_params['view'], $final_params, TRUE);
			break;

			//textarea
			case 'component/form/textarea':
				$format_value = ($form_params['form_value']=='') ? '' : ( isset($default_value[ $form_params['form_value']]) && $default_value[ $form_params['form_value']] !='' ) ? $default_value[$form_params['form_value']] : $form_params['form_value'];
				$final_params = array(
					'name'          => $form_params['form_name'],
					'label'         => ($this->lang->line($form_params['form_label'])!='') ? $this->lang->line($form_params['form_label']) : $form_params['form_label'],
					'class'         => $form_params['form_class'],
					'id'            => ($form_params['form_id'] !='') ? $form_params['form_id'].'_'.$prefix : $form_params['form_name'].'_'.$prefix,
					'value'     	=> $format_value
				);
				$opt_form = $this->load->view($form_params['view'], $final_params, TRUE);
			break;

			//textarea wysiwyg
			case 'component/form/wysiwyg':
				$format_value = ($form_params['form_value']=='') ? '' : ( isset($default_value[ $form_params['form_value']]) && $default_value[ $form_params['form_value']] !='' ) ? $default_value[$form_params['form_value']] : $form_params['form_value'];
				$final_params = array(
					'name'          => $form_params['form_name'],
					'label'         => ($this->lang->line($form_params['form_label'])!='') ? $this->lang->line($form_params['form_label']) : $form_params['form_label'],
					'class'         => $form_params['form_class'],
                    'id'            => ($form_params['form_id'] !='') ? $form_params['form_id'].'_'.$prefix : $form_params['form_name'].'_'.$prefix,
                    'value'     	=> $format_value,
                    'prefix'     	=> $prefix
                );
				$opt_form = $this->load->view($form_params['view'], $final_params, TRUE);
			break;

			//selectbox
			case 'component/form/select_box':
				if( isset($default_value[$form_params['option']]) && !empty($default_value[$form_params['option']]) ):
					$option = $default_value[$form_params['option']];
				else:
					$option = array();
				endif;

				if($form_params['form_id'] !=''):
					$ext_id = ' id="'.$form_params['form_id'].'_'.$prefix.'"';
				else:
					$ext_id = '';
				endif;

				if($form_params['form_class'] !=''):
					$ext_class = ' class="'.$form_params['form_class'].'"';
				else:
					$ext_class = '';
				endif;

				if($form_params['multiple'] !=''):
					$ext_multiple = ' multiple';
					$name_array = '[]';
				else:
					$ext_multiple = '';
					$name_array = '';
				endif;

				$final_params = array(
					'name'          => $form_params['form_name'].$name_array,
					'label'         => ($this->lang->line($form_params['form_label'])!='') ? $this->lang->line($form_params['form_label']) : $form_params['form_label'],
					'ext'         	=> $form_params['form_ext'].$ext_id.$ext_class.$ext_multiple,
					'selected'      => $form_params['selected'],
					'option'     	=> $option
				);
				$opt_form = $this->load->view($form_params['view'], $final_params, TRUE);
			break;

			//hidden
			case 'component/form/hidden':
				$final_params = array(
					'name'          => $form_params['form_name'],
					'id'            => ($form_params['form_id'] !='') ? $form_params['form_id'].'_'.$prefix : $form_params['form_name'].'_'.$prefix,
					'value'         => ( isset($default_value[ $form_params['form_value']]) && $default_value[ $form_params['form_value']] !='' ) ? $default_value[ $form_params['form_value']] : $form_params['form_value'],
				);
				$opt_form = $this->load->view($form_params['view'], $final_params, TRUE);
			break;

			//checkbox
			case 'component/form/checkbox':
				$final_params = array(
					'id'            => ($form_params['form_id'] !='') ? $form_params['form_id'].'_'.$prefix : $form_params['form_name'].'_'.$prefix,
					'class'         => $form_params['form_class'],
					'name'          => $form_params['form_name'],
					'value'         => ( isset($default_value[ $form_params['form_value']]) && $default_value[ $form_params['form_value']] !='' ) ? $default_value[ $form_params['form_value']] : $form_params['form_value'],
					'label'         => ($this->lang->line($form_params['form_label'])!='') ? $this->lang->line($form_params['form_label']) : $form_params['form_label'],
				);
				$opt_form = $this->load->view($form_params['view'], $final_params, TRUE);
			break;

			//uploader
			case 'component/form/uploader':
				$final_params = array(
					'id'            => ($form_params['form_id'] !='') ? $form_params['form_id'].'_'.$prefix : $form_params['form_name'].'_'.$prefix,
					'name'          => $form_params['form_name'],
					'label'         => ($this->lang->line($form_params['form_label'])!='') ? $this->lang->line($form_params['form_label']) : $form_params['form_label'],
					'multiple'      => $form_params['multiple'],
					'prefix'        => $prefix,
				);
				$opt_form = $this->load->view($form_params['view'], $final_params, TRUE);
			break;


			/// yang dibawah ini nantinya gak dipakai mulai di konversi pakai kode yang diatas
			//hidden
			case 'hidden':
				$final_params = array(
                    'id'            => $form_params['form_id'],
                    'name'          => $form_params['form_name'],
                    'value'         => ( isset($default_value[ $form_params['form_value']]) && $default_value[ $form_params['form_value']] !='' ) ? $default_value[ $form_params['form_value']] : $form_params['form_value'],
                );
				$opt_form = $this->load->view('flat/ui/'.$form_params['view'], $final_params, TRUE);
			break;

			//select / dropdown
			case 'form_group_dropdown':
				if( isset($default_value[$form_params['option']]) && !empty($default_value[$form_params['option']]) ):
					$option = $default_value[$form_params['option']];
				else:
					$option = array();
				endif;

				$final_params = array(
                    'label'         => $form_params['form_label'],
                    'name'          => $form_params['form_name'],
                    'ext'          	=> $form_params['form_ext'],
                    'selected'      => $form_params['selected'],
                    'option'        => $option
                );
				$opt_form = $this->load->view('flat/ui/'.$form_params['view'], $final_params, TRUE);
			break;

			//input text
			default:
				$format_value = ($form_params['form_value']=='') ? '' : ( isset($default_value[ $form_params['form_value']]) && $default_value[ $form_params['form_value']] !='' ) ? $default_value[ $form_params['form_value']] : $form_params['form_value'];
				$final_params = array(
                    'label'         => $this->lang->line($form_params['form_label']),
                    'id'            => $form_params['form_id'],
                    'name'          => $form_params['form_name'],
                    'class'         => $form_params['form_class'],
                    'maxlength'     => $form_params['maxlength'],
                    'value'     	=> $format_value
                );
				$opt_form = $this->load->view('flat/ui/'.$form_params['view'], $final_params, TRUE);
			break;
		}
		return $opt_form;
	}




}
