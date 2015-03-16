<?php
$ui = new UI();
	$outer_row = $ui->row()->id('or')->open();
		$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			$box_basic_details =  $ui->box()->id('box_form')->title("Basic Information")->open();	
				$table = $ui->table()->responsive()->hover()->bordered()->open();
				//var_dump( $auth_type);
				foreach($company_basic_info as $row)
				{
					echo '
					<thead>
						<tr>
							<th>Company Name</th>
							<td>'.$row->company_name.'</td>
						</tr>';
						if(!in_array('stu',$auth_type))
						{
						echo '
						<tr>
							<th>Contact Person</th>
							<td>'.$row->name.'</td>
						</tr>
						<tr>
							<th>Designation</th>
							<td>'.$row->designation.'</td>
						</tr>
						<tr>
							<th>Email ID</th>
							<td>'.$row->user_id.'</td>
						</tr>
						<tr>
							<th>Address</th>
							<td>'.$row->postal_address.'</td>
						</tr>
						<tr>
							<th>Mobile</th>
							<td>'.$row->mobile.'</td>
						</tr>
						<tr>
							<th>Direct Number</th>
							<td>'.$row->board.'</td>
						</tr>
						<tr>
							<th>FAX</th>
							<td>'.$row->fax.'</td>
						</tr>';
						}
						echo '
						<tr>
							<th>Website</th>
							<td>'.$row->website.'</td>
						</tr>
					</thead>
					';
				}
				$table->close();
			$box_basic_details->close();
			
			$box_company_details =  $ui->box()->id('box_form')->title("Company Details")->open();	
				$table = $ui->table()->responsive()->hover()->bordered()->open();
				foreach($company_details as $row)
				{
					echo '
					<thead>
						<tr>
							<th width = "50%">Category</th>
							<td>'.$row->category.'</td>
						</tr>
						<tr>
							<th>Sector</th>
							<td>'.$row->industry.'</td>
						</tr>
						<tr>
							<th>Job Designation</th>
							<td>'.$row->job_designation.'</td>
						</tr>
						<tr>
							<th>Job Description</th>
							<td>'.$row->job_description.'</td>
						</tr>
						<tr>
							<th>Job Loaction</th>
							<td>'.$row->job_posting.'</td>
						</tr>
					</thead>';
				}
				$table->close();
			$box_basic_details->close();
			
			$box_company_details =  $ui->box()->id('box_form')->title("Eligible Course and Branches")->open();	
				$table = $ui->table()->responsive()->hover()->bordered()->open()->sortable();
				
				echo '
					<thead>
						<tr>
							<th>Department</th>
							<th>Course</th>
							<th>Branch</th>
							<th>Strength</th>
						</tr>
					</thead>		
				';
				foreach($company_eligible_branches as $row)
				{
					echo '
						<tr>
							<td>'.$row->dept_name.'</td>
							<td>'.$row->c_name.'</td>
							<td>'.$row->b_name.'</td>
							<td>To be done</td>
						</tr>';
				}
				$table->close();
			$box_basic_details->close();
			
			$box_eligibilitycriteria =  $ui->box()->id('box_form')->title("Eligible Criteria")->open();	
				$table = $ui->table()->responsive()->hover()->bordered()->open()->sortable();				
				echo '
					<thead>
						<tr>
							<td>Course</td>
							<th>10th Marks</th>
							<th>12th Marks</th>
							<th>Under Graduate(U.G)</th>
							<th>Post Graduate(P.G)</th>
						</tr>
					</thead>';
				foreach($company_selectioncutoff as $row)
				{
					echo '
						<tr>
							<td>'.$row->name.'</td>
							<td>'.$row->marks_10.'</td>
							<td>'.$row->marks_12.'</td>
							<td>'.$row->UG.'</td>
							<td>'.$row->PG.'</td>
						</tr>';
				}
				$table->close();
			$box_eligibilitycriteria->close();
			
			
			$box_company_details =  $ui->box()->id('box_form')->title("Salary Details")->open();	
				$table = $ui->table()->responsive()->hover()->bordered()->open();
				foreach($company_salary as $row)
				{
					echo '
					<thead>
						<tr>
							<th width = "50%">Cost to company(CTC)</th>
							<td>'.$row->ctc.'</td>
						</tr>
						<tr>
							<th>Gross Salary</th>
							<td>'.$row->gross.'</td>
						</tr>
						<tr>
							<th>Take Home Salary</th>
							<td>'.$row->take_home.'</td>
						</tr>
					</thead>';
				}
				$table->close();
			$box_basic_details->close();
			
			
			$box_company_details =  $ui->box()->id('box_form')->title("Selection Process")->open();	
			  foreach($company_selectionprocess as $row)
			  {
				 // echo "hii";
				  $row1 = $ui->row()->id('row1')->open();
					$col1 = $ui->col()->width(6)->t_width(12)->m_width(12)->open();
						$table1 = $ui->table()->responsive()->hover()->bordered()->open();
							echo '
							<tr>
								<td width = "50%">Year Gap Allowed</td>
								<td>'.(($row->year_gap == 0)?"NO":$row->year_gap." Years").'</td>
							</tr>
							<tr>
								<td>Written Test(Technical)</td>
								<td>'.(($row->written_tech == 0)?"N1":"YES").'</td>
							</tr>
							<tr>
								<td>Group Discussion</td>
								<td>'.(($row->gd == 0)?"N2":"YES").'</td>
							</tr>
							<tr>
								<td>HR Interview</td>
								<td>'.(($row->hr_interview== 0)?"N3":"YES").'</td>
							</tr>
							<tr>
								<td>Number of offers</td>
								<td>'.$row->number_of_offer.'</td>
							</tr>
							';
						$table1->close();		
					$col1->close();
					$col2 = $ui->col()->width(6)->t_width(12)->m_width(12)->open();
						$table2 = $ui->table()->responsive()->hover()->bordered()->open();
							echo '
							<tr>
								<td width = "50%">Shortlist From Resumes</td>
								<td>'.(($row->shortlist_resume == 0)?"NO":$row->shortlist_resume).'</td>
							</tr>
							<tr>
								<td>Written Test(Non-Technical)</td>
								<td>'.(($row->written_ntech == 0)?"NO":"YES").'</td>
							</tr>
							<tr>
								<td>Technical Interview</td>
								<td>'.(($row->tech_interview== 0)?"NO":"YES").'</td>
							</tr>
							<tr>
								<td>Total Rounds</td>
								<td>'.$row->total_round.'</td>
							</tr>
							<tr>
								<td>Bond Details</td>
								<td>'.(($row->bond== 0)?"NO":$row->bond_details).'</td>
							</tr>
							';
						$table2->close();		
					$col2->close();
				$row1->close();
			  }
			  
			  $box_company_details->close();

				
			$box_company_details =  $ui->box()->id('box_form')->title("Salary Details")->open();	
				$table = $ui->table()->responsive()->hover()->bordered()->open();
				foreach($company_logistics as $row)
				{
					echo '
					<thead>
						<tr>
							<th  width="50%">Pre-Placement Talk</th>
							<td>'.(($row->ppt_room == 0)?"NO":"YES").'</td>
						</tr>
						<tr>
							<th>Computer Required</th>
							<td>'.(($row->laptop == 0)?"NO":"YES").'</td>
						</tr>
						<tr>
							<th>Projector Required</th>
							<td>'.(($row->projector == 0)?"NO":"YES").'</td>
						</tr>
						<tr>
							<th>Printer Required</th>
							<td>'.(($row->printer == 0)?"NO":"YES").'</td>
						</tr>
						<tr>
							<th>Number of Rooms Required</th>
							<td>'.(($row->interview_room == 0)?"NO":"YES").'</td>
						</tr>
						<tr>
							<th>Any Other Requirement</th>
							<td>'.(($row->any_other == 0)?"NO": $row->any_other).'</td>
						</tr>
					</thead>';
				}
				$table->close();
			$box_basic_details->close();
			
			
				$ui->button()
					->value('Print')
					->uiType('primary')
					->id("btnprint")
					->icon($ui->icon("print"))
					->name('btnprint')
					->show();
		$column1->close();
	$outer_row->close();
?>