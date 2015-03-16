<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//--------------------------------------------------------------------
if (!function_exists('mis_form_open'))
{
	function mis_form_open($action = '', $attributes = '', $hidden = array(), $title = "", $form_type = '')
	{
		$form_type = _mis_ui_type('box',$form_type);
		$form = '<div class="box '.$form_type.'">
                    <div class="box-header">
                        <h3 class="box-title">'.$title.'</h3>
                    </div>';
        $form .= form_open($action, $attributes, $hidden);
        $form .= '<div class="box-body">';
        return $form;
	}
}
//--------------------------------------------------------------------
if (!function_exists('mis_form_open_multipart'))
{
	function mis_form_open_multipart($action = '', $attributes = array(), $hidden = array(), $title = "", $form_type = '')
	{
		$form_type = _mis_ui_type('box',$form_type);
		$form = '<div class="box '.$form_type.'">
                    <div class="box-header">
                        <h3 class="box-title">'.$title.'</h3>
                    </div>';
        $form .= form_open_multipart($action, $attributes, $hidden);
        $form .= '<div class="box-body">';
        return $form;
	}
}
//--------------------------------------------------------------------
if (!function_exists('mis_mis_form_close'))
{
	function mis_form_close($extra = '')
	{
		$form = '</div>'.form_close($extra).'</div>';
        return $form;
	}
}
//--------------------------------------------------------------------
if (!function_exists('mis_form_submit'))
{
	function mis_form_submit($data = '', $value = '', $extra = '', $ui_type='')
	{
		$ui_type = _mis_ui_type('btn',$ui_type);
		$defaults = array('type' => 'submit', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value, 'class' => 'btn '.$ui_type);
		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}
//--------------------------------------------------------------------
if (!function_exists('mis_form_input'))
{
	function mis_form_input($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		return _mis_form_common('text', $data, $value, $label, $extra, $ui_type);
	}
}
//--------------------------------------------------------------------
if (!function_exists('mis_form_email'))
{
	function mis_form_email($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		return _mis_form_common('email', $data, $value, $label, $extra, $ui_type);
	}
}
//--------------------------------------------------------------------
if (!function_exists('mis_form_password'))
{
	function mis_form_password($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		return _mis_form_common('password', $data, $value, $label, $extra, $ui_type);
	}
}
//--------------------------------------------------------------------
if (!function_exists('mis_form_upload'))
{
	function mis_form_upload($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		return _mis_form_common('file', $data, $value, $label, $extra, $ui_type);
	}
}
//--------------------------------------------------------------------
/*if (!function_exists('mis_form_url'))
{
	function mis_form_url($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		return _mis_form_common('url', $data, $value, $label, $extra, $ui_type);
	}
}
//--------------------------------------------------------------------
if ( ! function_exists('mis_form_telephone'))
{
	function mis_form_telephone($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		return _mis_form_common('tel', $data, $value, $label, $extra, $ui_type);
	}
}
//--------------------------------------------------------------------
if ( ! function_exists('mis_form_number'))
{
	function mis_form_number($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		return _mis_form_common('number', $data, $value, $label, $extra, $ui_type);
	}
}
//--------------------------------------------------------------------
if ( ! function_exists('mis_form_color'))
{
	function mis_form_color($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		return _mis_form_common('color', $data, $value, $label, $extra, $ui_type);
	}
}
//--------------------------------------------------------------------
if ( ! function_exists('mis_form_search'))
{
	function mis_form_search($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		return _mis_form_common('search', $data, $value, $label, $extra, $ui_type);
	}
}
//--------------------------------------------------------------------
if ( ! function_exists('mis_form_date'))
{
	function mis_form_date($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		return _mis_form_common('date', $data, $value, $label, $extra, $ui_type);
	}
}*/
//--------------------------------------------------------------------
if ( ! function_exists('mis_form_multiselect'))
{
	function mis_form_multiselect($name = '', $options = array(), $selected = array(), $extra = '', $label = '')
	{
		$form = '<div class = "form-group">';
		$form .= '<label>'.$label.'</label>';
		$form .= form_multiselect($name, $options, $selected, $extra.' class="form-control"');
		$form .= '</div>';
		return $form;
	}
}
//--------------------------------------------------------------------
if ( ! function_exists('mis_form_dropdown'))
{
	function mis_form_dropdown($name = '', $options = array(), $selected = array(), $extra = '', $label = '')
	{
		$form = '<div class = "form-group">';
		$form .= '<label>'.$label.'</label>';
		$form .= form_dropdown($name, $options, $selected, $extra.' class="form-control"');
		$form .= '</div>';
		return $form;
	}
}
//--------------------------------------------------------------------
if ( ! function_exists('mis_form_checkbox'))
{
	function mis_form_checkbox($data = '', $value = '', $checked = FALSE, $extra = '', $label = '')
	{
		$form = '<div class = "checkbox">';
		$form .= '<label>';
		$form .= form_checkbox($data, $value, $checked, $extra).'
				'.$label.'</label></div>';
		return $form;
	}
}
//--------------------------------------------------------------------
if ( ! function_exists('mis_form_radio'))
{
	function mis_form_radio($data = '', $value = '', $checked = FALSE, $extra = '', $label = '')
	{
		$form = '<div class = "radio">';
		$form .= '<label>';
		$form .= form_radio($data, $value, $checked, $extra).'
				'.$label.'</label></div>';
		return $form;
	}
}
//--------------------------------------------------------------------
if ( ! function_exists('mis_form_label'))
{
	function mis_form_label($label_text = '', $id = '', $attributes = array(), $ui_type = '')
	{
		$form = '<label ';
		$form .= ($id!='')? 'for = "'.$id.'"':'';

		if($ui_type != '')
		{
			$form .= ' class="control-label" >';
			switch(strtolower($ui_type))
			{
				case "success":	$form .= '<i class="fa fa-check"></i>';break;
				case "error":	$form .= '<i class="fa fa-times-circle-o"></i>';break;
				case "warning":	$form .= '<i class="fa fa-warning"></i>';break;
			}
		}
		else
			$form .= '>';
		$form .= $label_text.'</label>';

		return $form;
	}
}
//--------------------------------------------------------------------
if (!function_exists('mis_form_textarea'))
{
	function mis_form_textarea($data='', $value='', $extra='', $label = '',$ui_type='')
	{
		$form = '<div class="form-group ';
		if($ui_type !='')	$form .= 'has-'.strtolower($ui_type);
		$form .= '">';

		$id = (is_array($data) && isset($data['id']))? $data['id']:'';
		if($label != '')
			$form .= mis_form_label($label,$id,'',$ui_type);

		$defaults = array('name' => (( ! is_array($data)) ? $data : ''), 'rows' => '3', 'class' => 'form-control');

		if ( ! is_array($data) OR ! isset($data['value']))
		{
			$val = $value;
		}
		else
		{
			$val = $data['value'];
			unset($data['value']); // textareas don't use the value attribute
		}

		$name = (is_array($data)) ? $data['name'] : $data;
		$form .= "<textarea "._parse_form_attributes($data, $defaults).$extra.">".form_prep($val, $name)."</textarea>";
		$form .= "</div>";

		return $form;
	}
}
//--------------------------------------------------------------------
if (!function_exists('_mis_form_common'))
{
	function _mis_form_common($type='text', $data='', $value='', $label='', $extra='', $ui_type = '')
	{
		$form = '<div class="form-group ';
		if($ui_type !='')	$form .= 'has-'.strtolower($ui_type);
		$form .= '">';

		$id = (is_array($data) && isset($data['id']))? $data['id']:'';
		if($label != '')
			$form .= mis_form_label($label,$id,'',$ui_type);

		$defaults = array('type' => $type, 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value, 'class' => 'form-control');
		$form .= "<input "._parse_form_attributes($data, $defaults).$extra." />";
		$form .= "</div>";

		return $form;
	}
}
//--------------------------------------------------------------------
if (!function_exists('_mis_ui_type'))
{
	function _mis_ui_type($class = '', $type='')
	{
		$type = strtolower($type);
		switch($type)
		{
			case "error" 	: $type = "danger";break;
		}
		if($class != '' && $type !='')	return $class.'-'.$type;
		return $type;
	}
}
/* End of file MY_form_helper.php */
/* Location: ./application/helpers/MY_form_helper.php */
