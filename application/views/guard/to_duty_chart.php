<div id="print">
<?php

$ui = new UI();
$tabsRow = $ui->row()->open();

		$tabBox = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Duty Chart")
				   ->tab("today", $ui->icon("bars")."Today Chart", true)
				   ->tab("tomorrow", $ui->icon("bars")."Tomorrow Chart")
				   ->tab("complete", $ui->icon("bars")."Complete Chart")
				   ->open();
			
			
			$tab1 = $ui->tabPane()->id("today")->active()->open();
				if(count($details_of_guards_at_a_date_today)==0)
				{
					$box = $ui->callout()
							  ->title("Empty List")
							  ->desc("There is no duty for any guard today.")
							  ->uiType("info")
							  ->show();
				}
				else
				{	
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
										<th><center>Replace</center></th>
										<th><center>Remove</center></th>
									</tr>
								</thead>

								<tfoot>
									<tr>
										<th class="print-no-display" width="30px">Photo</th>
										<th><center>Guard Name</center></th>
										<th><center>Post Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Replace</center></th>
										<th><center>Remove</center></th>
									</tr>
								</tfoot>	
						<?php	
							$table->close();
				}
				$tab1->close();
			
				$tab1 = $ui->tabPane()->id("tomorrow")->open();
					if(count($details_of_guards_at_a_date_tomorrow)==0)
					{
						$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("There is no duty for any guard tomorrow.")
								  ->uiType("info")
								  ->show();
					}
					else
					{
						$table = $ui->table()
										->id('tomorrowDutyChartTable')
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
										<th><center>Replace</center></th>
										<th><center>Remove</center></th>
									</tr>
								</thead>

								<tfoot>
									<tr>
										<th class="print-no-display" width="30px">Photo</th>
										<th><center>Guard Name</center></th>
										<th><center>Post Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Replace</center></th>
										<th><center>Remove</center></th>
									</tr>
								</tfoot>	
						<?php	
							$table->close();
					}
				$tab1->close();
				$tab1 = $ui->tabPane()->id("complete")->open();
					if(count($all_duties_chart)==0)
					{
						$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("There is no duty for any guard today.")
								  ->uiType("info")
								  ->show();
					}
					else
					{	
								$table = $ui->table()
											->id('compDutyChartTable')
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
						}
				$tab1->close();
	   $tabBox->close();
$tabsRow->close();
				 
?>
</div>