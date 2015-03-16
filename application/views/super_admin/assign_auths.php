<script type="text/javascript" language="javascript">
$(document).ready(function() {
	onload_emp_id();
	onload_auth('auth');
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
						->title('Assign Authorizations')
						->icon($ui->icon('edit'))
						->solid()
						->open();
					
					$form = $ui->form()->action('super_admin/admin/insert_auths')->open();	
					
				$row1 = $ui->row()->open();	
					$r1col1 = $ui->col()->width(4)->t_width(4)->m_width(4)->open();
						$ui->select()
						->label('Employee Id')
						->name('emp_id')
						->id('emp_id')
						->options(array($ui->option()->value('0')->text('Select')->disabled()->selected()))
						->show();
					$r1col1->close();
					
					$r1col2 = $ui->col()->width(8)->m_width(8)->t_width(8)->open();
						?><br /><br /><a onClick="onclick_emp_id();" >Don't remember Employee Id</a><?
					$r1col2->close();
				$row1->close();
				
				$row2 = $ui->row()->id('search_eid')->style('display:none')->open();
					$r2col1 = $ui->col()->open();
						$ui->select()
							->label('Department')
							->name('emp_dept')
							->id('emp_dept')
							->extras('onchange="onclick_empname();"')
						->options(array($ui->option()->value('0')->text('Select Employee Department')->disabled()->selected()))
														->show();
					$r2col1->close();
				$row2->close();
				
				$row3 = $ui->row()->id('employee')->style('display:none')->open();
					$r3col1 = $ui->col()->id('employee')->open();
						$ui->select()
							->label('Employee name')
							->name('employee_select')
							->id('employee_select')
							->options(array($ui->option()->value('0')->text('Select Employee')->disabled()->selected()))
							->show();
					$r3col1->close();
				$row3->close();
				
				$row4 = $ui->row()->open();
					$r4col1 = $ui->col()->open();
						$ui->select()
							->label('Authorization')
							->name('auth')
							->id('auth')
							->options(array($ui->option()->value('0')->text('Select Auth')->disabled()->selected()))
							->show();
							
					$ui->button()
				     ->submit()
					 ->value("Submit")
					 ->uiType("primary")
					 ->show();

					$r4col1->close();
				$row4->close();
								
			$form->close();
			$contentbox->close();
			
		$contentcol->close();
	$rightcol = $ui->col()->width(3)->t_width(0)->m_width(0)->open();
	$rightcol->close();
	$contentrow->close();
?>