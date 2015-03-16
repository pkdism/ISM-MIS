<script type="text/javascript" language="javascript">
$(document).ready(function() {
	onload_auth('auth_id');
	onload_dept();
});
</script>
<?php
$ui = new UI();
	$contentrow = $ui->row()->open();
	$leftcol = $ui->col()->width(3)->t_width(0)->m_width(0)->open();
	$leftcol->close();
		$contentcol = $ui->col()->width(6)->open();
			
			$contentbox = $ui->box()
						->uiType('primary')
						->title('Deny Authorization')
						->icon($ui->icon('edit'))
						->solid()
						->open();
				
				$row1 = $ui->row()->open();	
				
					$r1col1 = $ui->col()->open();
					$ui->select()
						->label('Select Authorization')
						->name('auth_id')
						->id('auth_id')
						->extras('onchange="onchange_auth();"')
						->options(array($ui->option()->value('0')->text('Select')->disabled()->selected()))
						->show();
					
					$ui->select()
						->label('Department')
						->name('dept_id')
						->id('dept_id')
						->extras('onchange="onchange_auth();"')
						->options(array($ui->option()->value('all')->text('Select User Department')->selected()))
						->show();
					$r1col1->close();
					
				$row1->close();
			$contentbox->close();
			$contentcol->close();
			$contentrow->close();
			
$contentrow2 = $ui->row()->open();
$r2col1= $ui->col()->width(12)->open();
?><div id ="view_users"></div><?
$r2col1->close();
$contentrow2->close();