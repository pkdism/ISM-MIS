<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UI {
	function row()		{	return new Row();		}
	function col()		{	return new Column();	}
	function box()		{	return new Box();		}
	function tabBox()	{	return new TabBox();	}
	function tabPane()	{	return new TabPane();	}
	function table()	{	return new Table();		}
	function form()		{	return new Form();		}
	function input()	{	return new Input();		}
	function radio()	{	return new Radio();		}
	function checkbox()	{	return new Checkbox();	}
	function textarea()	{	return new Textarea();	}
	function select()	{	return new Select();	}
	function option()	{	return new Option();	}
	function button()	{	return new Button();	}
	function printButton()	{	return new PrintButton();	}
	function alert()	{	return new Alert();		}
	function callout()	{	return new Callout();	}
	function label()	{	return new Label();		}
	function icon($t)	{	return new Icon($t);		}
	function datePicker()	{	return new DatePicker();	}
	function imagePicker()	{	return new ImagePicker();	}
	function slider()	{	return new Slider();	}
}











class Element {
    protected $properties = array(
					'id'		=>	'' ,
					'name'		=>	'' ,
					'value' 	=>	'' ,
					'class' 	=>	'' ,
					'disabled'	=>	'' ,
					'extras' 	=>	'' );

    protected $containerProps = array(
					'class' 	=> '',
					'extras' 	=> '',
					'style'		=> '',
					'id'		=> ''
					);

	var $width = 0;
	var $t_width = 0;
	var $m_width = 0;
	var $ld_width = 0;

	public function __construct() {
		$this->properties['id'] = md5(uniqid(rand(), true));
	}

	function id( $id = '' ) {
		$this->properties['id'] = $id;
		return $this;
	}

	function containerId( $id = '' ) {
		$this->containerProps['id'] = $id;
		return $this;
	}

	function name( $name = '' ) {
		$this->properties['name'] = $name;
		return $this;
	}

	function value( $value = '' ) {
		$this->properties['value'] = $value;
		return $this;
	}

	function classes( $classes = '' ) {
		$this->properties['class'] .= ($this->properties['class'] == '')?	$classes:' '.$classes;
		return $this;
	}

	function containerClasses( $classes = '' ) {
		$this->containerProps['class'] .= ($this->containerProps['class'] == '')?	$classes: ' '.$classes;
		return $this;
	}

	function width($w = 6) {
		//desktop width..........(md)
		$this->width = $w;

		// Temporarily setting large width equal to the width
		$this->ld_width = $w;
		return $this;
	}

	function t_width($w = 6) {
		//tablet width...........(sm)
		$this->t_width = $w;
		return $this;
	}

	function m_width($w = 6) {
		//mobile width...........(xs)
		$this->m_width = $w;
		return $this;
	}

	function ld_width($w = 6) {
		//large desktop width....(lg)
		$this->ld_width = $w;
		return $this;
	}

	function style( $style = '' ) {
		$style .= ($style[strlen($style)-1] == ';')?	'':';';
		$this->containerProps['style'] .= $style;
		return $this;
	}

	function disabled( $disabled = true ) {
		$this->properties['disabled'] = ($disabled)? 'disabled':'';
		return $this;
	}

	function extras( $extras = '' ) {
		$this->properties['extras'] .= ($this->properties['extras'] == '')?	$extras:' '.$extras;
		return $this;
	}

	function containerExtras( $extras = '' ) {
		$this->containerProps['extras'] .= ($this->containerProps['extras'] == '')?	$extras:' '.$extras;
		return $this;
	}
	
	function noPrint() {
		$this->containerClasses("no-print");
		return $this;
	}

	protected function _parse_attributes() {
		$att = '';
		foreach ($this->properties as $key => $val) {
			if($key == 'extras')
				$att .= $val . ' ';
			else if($val != '')
				$att .= $key . '="'. $val . '" ';
		}

		return $att;
	}

	protected function _parse_container_attributes() {
		$att = '';

		if($this->width > 0)	$this->containerClasses('col-md-' . $this->width);
		if($this->t_width > 0)	$this->containerClasses('col-sm-' . $this->t_width);
		if($this->m_width > 0)	$this->containerClasses('col-xs-' . $this->m_width);
		if($this->ld_width > 0)	$this->containerClasses('col-lg-' . $this->ld_width);

		foreach ($this->containerProps as $key => $val) {
			if($key == 'extras')
				$att .= $val . ' ';
			else if($val != '')
				$att .= $key . '="'. $val . '" ';
		}

		return $att;
	}

}













class Row extends Element {

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Row Class Initialized");
	}

	function open() {
		// Adding UI class row to the div element.
		$this->containerClasses('row');
		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>';
        return $this;
	}

	function close() {
		echo '</div>';
	}
}










class Column extends Element {

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Column Class Initialized");
		$this->width = 12;
		$this->m_width = 12;
		$this->t_width = 12;
		$this->ld_width = 12;
	}

	function open() {
		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>';
        return $this;
	}

	function close() {
		echo '</div>';
	}
}









class Box extends Element {

	var $title = '';
	var $uiType = '';
	var $solid = false;
	var $background = '';
	var $icon = null;
	var $tooltip = '';

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Box Class Initialized");
		$this->containerClasses('box');
	}

	function uiType($uiType = '') {
		//uiType ..... (primary/success/warning/danger/info)
		$this->containerClasses('box-'.$uiType);
		return $this;
	}

	function solid($solid = true) {
		$this->containerClasses('box-solid');
		return $this;
	}

	function background($background = '') {
		$this->containerClasses('bg-' . $background);
		return $this;
	}

	function title($title = '') {
		$this->title = $title;
		return $this;
	}

	function icon($icon) {
		$this->icon = $icon;
		return $this;
	}

	function tooltip($tooltip = "") {
		$this->tooltip = $tooltip;
		return $this;
	}


	function open() {
		$tooltipAttr = ($this->tooltip != '')? 'data-toggle="tooltip" data-original-title="'.$this->tooltip.'"': "";
		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>';		
			if($this->icon || $this->title != '') {
				echo '<div class="box-header" '.$tooltipAttr.'>';
					if($this->icon) $this->icon->show();
					if($this->title != '') echo '<h3 class="box-title">'.$this->title.'</h3>';
				echo '</div>';
			}
        echo '<div class="box-body">';
        return $this;
	}

	function close() {
		echo '</div></div>';
	}
}






class TabBox extends Box {

	var $tabs = array();
	var $activeId = '';

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Box Class Initialized");
		$this->containerProps['class'] = '';
		$this->containerClasses('nav-tabs-custom');
	}

	function tab($id, $title, $active = false) {
		$this->tabs[] = array('id' => $id, 'title' => $title);
		if($active) $this->activeId = $id;
		return $this;
	}

	function open() {
		$tooltipAttr = ($this->tooltip != '')? 'data-toggle="tooltip" data-original-title="'.$this->tooltip.'"': "";
		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>';
		echo '<ul class="nav nav-tabs">';
			if($this->title != '') {
              echo '<li class="header pull-left" '.$tooltipAttr.'>';
					if($this->icon) $this->icon->show();
					echo $this->title;
			  echo '</li>';
			}

		$pullRight = '';
		if($this->title != '') {
			// Reversing because everything is pulled right.
			$this->tabs = array_reverse($this->tabs);
			$pullRight = 'pull-right';
		}
		foreach($this->tabs as $key => $tab) {
			$tabId = $tab['id'];
			$title = $tab['title'];
			$class = $pullRight;
			$class .= ($tabId == $this->activeId)? ' active': '';
			echo '<li class="'.$class.'">';
				echo '<a href="#'.$tabId.'" data-toggle="tab">';
				   echo $title;
				echo '</a>';
			echo '</li>';
		}
		echo '</ul>';

		echo '<div class="tab-content">';

        return $this;
	}

	function close() {
		echo '</div></div>';
	}

}


class TabPane extends Element {

	public function __construct() {
		parent::__construct();
		$this->containerClasses("tab-pane");
	}

	public function active() {
		$this->containerClasses('active');
		return $this;
	}

	public function open() {
		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>';
		return $this;
	}

	public function close() {
		echo '</div>';
	}
}







class Table extends Element {

	var $bordered	= false;
	var $condensed	= false;
	var $striped	= false;
	var $hover		= false;
	var $responsive	= false;
	var $searchable = false;
	var $sortable   = false;
	var $paginated  = false;

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Table Class Initialized");
		$this->containerClasses("table");
	}

	function bordered($type = true) {
		$this->containerClasses('table-bordered');
		return $this;
	}

	function condensed($type = true) {
		$this->containerClasses('table-condensed');
		return $this;
	}

	function striped($type = true) {
		$this->containerClasses('table-striped');
		return $this;
	}

	function hover($type = true) {
		$this->containerClasses('table-hover');
		return $this;
	}

	function responsive($type = true) {
		$this->responsive = $type;
		return $this;
	}

	function searchable($type = true) {
		$this->searchable = $type;
		return $this;
	}

	function sortable($type = true) {
		$this->sortable = $type;
		return $this;
	}

	function paginated($type = true) {
		$this->paginated = $type;
		return $this;
	}

	protected function isDataTable() {
		return $this->searchable || $this->sortable || $this->paginated;
	}

	function open() {
		if($this->responsive)		echo '<div class="table-responsive">';
		echo '<table '.$this->_parse_attributes().' '.$this->_parse_container_attributes().' >';
        return $this;
	}

	function close() {
		echo '</table>';
		if($this->responsive)	echo '</div>';

		if($this->isDataTable()) {
			echo '
			<script type="text/javascript">
				$(function() {
					$("#'.$this->properties['id'].'").dataTable({
						"bPaginate": '.(($this->paginated)? 'true': 'false').',
						"bLengthChange": '.(($this->paginated)? 'true': 'false').',
						"bFilter": '.(($this->searchable)? 'true': 'false').',
						"bSort": '.(($this->sortable)? 'true': 'false').',
						"bInfo": '.(($this->paginated)? 'true': 'false').',
						"bAutoWidth": '.(($this->paginated)? 'true': 'false').'
					});
				});
			</script>
			';
		}
	}
}












class Form extends Element {

	var $action = '';
	var $hidden = array();
	var $multipart = false;

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Form Class Initialized");
	}

	function action($action = '') {
		$this->action = $action;
		return $this;
	}

	function hidden($hidden = array()) {
		$this->hidden = $hidden;
		return $this;
	}

	function multipart($multipart = true) {
		$this->multipart = $multipart;
		return $this;
	}

	function open() {
		if($this->multipart)
			echo form_open_multipart($this->action, $this->_parse_attributes(), $this->hidden);
		else
			echo form_open($this->action, $this->_parse_attributes(), $this->hidden);
		return $this;
	}

	function close() {
		echo form_close();
	}
}















class Input extends Element {

	var $type = 'text';
	var $placeholder = '';
	var $label = '';
	var $uiType = '';
	var $help = '';
	var $addonRight = null;
	var $addonLeft = null;

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Input Class Initialized");
		$this->containerClasses("form-group");
		$this->classes('form-control');
		$this->width = 0;
		$this->ld_width = 0;
		$this->m_width = 0;
		$this->t_width = 0;
	}

	function type($type = '') {
		$this->properties["type"] = $type;
		if($type == "file") $this->classes("no-padding");
		return $this;
	}

	function label($label = '') {
		$this->label = $label;
		return $this;
	}

	function placeholder($placeholder = '') {
		$this->properties["placeholder"] = $placeholder;
		return $this;
	}

	function required($reqd = true) {
		$this->properties['required'] = "required";
		return $this;
	}

	function uiType($uiType = '') {
		$this->containerClasses("has-" . $uiType);
		$this->uiType = $uiType;
		return $this;
	}

	function addonLeft($addon) {
		$this->addonLeft = $addon;
		return $this;
	}

	function addonRight($addon) {
		$this->addonRight = $addon;
		return $this;
	}
	
	function help($help) {
		$this->help = $help;
		return $this;
	}

	protected function shouldMakeInputGroup() {
		return $this->addonLeft != null || $this->addonRight != null;
	}

	protected function openAddon() {
		if($this->shouldMakeInputGroup()) echo '<div class="input-group">';
		$this->makeAddon($this->addonLeft);
	}

	protected function closeAddon() {
		$this->makeAddon($this->addonRight);
		if($this->shouldMakeInputGroup()) echo '</div>';
	}

	protected function makeAddon($addon) {
		if($addon instanceof Button) {
			echo '<div class="input-group-btn">';
				$addon->show();
			echo '</div>';
		}
		else if($addon instanceof Element) {
			echo '<div class="input-group-addon">';
				$addon->show();
			echo '</div>';
		}
		else if(is_string($addon)) {
			echo '<div class="input-group-addon">';
				echo "<span>$addon</span>";
			echo '</div>';
		}
	}

	protected function makeLabel() {
		if($this->label != '') {
			$ip_label = new Label();
			$ip_label->forId($this->properties['id'])
					 ->text($this->label)
					 ->uiType($this->uiType)
					 ->show();
		}
	}
	
	protected function showHelp() {
		echo '<p class="help-block">'.$this->help.'</p>';
	}

	function show() {
		//form-group div
		echo '<div '.$this->_parse_container_attributes().'>';

			//label element
			$this->makeLabel();

			$this->openAddon();
			echo "<input " . $this->_parse_attributes() . " />";
			$this->closeAddon();

			$this->showHelp();
		echo "</div>";
	}

}











class Radio extends Input {

	var $checked = false;

	public function __construct() {
		parent::__construct();
		$this->containerClasses('radio');
		$this->properties['type'] = 'radio';
		log_message('debug', "UI_helper > Radio Class Initialized");
	}

	function checked($checked = true) {
		if($checked)
			$this->properties['checked'] = 'checked';
		return $this;
	}

	function show() {
		echo '<div '.$this->_parse_container_attributes().'>';
		echo '<label>';
		echo '<input ';
		echo $this->_parse_attributes().' /> '
			.(($this->label != '')?	$this->label:'').
			 '</label>';
		echo '</div>';
	}
}

class Checkbox extends Radio {

	var $checked = false;

	public function __construct() {
		parent::__construct();
		$this->properties['type'] = 'checkbox';
		$this->containerClasses('checkbox');
		log_message('debug', "UI_helper > Radio Class Initialized");
	}
}













class Textarea extends Input {

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Input Class Initialized");
		$this->properties['rows'] = 3;
		$this->properties['cols'] = 0;
	}

	function rows($rows = 3) {
		$this->properties['rows'] = $rows;
		return $this;
	}

	function cols($cols = 0) {
		$this->properties['cols'] = 0;
		return $this;
	}

	function show() {
		//form-group div
		echo '<div '.$this->_parse_container_attributes().'>';

		//label element
		$this->makeLabel();

		//input element
		$this->classes('form-control');

		$this->openAddon();

			// textarea don't use the value attribute
			$value = $this->properties['value'];
			unset($this->properties['value']);

			echo "<textarea " . $this->_parse_attributes() . ">" . $value;
			echo "</textarea>";
		$this->closeAddon();

		$this->showHelp();
		echo "</div>";
	}
}

class Select extends Input {

	var $options = array();
	var $multiple = false;

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Select Class Initialized");
	}

	function options($options = array()) {
		//options should be array of Option Objects
		$this->options = $options;
		return $this;
	}

	function multiple($multiple = true) {
		$this->properties['multiple'] = 'multiple';
		return $this;
	}

	function show() {
		echo '<div '.$this->_parse_container_attributes().'>';

		//label element
		$this->makeLabel();

		$this->openAddon();

			unset($this->properties['value']);

			echo "<select " . $this->_parse_attributes() . " >";

			foreach($this->options as $option)
				$option->show();
			echo "</select>";

		$this->closeAddon();
		$this->showHelp();

		echo "</div>";
	}
}

class Button extends Input {

	var $submit = false;		//submit type button
	var $mini = false;
	var $large = false;
	var $flat = false;
	var $block = false;
	var $icon = null;

	public function __construct() {
		parent::__construct();
		$this->classes('btn');
		$this->properties['type'] = 'button';

		// This is a hack
		$this->properties['class'] = str_replace("form-control", "", $this->properties['class']);
	}

	function submit($submit = true) {
		$this->submit = $submit;
		return $this;
	}

	function mini($mini = true) {
		$this->mini = $mini;
		return $this;
	}

	function large($large = true) {
		$this->large = $large;
		return $this;
	}

	function flat($flat = true) {
		$this->flat = $flat;
		return $this;
	}

	function block($block = true) {
		$this->block = $block;
		return $this;
	}

	function icon($icon) {
		$this->icon = $icon;
		return $this;
	}

	function show() {
		if($this->uiType == '')	$this->classes('btn-default');
		else 					$this->classes('btn-'.$this->uiType);

		if($this->mini)			$this->classes('btn-sm');
		else if($this->large)	$this->classes('btn-lg');

		if($this->flat)			$this->classes('btn-flat');
		if($this->block)		$this->classes('btn-block');


		if($this->properties['disabled'] != '')	$this->classes('disabled');

		if($this->submit)		$this->properties['type'] = 'submit';

		$val = $this->properties['value'];
		echo '<button '.$this->_parse_attributes().' >';
		if($this->icon) {
			$this->icon->show();
			echo ' ';
		}
		echo $val.'</button>';
	}
}

class PrintButton extends Button {

	public function __construct() {
		parent::__construct();
		$this->icon(new Icon("print"));
		$this->value("Print");
		$this->extras('onclick="window.print()"');
	}

}

class Option extends Element {

	var $value = '';
	var $text = '';
	var $disabled = false;
	var $selected = false;

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Option Class Initialized");
	}

	function text($text = '') {
		$this->text = $text;
		return $this;
	}

	function selected($selected = true) {
		if($selected) $this->properties['selected'] = 'selected';
		return $this;
	}

	function show() {
		echo '<option '.$this->_parse_attributes().'>'.$this->text.'</option>';
	}
}

class Label extends Element {

	var $forId = '';
	var $text = '';
	var $uiType = '';

	public function __construct() {
		log_message('debug', "UI_helper > Label Class Initialized");
	}

	function forId($forId = '') {
		$this->properties["for"] = $forId;
		$this->forId = $forId;
		return $this;
	}

	function text($text = '') {
		$this->text = $text;
		return $this;
	}

	function uiType($uiType = '') {
		$this->uiType = $uiType;
		return $this;
	}

    function __toString() {
        $icon = "";

        if($this->forId != '') {
            $this->classes("control-label");
            if($this->uiType != '') {
                switch(strtolower($this->uiType)) {
                    case "success":	$icon = '<i class="fa fa-check"></i> ';break;
                    case "danger":
                    case "error":	$icon = '<i class="fa fa-times-circle-o"></i> ';break;
                    case "warning":	$icon = '<i class="fa fa-warning"></i> ';break;
                }
            }
        }
        else {
            $this->classes("label");
            $this->classes("label-" . $this->uiType);
        }

        $labelString = '<label '.$this->_parse_attributes().' >';
        $labelString .= $icon . $this->text.'</label>';
        return $labelString;
    }

	function show() {
        echo $this->__toString();
	}
}

class Icon extends Element {

	public function __construct($type = "") {
		log_message('debug', "UI_helper > Label Class Initialized");
		$this->classes("fa fa-" . $type);
	}

	public function __toString() {
		return '<i '.$this->_parse_attributes().' ></i>&nbsp;';
	}

	function show() {
		echo $this;
	}
}

class Alert extends Element {

	var $uiType = '';
	var $desc = '';
	var $title = '';
	var $dismiss = true;
	var $classPrefix = "alert";

	public function __construct() {
		parent::__construct();
	}

	function uiType($uiType = '') {
		$this->uiType = $uiType;
		return $this;
	}

	function desc($desc = '') {
		$this->desc = $desc;
		return $this;
	}

	function title($title = '') {
		$this->title = $title;
		return $this;
	}

	function dismiss($dismiss = true) {
		$this->dismiss = $dismiss;
		return $this;
	}

	function show() {
		$this->containerClasses($this->classPrefix);
		if($this->uiType == 'error') $this->uiType = 'danger';
		if($this->uiType != '')		 $this->containerClasses($this->classPrefix . '-' . $this->uiType);
		if($this->dismiss) 			 $this->containerClasses($this->classPrefix . '-dismissable');

		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>';

		switch($this->uiType) {
			case 'danger': echo '<i class="fa fa-ban"></i>';break;
			case 'info'	: echo '<i class="fa fa-info"></i>';break;
			case 'warning': echo '<i class="fa fa-warning"></i>';break;
			case 'success': echo '<i class="fa fa-check"></i>';break;
		}

		if($this->dismiss)
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';

		if($this->title != '')	echo '<b>'.$this->title.'</b><br>';
		if($this->desc != '')	echo $this->desc;

		echo '</div>';
	}
}

class Callout extends Alert {

	public function __construct() {
		parent::__construct();
		$this->classPrefix = "callout";
	}

	function show()
	{
		$this->containerClasses($this->classPrefix);
		if($this->uiType == 'error') $this->uiType = 'danger';
		if($this->uiType != '')		 $this->containerClasses($this->classPrefix . '-' . $this->uiType);

		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>';

		if($this->title != '')	echo '<h4>'.$this->title.'</h4>';
		if($this->desc != '')	echo '<p>'.$this->desc.'</p>';

		echo '</div>';
	}
}





class DatePicker extends Input {
	var $label = '';
	var $dateFormat = 'dd-mm-yyyy';

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > DatePicker Class Initialized");
	}

	function dateFormat($dateFormat = 'dd-mm-yyyy') {
		$this->dateFormat = $dateFormat;
		return $this;
	}

	function show() {
		$this->containerExtras('data-date-format="'.$this->dateFormat.'"');
		parent::show();
		echo '
		<script>
			$("#'.$this->properties["id"].'").datepicker({
						format: "'.$this->dateFormat.'",
						autoclose: true,
						todayBtn: "linked"
			});';

		if($this->properties['value'] != '') {
			echo '$("#'.$this->properties["id"].'").datepicker("setDate", moment("'.$this->properties['value'].'", "'.strtoupper($this->dateFormat).'").toDate());';
		}

        echo '</script>';
	}
}


class ImagePicker extends Input {

	var $action = '';
	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Upload_image Class Initialized");
		$this->containerClasses("image-picker");
	}

	function show() {
		$addon = '<img style="height: 58px; max-width: 200px !important;" src="'.base_url().'assets/images/noProfileImage.png" />';

		$this->type("file")
			 ->extras(' accept="image/*" style="padding: 0; height: 60px;" ')
			 ->addonRight($addon);

		parent::show();
		echo '
		<script type="text/javascript">
			$(document).ready(function() {
				$("#'.$this->properties['id'].'").on("change", function(event) {
					var input = event.target;
					var reader = new FileReader();
					reader.onload = function(){
						var dataURL = reader.result;
						$("#'.$this->properties['id'].'").parent().find("img").attr("src", dataURL);
					};
					reader.readAsDataURL(input.files[0]);
				});
			});

		</script>
		';
	}
}





class Slider extends Input {
	var $label = '';
	var $min = '0';
	var $max = '100';
	var $rangetype = '0';
	var $step = '1';
	var $grid = false;
	var $datafrom = '';
	var $datato = '';
	var $prefix = '';
	var $postfix = '';
	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Slider Class Initialized");
	}
	function min($min = '')//min value
	{
		$this->min = $min;
		return $this;
	}
	function max($max = '')//max value
	{
		$this->max = $max;
		return $this;
	}
	function rangeType($rangetype = true)//double/single
	{
		$this->rangetype =$rangetype;
		return $this;
	}
	function step($step = '')//least count
	{
		$this->step = $step;
		return $this;
	}
	function grid($grid = true)
	{
		$this->grid = $grid;
		return $this;
	}
	function dataFrom($from = '')
	{
		$this->datafrom = $from;
		return $this;
	}
	function value($value = '')
	{
		parent::__construct();
		$this->datafrom = $value;
		return $this;
	}

	function dataTo($datato = '')
	{
		$this->datato = $datato;
		return $this;
	}
	function prefix($prefix = '')
	{
		$this->prefix = $prefix;
		return $this;
	}
	function postfix($postfix = '')
	{
		$this->postfix = $postfix;
		return $this;
	}
	function color($color = '')
	{
		$this->color = $color;
	}
	function show()
	{
		echo '<div '.$this->_parse_container_attributes().'>';

		//label element
		$this->makeLabel();

		$this->openAddon();

			unset($this->properties['value']);

		echo '
		<input '.$this->_parse_attributes().' />';
        $this->closeAddon();
		echo '
		</div>

		<script type="text/javascript">
			$("#'.$this->properties['id'].'").ionRangeSlider({
                    min: '.$this->min.',
                    max: '.$this->max.',
					from: '.$this->datafrom.',';

		if($this->rangetype)
		{
				echo '
					to: '.$this->datato.',
					type: \'double\',';
		}
		else echo ' type: \'single\',';
			echo '
                    step: '.$this->step.',';
		if($this->prefix!="")
             echo	' prefix: "'.$this->prefix.'",';
		if($this->postfix!="")
			echo	' postfix: "'.$this->postfix.',"';

			echo     'prettify: false,';
			if($this->grid)
				echo 'hasGrid: true';
			else
				echo 'hasGrid: false';
				echo '
                });
		</script>';
	}
}
