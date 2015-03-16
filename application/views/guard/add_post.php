<?php
	$value =1;
	if($id->post_id != NULL)
		$value = $id->post_id + 1;

$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Enter the Details of Post')
				 ->solid()
				 ->open();
	$form = $ui->form()
		   ->multipart()
		   ->action('guard/manage_post/add')
		   ->open();
						  
	$postidRow = $ui->row()
					->id('postidRow')
					->open();

			$guardlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Post ID';
                $guardlabel->close();

                $guardinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							    
								$ui->input()
								   ->value($value)
								   ->disabled()
								   ->show();			
							                  
				$guardinput->close();		
	$postidRow->close();
	
	$postRow = $ui->row()
					->id('postRow')
					->open();

			$postlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Post Name';
                $postlabel->close();

                $postinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							    $ui->input()
								   ->id('postname')
								   ->name('postname')
								   ->required()
								   ->placeholder('Enter Post Name')
								   ->show();			
                
				$postinput->close();		
	$postRow->close();
	$ipRow = $ui->row()
					->id('ipRow')
					->open();

			$guardlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'IP Address of Post';
                $guardlabel->close();

                $guardinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							    
								$ui->input()
								   ->id('ipaddress')
								   ->name('ipaddress')
								   ->placeholder('Enter IP Address')
								   ->show();			
							                  
				$guardinput->close();		
	$ipRow->close();
	$shiftRow = $ui->row()
					->id('shiftRowA')
					->open();

			$shiftlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Number of Guards in Shift A';
                $shiftlabel->close();

                $shiftinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							    $ui->input()
								   ->id('number_a')
								   ->name('number_a')
								   ->placeholder('Number of Guards in Shift A')
								   ->required()
								   ->extras("min='1'")
								   ->type('number')
								   ->show();			
							  	                
				$shiftinput->close();		
	$shiftRow->close();
	$shiftRow = $ui->row()
					->id('shiftRowB')
					->open();

			$shiftlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Number of Guards in Shift B';
                $shiftlabel->close();

                $shiftinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							    $ui->input()
								   ->id('number_b')
								   ->name('number_b')
								   ->placeholder('Number of Guards in Shift B')
								   ->required()
								   ->extras("min='1'")
								   ->type('number')
								   ->show();			
							  	                
				$shiftinput->close();		
	$shiftRow->close();
	$shiftRow = $ui->row()
					->id('shiftRowC')
					->open();

			$shiftlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Number of Guards in Shift C';
                $shiftlabel->close();

                $shiftinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							    $ui->input()
								   ->id('number_c')
								   ->name('number_c')
								   ->placeholder('Number of Guards in Shift C')
								   ->required()
								   ->extras("min='1'")
								   ->type('number')
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
						   ->value('Add')
						   ->icon($ui->icon('plus'))
						   ->uiType('primary')
						   ->submit()
						   ->name('addsubmit')
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
		   ->id('post_id')
		   ->name('post_id')
		   ->extras("type='hidden'")
		   ->value($value)
		   ->show();			
	$form->close();
$headingBox->close();	

?>
</center>
