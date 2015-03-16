<?php $ui = new UI();
	switch($form)
	{
		case 2: $emp_prev_exp_details = $this->emp_prev_exp_details_model->getPendingDetailsById($emp_id);
				if($emp_prev_exp_details)
				{
					echo '<thead><tr style="text-align:center" >
	                        <td rowspan="2" style="vertical-align:middle" ><b>S no.</b></td>
	                        <td rowspan="2" style="vertical-align:middle" ><b>Full address of Employer</b></td>
	                        <td rowspan="2" style="vertical-align:middle" ><b>Position held</b></td>
	                        <td colspan="2" style="vertical-align:middle" ><b>Organization</b></td>
	                        <td rowspan="2" style="vertical-align:middle" ><b>Pay Scale</b></td>
	                        <td rowspan="2" style="vertical-align:middle" ><b>Remarks</b></td>
	                        <td rowspan="2" style="vertical-align:middle" ><b>Edit/Delete</b></td>
	                    </tr>
	                    <tr align="center">
	                        <td style="vertical-align:middle"><b>From</b></td>
	                        <td style="vertical-align:middle"><b>To</b></td>
	                    </tr></thead><tbody>';
	                    $i=1;
	                    $this->db->trans_start();
	                    foreach($emp_prev_exp_details as $row) {
	                        if($row->remarks == "") $remarks='NA';
	                        else    $remarks = $row->remarks;
	                        echo '<tr name="row[]" align="center">
	                                <td>'.$i.'</td>
	                                <td>'.ucwords($row->address).'</td>
	                                <td>'.ucwords($row->designation).'</td>
	                                <td>'.date('d M Y', strtotime($row->from)).'</td>
	                                <td>'.date('d M Y', strtotime($row->to)).'</td>
	                                <td>'.$row->pay_scale.'</td>
	                                <td>'.ucfirst($remarks).'</td>
	                        		<td>';
	                                    $ui->button()->flat()->id('edit'.$i)->name("edit[]")->uiType("primary")->value("Edit")->icon($ui->icon("pencil"))->extras('onClick="onclick_edit('.$i.',\''.$row->from.'\',\''.$row->to.'\',\''.$joining_date.'\')"')->show();
	                                    $ui->button()->flat()->id('delete2'.$i)->name("delete2[]")->uiType("danger")->value("Delete")->icon($ui->icon("trash-o"))->extras('onClick="onclick_delete('.$i.');"')->show();
	                        echo   '</td></tr>';

	                    	$this->emp_prev_exp_details_model->updatePendingDetailsWhere(array('sno'=>$i),array('id'=>$emp_id,
			    																				'designation'=>$row->designation,
			    																				'from'=>$row->from,
			    																				'to'=>$row->to,
			    																				'pay_scale'=>$row->pay_scale,
			    																				'address'=>$row->address,
			    																				'remarks'=>$row->remarks));
							$i++;
						}
						$this->db->trans_complete();
						echo '</tbody>';
				}
				else
					$ui->callout()->title('Empty')->desc('No Employment Details Found.')->uiType('danger')->show();
				break;

		case 4: $emp_education_details = $this->emp_education_details_model->getPendingDetailsById($emp_id);
				if($emp_education_details)
				{
					echo '<thead><tr align="center">
	                        <td style="vertical-align:middle" ><b>S no.</b></td>
	                        <td style="vertical-align:middle" ><b>Examination</b></td>
	                        <td style="vertical-align:middle" ><b>Course(Specialization)</b></td>
	                        <td style="vertical-align:middle" ><b>College/University/Institute</b></td>
	                        <td style="vertical-align:middle" ><b>Year</b></td>
	                        <td style="vertical-align:middle" ><b>Percentage/Grade</b></td>
	                        <td style="vertical-align:middle" ><b>Class/Division</b></td>
	                        <td style="vertical-align:middle" ><b>Edit/Delete</b></td>
	                        </tr>
	                        </thead><tbody>';
					$i=1;
					$this->db->trans_start();
					foreach($emp_education_details as $row)
					{
						echo '<tr name="row[]" align="center">
									<td>'.$i.'</td>
	                                <td>'.strtoupper($row->exam).'</td>
	                                <td>'.strtoupper($row->branch).'</td>
	                                <td>'.strtoupper($row->institute).'</td>
	                                <td>'.$row->year.'</td>
	                                <td>'.strtoupper($row->grade).'</td>
	                                <td>'.ucwords($row->division).'</td>
	                            	<td>';
	                                	$ui->button()->flat()->id('edit'.$i)->name("edit[]")->uiType("primary")->value("Edit")->icon($ui->icon("pencil"))->extras('onClick="onclick_edit('.$i.')"')->show();
	                                    $ui->button()->flat()->id('delete4'.$i)->name("delete4[]")->uiType("danger")->value("Delete")->icon($ui->icon("trash-o"))->extras('onClick="onclick_delete('.$i.');"')->show();
	                    echo   '</td></tr>';

			    		$this->emp_education_details_model->updatePendingDetailsWhere(array('sno'=>$i),array('id'=>$emp_id,
			    																				'exam'=>$row->exam,
			    																				'branch'=>$row->branch,
			    																				'institute'=>$row->institute,
			    																				'year'=>$row->year,
			    																				'grade'=>$row->grade,
			    																				'division'=>$row->division));
						$i++;
					}
					$this->db->trans_complete();
					echo '</tbody>';
				}
				else
					$ui->callout()->title('Empty')->desc('No Educational Qualifications Found.')->uiType('danger')->show();
				break;

		case 5: $emp_last5yrstay_details = $this->emp_last5yrstay_details_model->getPendingDetailsById($emp_id);
				if($emp_last5yrstay_details)
				{
					echo '<thead><tr align="center">
				              	<td rowspan=2 style="vertical-align:middle" ><b>S no.</b></td>
								<td colspan=2 style="vertical-align:middle" ><b>Duration</b></td>
								<td rowspan=2 style="vertical-align:middle" ><b>Residential Address</b></td>
								<td rowspan=2 style="vertical-align:middle" ><b>Name of District Headquarters</b></td>
								<td rowspan=2 style="vertical-align:middle" ><b>Edit/Delete</b></td>
	                    	</tr>
	                    	<tr align="center">
	                        	<td style="vertical-align:middle" ><b>From</b></td>
	                        	<td style="vertical-align:middle" ><b>To</b></td>
	                    	</tr></thead><tbody>';
					$i=1;
					$this->db->trans_start();
					foreach($emp_last5yrstay_details as $row)
					{
						echo '<tr name=row[] align="center">
								<td>'.$i.'</td>
			    				<td>'.date('d M Y', strtotime($row->from)).'</td>
			    				<td>'.date('d M Y', strtotime($row->to)).'</td>
			    				<td>'.$row->res_addr.'</td>
			    				<td>'.ucwords($row->dist_hq_name).'</td>
								<td>';
	                                	$ui->button()->flat()->id('edit'.$i)->name("edit[]")->uiType("primary")->value("Edit")->icon($ui->icon("pencil"))->extras('onClick="onclick_edit('.$i.')"')->show();
	                                    $ui->button()->flat()->id('delete5'.$i)->name("delete5[]")->uiType("danger")->value("Delete")->icon($ui->icon("trash-o"))->extras('onClick="onclick_delete('.$i.');"')->show();
	                    echo   '</td></tr>';

			    		$this->emp_last5yrstay_details_model->updatePendingDetailsWhere(array('sno'=>$i),array('id'=>$emp_id,
			    																	'from'=>$row->from,
			    																	'to'=>$row->to,
		    																		'res_addr'=>$row->res_addr,
		    																		'dist_hq_name'=>$row->dist_hq_name));
						$i++;
					}
					$this->db->trans_complete();
					echo '</tbody>';
				}
				else
					$ui->callout()->title('Empty')->desc('No Stay Details Found.')->uiType('danger')->show();
				break;
	}

?>