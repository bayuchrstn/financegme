<?php
class ui
{
    function __construct($options = null)
    {
        $this->CI = &get_instance();
    }

    function forms_debug($forms)
    {
        // pre($forms);
        $arr = array();
        if (!empty($forms)) :
            foreach ($forms as $key => $val) :
                $arr[] = $key;
            endforeach;
        endif;
        return $arr;
    }

    // function js_group($group_name)
    function js_include($group_name)
    {
        $opt = '';
        switch ($group_name) {
            case 'google_maps':
                /*
                // $opt .= '<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>';
				*/
                $opt .= '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB85LW4GPO1MHcr0ovrpKW6gcxY_FmE3Bw&libraries=places"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/place.min.js"></script>';
                break;

            case 'bootstrap_multiselect':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/uniform.min.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/bootstrap_multiselect.js"></script>';
                break;

            case 'typeahead':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/typeahead.bundle.js"></script>';
                break;

            case 'ajax_upload':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.ui.widget.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.iframe-transport.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.fileupload.js"></script>';
                break;

            case 'password_meter':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.pwstrength.js"></script>';
                break;

            case 'wysiwyg':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/tinymce/tinymce.min.js?cachebuster=' . rand(1, 10) . '"></script>';
                break;

            case 'mask_money':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.maskMoney.min.js"></script>';
                break;

            case 'rating':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/rating/jquery.barrating.min.js"></script>';
                break;

            case 'jquery_ui':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>';
                break;

            case 'jquery_tree':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.tree.js"></script>';
                break;

            case 'chosen':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/chosen.jquery.min.js"></script>';
                break;

            case 'time_picker':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery-ui-timepicker-addon.js"></script>';
                break;

            case 'datatables_sorter':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatables/extensions/row_reorder.min.js"></script>';
                break;

            case 'datatables_key_table':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatables/extensions/key_table.min.js"></script>';
                break;

            case 'nofak':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/nofak.js"></script>';
                break;

            case 'uploadfaktur':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/uploadfaktur.js"></script>';
                break;

            case 'masonry':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/masonry.pkgd.min.js"></script>';
                break;

            case 'jmd':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.modal.js"></script>';
                break;

            case 'ctiga':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/d3.min.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/c3.min.js"></script>';
                break;

            case 'chartjs':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/chartjs/Chart.min.js"></script>';
                break;

            case 'editable':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/editable.min.js"></script>';
                break;

            case 'tablecheckbox':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatable/dataTables.checkboxes.min.js"></script>';
                break;

            case 'fullcalendar':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/moment/moment.min.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/fullcalendar/fullcalendar.min.js"></script>';
                break;

            case 'flexigridMaster':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/flexigridMaster/js/flexigrid.js"></script>';
                break;

            case 'custom_page':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/custom_page.js?x=1.14"></script>';
                break;

            case 'select2':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/select2.min.js"></script>';
                break;

            case 'toastr':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/toastr/toastr.min.js"></script>';
                break;

            case 'dt_fixed_columns':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatables/extensions/dataTables.fixedColumns.min.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatable/dataTables.colResize.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatable/dataTables.colReorder.js"></script>';
                break;
            case 'datatable_checkbox':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatables/dataTables.checkboxes.min.js"></script>';
                break;
            case 'datatable_lama':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatable/datatables.min.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatable/ColReorderWithResize.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatable/dataTables.fixedHeader.min.js"></script>';
                break;
            case 'datatable_complete':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatable/jquery.dataTables.min.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatable/dataTables.colResize.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatable/dataTables.colReorder.min.js"></script>';
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatable/dataTables.fixedColumns.min.js"></script>';
                break;
            case 'jszip':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatables/extensions/jszip/jszip.min.js"></script>';
                break;

            case 'pdfmake':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatables/extensions/pdfmake/pdfmake.min.js"></script>';
                break;

            case 'vfs_fonts':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>';
                break;

            case 'buttons':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/datatables/extensions/buttons.min.js"></script>';
                break;

            case 'form_select2':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/form_select2.js"></script>';
                break;
            case 'bootstrap-toggle':
                $opt .= '<script type="text/javascript" src="' . base_url() . 'assets/js/bootstrap-toggle.min.js"></script>';
                break;

            default:
                $opt = '';
                break;
        }
        return $opt;
    }

    function load_css($group_name)
    {
        $opt = '';
        switch ($group_name) {
            case 'password_meter':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/password_indicator.css"></link>';
                break;
            case 'datatable_css':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/invoice/vendors/datatables/plugins/bootstrap/dataTables.bootstrap.css"></link>';
                break;
            case 'datatable_checkbox':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/datatables/dataTables.checkboxes.css"></link>';
                break;
            case 'datatable_complete_css':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/datatable/jquery.dataTables.min.css"></link>';
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/datatable/dataTables.colResize.css"></link>';
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/datatable/fixedColumns.dataTables.min.css"></link>';
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/datatable/colReorder.dataTables.min.css"></link>';
                break;
            case 'datatable_reorder':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/datatable/colReorder.dataTables.min.css"></link>';
                break;
            case 'datatable_resize':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/datatable/dataTables.colResize.css"></link>';
                break;
            case 'tablecheckbox':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/datatable/dataTables.checkboxes.css"></link>';
                break;
            case 'rating':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/rating/themes/bootstrap-stars.css"></link>';
                break;

            case 'jquery_ui':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/jquery-ui-1.11.4/jquery-ui.css?x=1804111004"></link>';
                break;

            case 'jquery_tree':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/jquery.tree.css"></link>';
                break;

            case 'toastr':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/toastr/toastr.min.css"></link>';
                break;

            case 'chosen':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/chosen.css"></link>';
                break;

            case 'time_picker':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/jquery-ui-timepicker-addon.css"></link>';
                break;

            case 'flexigridMaster':
                $opt .= '<link href="' . base_url() . 'assets/js/flexigridMaster/css/flexigrid.css?x=11111111111111111" rel="stylesheet" type="text/css">';
                break;

            case 'MaterialIcons':
                $opt .= '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">';
                break;

            case 'custom_page':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/custom_page.css?x=1.15">';
                break;
            case 'bootstrap-toggle':
                $opt .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/js/bootstrap-toggle.min.css">';
                break;

            default:
                $opt = '';
                break;
        }
        return $opt;
    }

    function load_template($template_name = '', $arr = '')
    {
        switch ($template_code):
            default:
                $res_view = $this->CI->load->view('flat/ui/' . $template_name, $arr, TRUE);
        endswitch;
        return $res_view;
    }

    function load_component($options)
    {
        // pre($options);
        $component = $this->CI->load->view($options['component'], $options, TRUE);
        return $component;
    }

    function load_form_element_by_modul($modul, $default_value = array())
    {
        return $this->CI->form_element->get_by_modul($modul, $default_value);
    }

    function forms($modul, $default_value = array(), $prefix = '')
    {
        return $this->CI->form_element->forms($modul, $default_value, $prefix);
    }

    function forms_by_section($modul, $section, $default_value = array(), $prefix = '')
    {
        return $this->CI->form_element->forms_by_section($modul, $section, $default_value, $prefix);
    }

    function load_form_element_by_section($modul, $section, $default_value = array())
    {
        return $this->CI->form_element->get_by_section($modul, $section, $default_value);
    }

    function hook_this_array($arr)
    {
        if (!empty($arr)) :
            foreach ($arr as $input) :
                echo $input;
            endforeach;
        endif;
    }

    function var_this_array($arr)
    {
        $html = '';
        if (!empty($arr)) :
            foreach ($arr as $input) :
                $html .= $input;
            endforeach;
        endif;
        return $html;
    }
}
