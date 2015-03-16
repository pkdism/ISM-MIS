<?php 
if(count($available_guards) == 0)
	echo '<font color="red">There is no free Guard to assign this duty.</font>';
else
{
	$ui = new UI();
	$guardRow = $ui->row()
					->id('searchRow')
					->open();

			$guardlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Select Guard Name';
                $guardlabel->close();

                $guardinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  $guardname_array = array();
									if($available_guards === False)
										$guardname_array[] = $ui->option()->value('')->text('No Guardname');
									
									else
									{
										$guardname_array[] = $ui->option()->value('')->text('Select Guardname')->disabled();
										foreach ($available_guards as $row)
										{
											$guardname_array = array_values($guardname_array);
											$guardname_array[] = $ui->option()->value($row['Regno'])->text($row['firstname'].' '.$row['lastname']);
										}
									}
							  $ui->select()
								 ->name('Regno')
								 ->addonLeft($ui->icon("user"))
								 ->options($guardname_array)
								 ->required()
								 ->show();
                
				$guardinput->close();		
	$guardRow->close();
	$buttonRow = $ui->row()
					->open();
					
			$abuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(2)
                              ->open();
			$abuttonCol->close();
			$bbuttonCol = $ui->col()
                              ->width(2)
                              ->t_width(8)
                              ->m_width(8)
                              ->open();
							  
						$ui->button()
						   ->value('Assign')
						   ->uiType('primary')
						   ->submit()
						   ->name('assign_overtime')
						   ->id('assign_overtime')
						   ->show();
			$bbuttonCol->close();
			$cbuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(2)
                              ->open();
			$cbuttonCol->close();
	$buttonRow->close();

}
?>
