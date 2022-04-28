<?php
class Model_actionform extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function basic($form_action='', $hidden_form=array(), $button_label='Submit', $button_class="btn btn-default", $button_icon="icon-chevron-right")
    {
        // pre($hidden_form);
        $action = '<form class="action_form" action="'.$form_action.'" method="post">';
        if(!empty($hidden_form)):
            foreach($hidden_form as $hidden=>$val):
                $action .= '<input type="hidden" name="'.$hidden.'" value="'.$val.'" >';
            endforeach;
        endif;
        $action .= '<button class="'.$button_class.'" type="submit"><i class="'.$button_icon.'"></i> '.$button_label.'</button>';
        $action .= '</form>';
        return $action;
    }

    function dropdown($hidden_form=array())
    {
        $action = '<ul class="icons-list">';
        $action .= '<li class="dropdown">';
        $action .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>';
        $action .= '<ul class="dropdown-menu dropdown-menu-right">';
            // loping
            if(!empty($hidden_form)):
                foreach($hidden_form as $hidden):
                    $action .= '<li>';
                    $action .= '<a '.$hidden['more'].' href="'.$hidden['url'].'"><i class="'.$hidden['icon'].'"></i> '.$hidden['label'].'</a>';
                    $action .= '</li>';
                endforeach;
            endif;
            // loping

        $action .= '</ul>';
        $action .= '</li>';
        $action .= '</ul>';
        return $action;
    }

    function button_link($hidden_form=array())
    {
        // loping
        $action = '';
        if(!empty($hidden_form)):
            foreach($hidden_form as $hidden):
                $action .= '<a style="margin:0 2px;" '.$hidden['more'].' href="'.$hidden['url'].'" title="'.$hidden['label'].'"><i class="'.$hidden['icon'].'"></i></a>';
            endforeach;
        endif;
        // loping
        return $action;
    }

}
