<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//--------------------------------------------------------------------
if (!function_exists('mis_div_row_open'))
{
	function mis_div_row_open()
	{
		$div = '<div class="row">';
        return $div;
	}
}
//--------------------------------------------------------------------
if (!function_exists('mis_div_col_open'))
{
    function mis_div_col_open($col = 6, $type = 'md')
    {
        $div = '<div class="col-'.$type.'-'.$col.'">';
        return $div;
    }
}
//--------------------------------------------------------------------
if (!function_exists('mis_div_close'))
{
    function mis_div_close()
    {
        return '</div>';
    }
}
//--------------------------------------------------------------------
if (!function_exists('mis_box_open'))
{
    function mis_box_open($title = '', $type = '', $class = '')
    {
        $box_type = _mis_ui_type('box',$type);
        $box = '<div class="box '.$box_type.' '.$class.'">
                    <div class="box-header">
                        <h3 class="box-title">'.$title.'</h3>
                    </div>';
        $box .= '<div class="box-body">';
        return $box;
    }
}
//--------------------------------------------------------------------
if (!function_exists('mis_box_close'))
{
    function mis_box_close()
    {
        return '</div></div>';
    }
}
//--------------------------------------------------------------------
if (!function_exists('mis_table_open'))
{
    function mis_table_open($type = '')
    {
        //type = striped,condensed,bordered,hover
        $table = '<table class = "table';
        if($type != '')   $table .= ' table-'.$type;
        $table .= '">';
        return $table;
    }
}
//--------------------------------------------------------------------
if (!function_exists('mis_table_close'))
{
    function mis_table_close()
    {
        return '</table>';
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
            case "error"    : $type = "danger";break;
        }
        if($class != '' && $type !='')  return $class.'-'.$type;
        return $type;
    }
}