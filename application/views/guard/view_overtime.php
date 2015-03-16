<script>
$(document).ready(function(){
	$('select[name="mode"]').change(function(){
		var value  = this.value;
		if(value==''){
			return;
		}
		$("#postname, #date, #rangeofdates, #rangeofdates_postname, #rangeofdates_guard").hide();
		$("#" + value).show();
	});
	$('select[name="mode"]').val("<?php if(isset($mode)) echo $mode; ?>").trigger('change');
	$('select[name="postname"]').val("<?php if(isset($postname)) echo $postname;?>");
	$('select[name="postnamer"]').val("<?php if(isset($postnamer)) echo $postnamer;?>");
	$('select[name="guardname"]').val("<?php if(isset($guardname)) echo $guardname;?>");
	$('#selectdate').val("<?php if(isset($selectdate)) echo $selectdate; else echo date("Y-m-d");?>");
	$('#fromdate').val("<?php if(isset($fromdate)) echo $fromdate; else echo date("Y-m-d");?>");
	$('#fromdateg').val("<?php if(isset($fromdateg)) echo $fromdateg; else echo date("Y-m-d");?>");
	$('#fromdatep').val("<?php if(isset($fromdatep)) echo $fromdatep; else echo date("Y-m-d");?>");
	$('#todate').val("<?php if(isset($todate)) echo $todate; else echo date("Y-m-d");?>");
	$('#todateg').val("<?php if(isset($todateg)) echo $todateg; else echo date("Y-m-d");?>");
	$('#todatep').val("<?php if(isset($todatep)) echo $todatep; else echo date("Y-m-d");?>");
});
</script>
<?php 
$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('View Overtime Duties')
				 ->solid()
				 ->open();
			  
	$searchRow = $ui->row()
					->id('searchRow')
					->open();

			$searchlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Search Assigned Duties';
                $searchlabel->close();

                $searchinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  $ui->select()
								 ->name('mode')
								 ->addonLeft($ui->icon("list"))
								 ->options(array($ui->option()->value('')->text('Select Mode')->disabled()->selected(),
                                            $ui->option()->value('postname')->text('By Post Name'),
                                            $ui->option()->value('date')->text('By a Date'),
                                            $ui->option()->value('rangeofdates')->text('By a Range of Dates'),
                                            $ui->option()->value('rangeofdates_postname')->text('By a Range of Dates for a Postname'),
                                            $ui->option()->value('rangeofdates_guard')->text('By a Range of Dates for a Guard')))
								 ->required()
								 ->show();
                
				$searchinput->close();

					
	$searchRow->close();
	echo '<div id="postname" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
						 ->open();
						 
				$form = $ui->form()
						   ->multipart()
						   ->action('guard/over_time/view')
						   ->open();
				
					$postnamelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
                                      echo 'Select the postname to get details of guards';
					$postnamelabel->close();
					
					$postnameinput = $ui->col()
								    ->width(4)
									->t_width(4)
									->m_width(12)
									->open();
									
									$postname_array = array();
									if($postnames === False)
										$postname_array[] = $ui->option()->value('')->text('No Postname');
									
									else
									{
										$postname_array[] = $ui->option()->value('')->text('Select Postname')->disabled();
										foreach ($postnames as $row)
										{
											$postname_array = array_values($postname_array);
											$postname_array[] = $ui->option()->value($row->post_id)->text($row->postname);
										}
									}
									$ui->select()
									   ->name('postname')
									   ->addonLeft($ui->icon("building"))
									   ->options($postname_array)
									   ->required()
									   ->show();
																	   
					$postnameinput->close();        	
				
					$buttoncol = $ui->col()
									->width(4)
									->t_width(8)
									->m_width(12)
									->open();
						$ui->button()
						   ->value('Submit')
						   ->uiType('primary')
						   ->submit()
						   ->name('postsubmit')
						   ->show();
			
					$buttoncol->close();
				
				$form->close();		
		$selectqueryRow->close();
	echo '</div>';
	echo '<div id="date" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
						 ->open();
		
				$form = $ui->form()
						   ->multipart()
						   ->action('guard/over_time/view')
						   ->open();
				
				$datelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
                                      echo 'Select a date to get guards list';
				$datelabel->close();
				$dateinput = $ui->col()
								->width(4)
								->t_width(4)
								->m_width(12)
								->open();
							

							$ui->datePicker()
							->name('selectdate')
							->addonLeft($ui->icon("calendar"))
							->placeholder("Enter the date")
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();		
																	   
					$dateinput->close();        	
				
					$buttoncol = $ui->col()
									->width(4)
									->t_width(8)
									->m_width(12)
									->open();
						$ui->button()
						   ->value('Submit')
						   ->uiType('primary')
						   ->submit()
						   ->name('datesubmit')
						   ->show();
			
					$buttoncol->close();
				
				$form->close();
				
	    $selectqueryRow->close();
	echo '</div>';
	echo '<div id="rangeofdates" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
						 ->open();
		
				$form = $ui->form()
						   ->multipart()
						   ->action('guard/over_time/view')
						   ->open();
				
				$rangelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
                                      echo 'Select Range to get Guard\'s Duty';
				$rangelabel->close();
				$rangefrominput = $ui->col()
									 ->width(2)
									 ->t_width(2)
									 ->m_width(6)
									 ->open();
							

							$ui->datePicker()
							->name('fromdate')
							->placeholder("From Date")
							->addonLeft($ui->icon("calendar"))
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();		
				
				$rangefrominput->close();			
							
							
				$rangetoinput = $ui->col()
								   ->width(2)
								   ->t_width(2)
								   ->m_width(6)
								   ->open();			
							
							$ui->datePicker()
							->name('todate')
							->placeholder("To Date")
							->addonLeft($ui->icon("calendar"))
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();
							
				$rangetoinput->close();        	
				
					$buttoncol = $ui->col()
									->width(4)
									->t_width(8)
									->m_width(12)
									->open();
						$ui->button()
						   ->value('Submit')
						   ->uiType('primary')
						   ->submit()
						   ->name('rangesubmit')
						   ->show();
			
					$buttoncol->close();
				
				$form->close();
				
	    $selectqueryRow->close();
	echo '</div>';
	echo '<div id="rangeofdates_guard" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
						 ->open();
		
				$form = $ui->form()
						   ->multipart()
						   ->action('guard/over_time/view')
						   ->open();
				
					$rangelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
                                      echo 'Select Range to get Guard\'s Duty';
					$rangelabel->close();
					
					$rangefrominput = $ui->col()
									 ->width(2)
									 ->t_width(2)
									 ->m_width(6)
									 ->open();
							

							$ui->datePicker()
							->name('fromdateg')
							->placeholder("From Date")
							->addonLeft($ui->icon("calendar"))
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();		
				
					$rangefrominput->close();			
							
							
					$rangetoinput = $ui->col()
								   ->width(2)
								   ->t_width(2)
								   ->m_width(6)
								   ->open();			
							
							$ui->datePicker()
							->name('todateg')
							->placeholder("To Date")
							->addonLeft($ui->icon("calendar"))
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();
							
					$rangetoinput->close();        	
				
					$guardcol = $ui->col()
									->width(3)
									->t_width(6)
									->m_width(9)
									->open();
						$guardname_array = array();
									if($guardnames === False)
										$guardname_array[] = $ui->option()->value('')->text('No Guardname');
									
									else
									{
										$guardname_array[] = $ui->option()->value('')->text('Select Guardname')->disabled();
										foreach ($guardnames as $row)
										{
											$guardname_array = array_values($guardname_array);
											$guardname_array[] = $ui->option()->value($row->Regno)->text($row->firstname.' '.$row->lastname);
										}
									}
									$ui->select()
									   ->name('guardname')
									   ->addonLeft($ui->icon("user"))
									   ->options($guardname_array)
									   ->required()
									   ->show();
		
					
					$guardcol->close();
					
					$buttoncol = $ui->col()
									->width(1)
									->t_width(2)
									->m_width(3)
									->open();
						$ui->button()
						   ->value('Submit')
						   ->uiType('primary')
						   ->submit()
						   ->name('rangeguardsubmit')
						   ->show();
			
					$buttoncol->close();
				
				$form->close();
				
	    $selectqueryRow->close();
		
	echo '</div>';
	echo '<div id="rangeofdates_postname" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
						 ->open();
		
				$form = $ui->form()
						   ->multipart()
						   ->action('guard/over_time/view')
						   ->open();
				
					$rangelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
                                      echo 'Select Range to get Guard\'s Duty';
					$rangelabel->close();
					
					$rangefrominput = $ui->col()
									 ->width(2)
									 ->t_width(2)
									 ->m_width(6)
									 ->open();
							

							$ui->datePicker()
							->name('fromdatep')
							->addonLeft($ui->icon("calendar"))
							->placeholder("From Date")
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();		
				
					$rangefrominput->close();			
							
							
					$rangetoinput = $ui->col()
								   ->width(2)
								   ->t_width(2)
								   ->m_width(6)
								   ->open();			
							
							$ui->datePicker()
							->name('todatep')
							->placeholder("To Date")
							->addonLeft($ui->icon("calendar"))
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();
							
					$rangetoinput->close();        	
				
					$postnamecol = $ui->col()
									->width(3)
									->t_width(6)
									->m_width(9)
									->open();
						$postname_array = array();
									if($postnames === False)
										$postname_array[] = $ui->option()->value('')->text('No Postname');
									
									else
									{
										$postname_array[] = $ui->option()->value('')->text('Select Postname')->disabled();
										foreach ($postnames as $row)
										{
											$postname_array = array_values($postname_array);
											$postname_array[] = $ui->option()->value($row->post_id)->text($row->postname);
										}
									}
									$ui->select()
									   ->name('postname')
									   ->addonLeft($ui->icon("building"))
									   ->options($postname_array)
									   ->required()
									   ->show();
		
					
					$postnamecol->close();
					
					$buttoncol = $ui->col()
									->width(1)
									->t_width(2)
									->m_width(3)
									->open();
						$ui->button()
						   ->value('Submit')
						   ->uiType('primary')
						   ->submit()
						   ->name('rangepostsubmit')
						   ->show();
			
					$buttoncol->close();
				
				$form->close();
				
	    $selectqueryRow->close();
	echo '</div>';
$headingBox->close();

?>