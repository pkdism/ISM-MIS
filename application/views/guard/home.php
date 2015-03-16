<?php 
$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Welcome to Guard Tracking System')
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
								 ->options(array($ui->option()->value('')->text('Select Mode')->disabled(),
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
									   ->id('post_id')
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
						   ->value('Go')
						   ->icon($ui->icon('arrow-right'))
						   ->uiType('primary')
						   ->name('postsubmit')
						   ->id('postsubmit')
						   ->show();
			
					$buttoncol->close();
			
		$selectqueryRow->close();
	echo '</div>';
	echo '<div id="date" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
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
							->id('selectdate')
							->placeholder("Enter the date")
							->addonLeft($ui->icon("calendar"))
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
						   ->value('Go')
						   ->icon($ui->icon('arrow-right'))
						   ->uiType('primary')
						   ->id('datesubmit')
						   ->name('datesubmit')
						   ->show();
			
					$buttoncol->close();
				
	    $selectqueryRow->close();
	echo '</div>';
	echo '<div id="rangeofdates" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
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
							->id('fromdate')
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
							->id('todate')
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
						   ->value('Go')
						   ->icon($ui->icon('arrow-right'))
						   ->uiType('primary')
						   ->id('rangesubmit')
						   ->name('rangesubmit')
						   ->show();
			
					$buttoncol->close();
				
	    $selectqueryRow->close();
	echo '</div>';
	echo '<div id="rangeofdates_guard" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
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
							->id('fromdateg')
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
							->id('todateg')
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
									   ->id('guardname')
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
						   ->value('Go')
						   ->icon($ui->icon('arrow-right'))
						   ->uiType('primary')
						   ->id('rangeguardsubmit')
						   ->name('rangeguardsubmit')
						   ->show();
			
					$buttoncol->close();
				
	    $selectqueryRow->close();
		
	echo '</div>';
	echo '<div id="rangeofdates_postname" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
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
							->id('fromdatep')
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
							->id('todatep')
							->addonLeft($ui->icon("calendar"))
							->placeholder("To Date")
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
									   ->name('postnamer')
									   ->id('postnamer')
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
						   ->value('Go')
						   ->icon($ui->icon('arrow-right'))
						   ->uiType('primary')
						   ->id('rangepostsubmit')
						   ->name('rangepostsubmit')
						   ->show();
			
					$buttoncol->close();
				
				
	    $selectqueryRow->close();
	echo '</div>';
$headingBox->close();

?>

<?
$headingBox = $ui->box()
				 ->id('postDutyChartBox')
				 ->uiType('info')
				 ->title('Details of Guards at post <div style="float:right; margin-left:10px;" id="post-div"></div>')
				 ->solid()
				 ->open();
	$tabsRow = $ui->row()->open();
	  $tabsCol = $ui->col()->open();	
		$tabBox = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Duty Chart")
				   ->tab("regularp", $ui->icon("bars")."Regular List", true)
				   ->tab("overtimep", $ui->icon("bars")."Overtime List")
				   ->open();
			
			
			$tab1 = $ui->tabPane()->id("regularp")->active()->open();	
					echo '<div id="postmessage-div" style="display:none;">';
								$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("List is empty for the given post.")
								  ->uiType("info")
								  ->show();
					echo '</div>';		
					$tableRow= $ui->row()->id('postDutyChartTableRow')->open();
							$table = $ui->table()
										->id('postDutyChartTable')
										->responsive()
										->hover()
										->bordered()
										->striped()
										->sortable()
										->paginated()
										->searchable()
										->open();
						?>
								<thead>
									<tr>
										<th class="print-no-display" width="30px">Photo</th>
										<th><center>Guard Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Duty Date</center></th>
									</tr>
								</thead>

								<tfoot>
									<tr>
										<th class="print-no-display" width="30px">Photo</th>
										<th><center>Guard Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Duty Date</center></th>
									</tr>
								</tfoot>	
						<?php
							$table->close();
					$tableRow->close();
	            $tab1->close();
				
				$tab1 = $ui->tabPane()->id("overtimep")->open();
					echo '<div id="postmessageO-div" style="display:none;">';
								$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("List is empty for the given post.")
								  ->uiType("info")
								  ->show();
					echo '</div>';
					echo '<div id="totalduration"></div>';
					$tableRow= $ui->row()->id('postDutyChartTableOvertimeRow')->open();
					$table = $ui->table()->id('postDutyChartTableOvertime')
										 ->responsive()
										 ->hover()
										 ->bordered()
										 ->striped()
										 ->sortable()
										 ->paginated()
										 ->searchable()
										 ->open();

								echo '<thead>
											<tr>
												<th class="print-no-display" width="30px">Photo</th>
												<th><center>Guard Name</center></th>
												<th><center>From Time</center></th>
												<th><center>To Time</center></th>
												<th><center>Duration</center></th>
												<th><center>Duty Date</center></th>
											</tr>
									  </thead>
									  <tfoot>
											<tr>
												<th class="print-no-display" width="30px">Photo</th>
												<th><center>Guard Name</center></th>
												<th><center>From Time</center></th>
												<th><center>To Time</center></th>
												<th><center>Duration</center></th>
												<th><center>Duty Date</center></th>
											</tr>
									  </tfoot>';
									 
					$table->close();
				$tableRow->close();
				$tab1->close();
			
			$tabBox->close();
		  $tabsCol->close();
		$tabsRow->close();
$headingBox->close();

?>

<?
$headingBox = $ui->box()
				 ->id('dateDutyChartBox')
				 ->uiType('info')
				 ->title('Details of Guards on <div style="float:right; margin-left:10px;" id="date-div"></div>')
				 ->solid()
				 ->open();
	$tabsRow = $ui->row()->open();
	  $tabsCol = $ui->col()->open();	
		$tabBox = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Duty Chart")
				   ->tab("regulard", $ui->icon("bars")."Regular List", true)
				   ->tab("overtimed", $ui->icon("bars")."Overtime List")
				   ->open();
			
			
			$tab1 = $ui->tabPane()->id("regulard")->active()->open();	
					echo '<div id="datemessage-div" style="display:none;">';
								$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("List is empty for the given date.")
								  ->uiType("info")
								  ->show();
					echo '</div>';
						$tableRow= $ui->row()->id('dateDutyChartTableRow')->open();		
								
								$table = $ui->table()
											->id('dateDutyChartTable')
											->responsive()
											->hover()
											->bordered()
											->striped()
											->sortable()
											->paginated()
											->searchable()
											->open();
							?>
									<thead>
										<tr>
											<th class="print-no-display" width="30px">Photo</th>
											<th><center>Guard Name</center></th>
											<th><center>Post Name</center></th>
											<th><center>Shift</center></th>
											
										</tr>
									</thead>

									<tfoot>
										<tr>
											<th class="print-no-display" width="30px">Photo</th>
											<th><center>Guard Name</center></th>
											<th><center>Post Name</center></th>
											<th><center>Shift</center></th>
										</tr>
									</tfoot>	
							<?php
								$table->close();
						$tableRow->close();
				$tab1->close();
				
				$tab1 = $ui->tabPane()->id("overtimed")->open();
					echo '<div id="datemessageO-div" style="display:none;">';
								$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("List is empty for the given date.")
								  ->uiType("info")
								  ->show();
					echo '</div>';
					echo '<div id="totaldurationd"></div>';
					$tableRow= $ui->row()->id('dateDutyChartTableOvertimeRow')->open();
							$table = $ui->table()
											->id('dateDutyChartTableOvertime')
											->responsive()
											->hover()
											->bordered()
											->striped()
											->sortable()
											->paginated()
											->searchable()
											->open();
							?>
									<thead>
										<tr>
											<th class="print-no-display" width="30px">Photo</th>
											<th><center>Guard Name</center></th>
											<th><center>Post Name</center></th>
											<th><center>From Time</center></th>
											<th><center>To Time</center></th>
											<th><center>Duration</center></th>
											
										</tr>
									</thead>

									<tfoot>
										<tr>
											<th class="print-no-display" width="30px">Photo</th>
											<th><center>Guard Name</center></th>
											<th><center>Post Name</center></th>
											<th><center>From Time</center></th>
											<th><center>To Time</center></th>
											<th><center>Duration</center></th>
										</tr>
									</tfoot>	
							<?php
								$table->close();
						$tableRow->close();
				$tab1->close();
			
			$tabBox->close();
		  $tabsCol->close();
		$tabsRow->close();
$headingBox->close();

?>

<?
$headingBox = $ui->box()
				 ->id('rangeDutyChartBox')
				 ->uiType('info')
				 ->title('Details of Guards from <div style="float:right; margin-left:10px;" id="range-div"></div>')
				 ->solid()
				 ->open();
	$tabsRow = $ui->row()->open();
	  $tabsCol = $ui->col()->open();	
		$tabBox = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Duty Chart")
				   ->tab("regularr", $ui->icon("bars")."Regular List", true)
				   ->tab("overtimer", $ui->icon("bars")."Overtime List")
				   ->open();
			
			
			$tab1 = $ui->tabPane()->id("regularr")->active()->open();
						echo '<div id="rangemessage-div" style="display:none;">';
								$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("List is empty for the given date range.")
								  ->uiType("info")
								  ->show();
						echo '</div>';		
							$tableRow= $ui->row()->id('rangeDutyChartTableRow')->open();	
								$table = $ui->table()
											->id('rangeDutyChartTable')
											->responsive()
											->hover()
											->bordered()
											->striped()
											->sortable()
											->paginated()
											->searchable()
											->open();
							?>
									<thead>
										<tr>
											<th class="print-no-display" width="30px">Photo</th>
											<th><center>Guard Name</center></th>
											<th><center>Post Name</center></th>
											<th><center>Shift</center></th>
											<th><center>Duty Date</center></th>
										</tr>
									</thead>

									<tfoot>
										<tr>
											<th class="print-no-display" width="30px">Photo</th>
											<th><center>Guard Name</center></th>
											<th><center>Post Name</center></th>
											<th><center>Shift</center></th>
											<th><center>Duty Date</center></th>
										</tr>
									</tfoot>	
							<?php
								$table->close();
						$tableRow->close();
				$tab1->close();
				
				$tab1 = $ui->tabPane()->id("overtimer")->open();
					echo '<div id="rangemessageO-div" style="display:none;">';
								$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("List is empty for the given date range.")
								  ->uiType("info")
								  ->show();
					echo '</div>';
							echo '<div id="totaldurationr"></div>';
							$tableRow= $ui->row()->id('rangeDutyChartTableOvertimeRow')->open();
							$table = $ui->table()
											->id('rangeDutyChartTableOvertime')
											->responsive()
											->hover()
											->bordered()
											->striped()
											->sortable()
											->paginated()
											->searchable()
											->open();
							?>
									<thead>
										<tr>
											<th class="print-no-display" width="30px">Photo</th>
											<th><center>Guard Name</center></th>
											<th><center>Post Name</center></th>
											<th><center>From Time</center></th>
											<th><center>To Time</center></th>
											<th><center>Duration</center></th>
											<th><center>Date</center></th>
											
										</tr>
									</thead>

									<tfoot>
										<tr>
											<th class="print-no-display" width="30px">Photo</th>
											<th><center>Guard Name</center></th>
											<th><center>Post Name</center></th>
											<th><center>From Time</center></th>
											<th><center>To Time</center></th>
											<th><center>Duration</center></th>
											<th><center>Date</center></th>
										</tr>
									</tfoot>	
							<?php
								$table->close();
							$tableRow->close();
				$tab1->close();
			
			$tabBox->close();
		  $tabsCol->close();
		$tabsRow->close();
$headingBox->close();

?>

<?
$headingBox = $ui->box()
				 ->id('rangepostDutyChartBox')
				 ->uiType('info')
				 ->title('Details of Guards from <div style="float:right; margin-left:10px;" id="rangepost-div"></div>')
				 ->solid()
				 ->open();
	$tabsRow = $ui->row()->open();
	  $tabsCol = $ui->col()->open();	
		$tabBox = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Duty Chart")
				   ->tab("regularrp", $ui->icon("bars")."Regular List", true)
				   ->tab("overtimerp", $ui->icon("bars")."Overtime List")
				   ->open();
			
			
			$tab1 = $ui->tabPane()->id("regularrp")->active()->open();
							echo '<div id="rangepostmessage-div" style="display:none;">';
								$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("List is empty for the given date range at a post.")
								  ->uiType("info")
								  ->show();
							echo '</div>';
							$tableRow= $ui->row()->id('rangepostDutyChartTableRow')->open();
							$table = $ui->table()
										->id('rangepostDutyChartTable')
										->responsive()
										->hover()
										->bordered()
										->striped()
										->sortable()
										->paginated()
										->searchable()
										->open();
						?>
								<thead>
									<tr>
										<th class="print-no-display" width="30px">Photo</th>
										<th><center>Guard Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Duty Date</center></th>
									</tr>
								</thead>

								<tfoot>
									<tr>
										<th class="print-no-display" width="30px">Photo</th>
										<th><center>Guard Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Duty Date</center></th>
									</tr>
								</tfoot>	
						<?php
							$table->close();
							$tableRow->close();
						$tab1->close();
				
				$tab1 = $ui->tabPane()->id("overtimerp")->open();
							echo '<div id="rangepostmessageO-div" style="display:none;">';
								$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("List is empty for the given date range at a post.")
								  ->uiType("info")
								  ->show();
							echo '</div>';
							echo '<div id="totaldurationrp"></div>';
							$tableRow= $ui->row()->id('rangepostDutyChartTableOvertimeRow')->open();
							$table = $ui->table()
											->id('rangepostDutyChartTableOvertime')
											->responsive()
											->hover()
											->bordered()
											->striped()
											->sortable()
											->paginated()
											->searchable()
											->open();
							?>
									<thead>
										<tr>
											<th class="print-no-display" width="30px">Photo</th>
											<th><center>Guard Name</center></th>
											<th><center>From Time</center></th>
											<th><center>To Time</center></th>
											<th><center>Duration</center></th>
											<th><center>Date</center></th>
											
										</tr>
									</thead>

									<tfoot>
										<tr>
											<th class="print-no-display" width="30px">Photo</th>
											<th><center>Guard Name</center></th>
											<th><center>From Time</center></th>
											<th><center>To Time</center></th>
											<th><center>Duration</center></th>
											<th><center>Date</center></th>
										</tr>
									</tfoot>	
							<?php
								$table->close();
						$tableRow->close();
				$tab1->close();
			
			$tabBox->close();
		  $tabsCol->close();
		$tabsRow->close();
$headingBox->close();

?>

<?
$headingBox = $ui->box()
				 ->id('rangeguardDutyChartBox')
				 ->uiType('info')
				 ->title('Details of Guards from <div style="float:right; margin-left:10px;" id="rangeguard-div"></div>')
				 ->solid()
				 ->open();
	$tabsRow = $ui->row()->open();
	  $tabsCol = $ui->col()->open();	
		$tabBox = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Duty Chart")
				   ->tab("regularrg", $ui->icon("bars")."Regular List", true)
				   ->tab("overtimerg", $ui->icon("bars")."Overtime List")
				   ->open();
			
			
			$tab1 = $ui->tabPane()->id("regularrg")->active()->open();
						echo '<div id="rangeguardmessage-div" style="display:none;">';
								$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("List is empty for the given date range for a guard.")
								  ->uiType("info")
								  ->show();
						echo '</div>';
						$tableRow= $ui->row()->id('rangeguardDutyChartTableRow')->open();
						$table = $ui->table()
									->id('rangeguardDutyChartTable')
									->responsive()
									->hover()
									->bordered()
									->striped()
									->sortable()
									->paginated()
									->searchable()
									->open();
					?>
							<thead>
								<tr>
									<th><center>Post Name</center></th>
									<th><center>Shift</center></th>
									<th><center>Duty Date</center></th>
								</tr>
							</thead>

							<tfoot>
								<tr>
									<th><center>Post Name</center></th>
									<th><center>Shift</center></th>
									<th><center>Duty Date</center></th>
								</tr>
							</tfoot>	
					<?php
						$table->close();
					$tableRow->close();
				$tab1->close();
				
				$tab1 = $ui->tabPane()->id("overtimerg")->open();
						echo '<div id="rangeguardmessageO-div" style="display:none;">';
								$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("List is empty for the given date range for a guard.")
								  ->uiType("info")
								  ->show();
						echo '</div>';
								echo '<div id="totaldurationrg"></div>';
								$tableRow= $ui->row()->id('rangeguardDutyChartTableOvertimeRow')->open();
								$table = $ui->table()
									->id('rangeguardDutyChartTableOvertime')
									->responsive()
									->hover()
									->bordered()
									->striped()
									->sortable()
									->paginated()
									->searchable()
									->open();
					?>
							<thead>
								<tr>
									<th><center>Post Name</center></th>
									<th><center>From Time</center></th>
									<th><center>To Time</center></th>
									<th><center>Duration</center></th>
									<th><center>Duty Date</center></th>
								</tr>
							</thead>

							<tfoot>
								<tr>
									<th><center>Post Name</center></th>
									<th><center>From Time</center></th>
									<th><center>To Time</center></th>
									<th><center>Duration</center></th>
									<th><center>Duty Date</center></th>
								</tr>
							</tfoot>	
					<?php
						$table->close();
					$tableRow->close();
				$tab1->close();
			
			$tabBox->close();
		  $tabsCol->close();
		$tabsRow->close();
$headingBox->close();

?>