<?php
$ui = new UI();
	$outer_row = $ui->row()->id('or')->open();
		$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			$box_basic_details =  $ui->box()->id('box_form')->title("Basic Information")->open();	
			$sno = 1;
				$table = $ui->table()->hover()->bordered()->searchable()->sortable()->paginated(true)->open();
				echo '
					<thead>
						<tr>
							<th>S.No</th>
							<th>Date</th>
							<th>Company Name</th>
							<th>Salary(CTC,Gross,Take Home)</th>
							<th>Status</th>
						</tr>
					</thead>
				';
				foreach($company_basic_info as $row)
				{
					$date_from =  date("d-M-Y", strtotime($row->date_from));
					$date_to =  date("d-M-Y", strtotime($row->date_to));
					
					echo '
						<tr>
							<td>'.$sno++.'</td>
							<td>'.((isset($row->date_from) && isset($row->date_to))?($date_from." to ".$date_to):"No Date Proposed").'</td>
							<td>'.$row->company_name."(".$row->job_posting.")<br>(<a href = ".$row->website.">".$row->website."</a>)".'</td>
							<td>'.$row->ctc."<br>".$row->gross."<br>".$row->take_home.'</td>
							<td>';
							if(isset($row->status))
								$ui->label()->uiType("info")->text($row->status)->show(); 
							else
								$ui->label()->uiType("warning")->text("Pending")->show();
					echo 
							'</td>
						</tr>';
				}
				$table->close();
			$box_basic_details->close();
			
		$column1->close();
	$outer_row->close();
?>