<?php
$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Assign Duty to a Guard for tomorrow ( '.date(('d M Y'),strtotime(date("Y-m-d")) + 86400 + 19800 ).' )')
				 ->solid()
				 ->open();
	$form = $ui->form()
		   ->multipart()
		   ->action('guard/duties/assign_to_a_guard')
		   ->open();
						  
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
											$guardname_array[] = $ui->option()->value($row->Regno)->text($row->firstname.' '.$row->lastname);
										}
									}
							  $ui->select()
								 ->name('regno')
								 ->addonLeft($ui->icon("user"))
								 ->options($guardname_array)
								 ->required()
								 ->show();
                
				$guardinput->close();		
	$guardRow->close();
	$postRow = $ui->row()
					->id('postRow')
					->open();

			$postlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Select Post Name';
                $postlabel->close();

                $postinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  $postname_array = array();
									if($posts === False)
										$postname_array[] = $ui->option()->value('')->text('No Postname');
									
									else
									{
										$postname_array[] = $ui->option()->value('')->text('Select Postname')->disabled();
										foreach ($posts as $row)
										{
											$postname_array = array_values($postname_array);
											$postname_array[] = $ui->option()->value($row['post_id'])->text($row['postname']);
										}
									}
									$ui->select()
									   ->name('post_id')
									   ->addonLeft($ui->icon("building"))
									   ->options($postname_array)
									   ->required()
									   ->show();
                
				$postinput->close();		
	$postRow->close();
	$shiftRow = $ui->row()
					->id('shiftRow')
					->open();

			$shiftlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Select Shift';
                $shiftlabel->close();

                $shiftinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  	$ui->select()
									   ->name('shift')
									   ->addonLeft($ui->icon("bars"))
									   ->options(array($ui->option()->value('')->text('Select Shift')->disabled()->selected(),
                                            $ui->option()->value('a')->text('A'),
                                            $ui->option()->value('b')->text('B'),
                                            $ui->option()->value('c')->text('C')))
                                            ->required()
									   ->show();
                
				$shiftinput->close();		
	$shiftRow->close();
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
						   ->name('assign')
						   ->show();
			$bbuttonCol->close();
			$cbuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(2)
                              ->open();
			$cbuttonCol->close();
	$buttonRow->close();
	
		$ui->input()
		   ->id('date')
		   ->name('date')
		   ->extras("type='hidden'")
		   ->value(date(('Y-m-d'),strtotime(date("Y-m-d")) + 86400 + 19800))
		   ->show();			
	$form->close();
$headingBox->close();	

?>
</center>