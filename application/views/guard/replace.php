<?php
if($shift == 'a') $shift = 'A';
if($shift == 'b') $shift = 'B';
if($shift == 'c') $shift = 'C';

$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Replace Guard ('.$guarddetails->firstname.' '.$guarddetails->lastname.')'.'<div style="height: 30px; 
									width: 30px;
									background-image: url('.base_url().'assets/images/guard/'.$guarddetails->photo.');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
									float: right;
									margin-left: 10px;
									"
									data-photo-url="'.base_url().'assets/images/guard/'.$guarddetails->photo.'"
									class="print-no-display photo-zoom"></div>')
				 ->solid()
				 ->open();
	$form = $ui->form()
		   ->multipart()
		   ->action('guard/duties/replace')
		   ->open();
						  
	$guardRow = $ui->row()
					->id('searchRow')
					->open();

			$guardlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Guard Name';
                $guardlabel->close();

                $guardinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  $ui->input()
								 ->disabled()
								 ->value($guarddetails->firstname.' '.$guarddetails->lastname)
								 ->addonLeft($ui->icon("user"))
								 ->show();
		
							  //echo '<br>';
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
                              echo 'Post Name';
                $postlabel->close();

                $postinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
								$ui->input()
								 ->disabled()
								 ->value($postname)
								 ->addonLeft($ui->icon("building"))
								 ->show();
								//echo $postname;
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
                              echo 'Duty Shift';
                $shiftlabel->close();

                $shiftinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
								$ui->input()
								 ->disabled()
								 ->value($shift)
								 ->addonLeft($ui->icon("bars"))
								 ->show();
				$shiftinput->close();		
	$shiftRow->close();
	$dateRow = $ui->row()
					->id('dateRow')
					->open();

			$datelabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Duty Date';
                $datelabel->close();

                $dateinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  		$ui->input()
									   ->value(date('d M Y',strtotime($date)+19800))
									   ->disabled()
									   ->addonLeft($ui->icon("calendar"))
									   ->show();
				$dateinput->close();		
	$dateRow->close();
	$replaceRow = $ui->row()
					 ->open();
				    $replacelabel = $ui->col()
                              ->width(4)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Replace By';
					$replacelabel->close();

					 $guardcol = $ui->col()
									->width(8)
									->t_width(8)
									->m_width(12)
									->open();
						$guardname_array = array();
									if($all_gaurds_at_same_shift === False)
										$guardname_array[] = $ui->option()->value('')->text('No Guardname');
									
									else
									{
										$guardname_array[] = $ui->option()->value('')->text('Select Guardname')->disabled();
										foreach ($all_gaurds_at_same_shift as $row)
										{
											$guardname_array = array_values($guardname_array);
											$guardname_array[] = $ui->option()->value($row->Regno)->text($row->firstname.' '.$row->lastname);
										}
									}
									$ui->select()
									   ->name('guard_id')
									   ->addonLeft($ui->icon("user"))
									   ->options($guardname_array)
									   ->required()
									   ->show();
		
					
					$guardcol->close();

	$replaceRow->close();
	$remarksRow = $ui->row()
					->id('remarksRow')
					->open();

			$remarkslabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Remarks';
                $remarkslabel->close();

                $remarksinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  		$ui->input()
									   ->id('remarks')
									   ->name('remarks')
									   ->placeholder('Enter Remarks')
									   ->addonLeft($ui->icon("book"))
									   ->required()
									   ->show();
				$remarksinput->close();		
	$remarksRow->close();
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
						   ->submit()
						   ->icon($ui->icon('save'))
						   ->name('replace')
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
		   ->value($date)
		   ->show();
		$ui->input()
		   ->id('regno')
		   ->name('regno')
		   ->extras("type='hidden'")
		   ->value($regno)
		   ->show();
		$ui->input()
		   ->id('post_id')
		   ->name('post_id')
		   ->extras("type='hidden'")
		   ->value($post_id)
		   ->show();
		$ui->input()
		   ->id('shift')
		   ->name('shift')
		   ->extras("type='hidden'")
		   ->value($shift)
		   ->show();
	$form->close();
$headingBox->close();	

?>
</center>