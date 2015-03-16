<?php
$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Edit the Details of Post')
				 ->solid()
				 ->open();
	$form = $ui->form()
		   ->multipart()
		   ->action('guard/manage_post/edit')
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
								   ->value($details_of_a_postname['post_id'])
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
								   ->value($details_of_a_postname['postname'])
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
								   ->value($details_of_a_postname['ipaddress'])
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
								   ->placeholder('Enter Number of Guard in shift A')
								   ->value($details_of_a_postname['number_a'])
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
								   ->placeholder('Enter Number of Guard in shift B')
								   ->value($details_of_a_postname['number_b'])
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
								   ->placeholder('Enter Number of Guard in shift C')
								   ->value($details_of_a_postname['number_c'])
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
						   ->value('Save')
						   ->uiType('primary')
						   ->icon($ui->icon('save'))
						   ->submit()
						   ->name('savesubmit')
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
		   ->value($details_of_a_postname['post_id'])
		   ->show();			
	$form->close();
$headingBox->close();	

?>
</center>