<?php $ui = new UI();
$head = $ui->row()->open();
	$h_col = $ui->col()->width(12)->open();
		$box = $ui->box()->title('Validation Requests')->uiType('primary')->open();
		if(!$emp_validation_details) {
			$this->callout()->title("No Pending Requests")->desc("There are no pending requests.")->show();
		}
		else {
			$table = $ui->table()->bordered()->condensed()->responsive()->open();
			echo "<thead><tr align='center'>
					<td rowspan='2' style='vertical-align:middle' ><b>Employee Id</b></td>
					<td rowspan='2' style='vertical-align:middle' ><b>Employee Name</b></td>
					<td colspan='6' style='vertical-align:middle' ><b>Status</b></td>
				</tr>
				<tr align='center'>
					<td style='vertical-align:middle'><b>Profile Pic</b></td>
					<td style='vertical-align:middle'><b>Basic Details</b></td>
					<td style='vertical-align:middle'><b>Previous Employment Details</b></td>
					<td style='vertical-align:middle'><b>Dependent Family Member Details</b></td>
					<td style='vertical-align:middle'><b>Educational Qualifications</b></td>
					<td style='vertical-align:middle'><b>Last 5 Year Stay Details</b></td>
				</tr></thead><tbody>";

			$i=0;
			foreach($emp_validation_details as $v_row)
			{
				$i++;
				$user = $this->user_details_model->getUserById($v_row->id);
				$emp_name = ucwords($user->salutation.'. '.$user->first_name.(($user->middle_name != '')? ' '.$user->middle_name: '').(($user->last_name != '')? ' '.$user->last_name: ''));

				echo "<tr>
					<td align=\"center\" >".$v_row->id."</td>
					<td align=\"center\">".$emp_name."</td>";

					//profile picture step
				$label = $ui->label()->text(ucwords($v_row->profile_pic_status));
				if($v_row->profile_pic_status=='pending') {
					echo "<td align=\"center\"  >";
					if($this->authorization->is_auth('est_ar'))	echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/0")."'>";
					$label->uiType('info')->show();
					if($this->authorization->is_auth('est_ar'))	echo '</a>';
					echo '</td>';
				}
				else if($v_row->profile_pic_status=='rejected') {
					echo "<td align=\"center\"  ><a onclick=\"reject_reason('0".$i."')\" >";
					$label->uiType('danger')->show();
					echo "</a></td>";
					$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 0));
					echo "<div id='rejected0".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
				}
				else {
					echo "<td align=\"center\"  >";
					$label->uiType('success')->show();
					echo "</td>";
				}

					//basic details step
				$label = $ui->label()->text(ucwords($v_row->basic_details_status));
				if($v_row->basic_details_status=='pending') {
					echo "<td align=\"center\"  >";
					if($this->authorization->is_auth('est_ar'))	echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/1")."'>";
					$label->uiType('info')->show();
					if($this->authorization->is_auth('est_ar'))	echo '</a>';
					echo '</td>';
				}
				else if($v_row->basic_details_status=='rejected') {
					echo "<td align=\"center\"  ><a onclick=\"reject_reason('1".$i."')\" >";
					$label->uiType('danger')->show();
					echo "</a></td>";
					$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 1));
					echo "<div id='rejected1".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
				}
				else {
					echo "<td align=\"center\"  >";
					$label->uiType('success')->show();
					echo "</td>";
				}


				//previous emp details step
				$label = $ui->label()->text(ucwords($v_row->prev_exp_status));
				if($v_row->prev_exp_status=='pending') {
					echo "<td align=\"center\"  >";
					if($this->authorization->is_auth('est_ar'))	echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/2")."'>";
					$label->uiType('info')->show();
					if($this->authorization->is_auth('est_ar'))	echo '</a>';
					echo '</td>';
				}
				else if($v_row->prev_exp_status=='rejected') {	//changes to be done in rejected
					echo "<td align=\"center\"  ><a onclick=\"reject_reason('2".$i."')\" >";
					$label->uiType('danger')->show();
					echo "</a></td>";
					$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 2));
					echo "<div id='rejected2".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
				}
				else {
					echo "<td align=\"center\"  >";
					$label->uiType('success')->show();
					echo "</td>";
				}


				//family details step
				$label = $ui->label()->text(ucwords($v_row->family_details_status));
				if($v_row->family_details_status=='pending') {
					echo "<td align=\"center\"  >";
					if($this->authorization->is_auth('est_ar'))	echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/3")."'>";
					$label->uiType('info')->show();
					if($this->authorization->is_auth('est_ar'))	echo '</a>';
					echo '</td>';
				}
				else if($v_row->family_details_status=='rejected')	//changes to be done in rejected
				{
					echo "<td align=\"center\"  ><a onclick=\"reject_reason('3".$i."')\" >";
					$label->uiType('danger')->show();
					echo "</a></td>";
					$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 3));
					echo "<div id='rejected3".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
				}
				else {
					echo "<td align=\"center\"  >";
					$label->uiType('success')->show();
					echo "</td>";
				}


				//educational details
				$label = $ui->label()->text(ucwords($v_row->educational_status));
				if($v_row->educational_status=='pending') {
					echo "<td align=\"center\"  >";
					if($this->authorization->is_auth('est_ar'))	echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/4")."'>";
					$label->uiType('info')->show();
					if($this->authorization->is_auth('est_ar'))	echo '</a>';
					echo '</td>';
				}
				else if($v_row->educational_status=='rejected')	{ //changes to be done in rejected
					echo "<td align=\"center\"  ><a onclick=\"reject_reason('4".$i."')\" >";
					$label->uiType('danger')->show();
					echo "</a></td>";
					$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 4));
					echo "<div id='rejected4".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
				}
				else {
					echo "<td align=\"center\"  >";
					$label->uiType('success')->show();
					echo "</td>";
				}


				//last 5 yr stay details step
				$label = $ui->label()->text(ucwords($v_row->stay_status));
				if($v_row->stay_status=='pending') {
					echo "<td align=\"center\"  >";
					if($this->authorization->is_auth('est_ar'))	echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/5")."'>";
					$label->uiType('info')->show();
					if($this->authorization->is_auth('est_ar'))	echo '</a>';
					echo '</td>';
				}
				else if($v_row->stay_status=='rejected') {	//changes to be done in rejected
					echo "<td align=\"center\"  ><a onclick=\"reject_reason('5".$i."')\" >";
					$label->uiType('danger')->show();
					echo "</a></td>";
					$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 5));
					echo "<div id='rejected5".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
				}
				else {
					echo "<td align=\"center\"  >";
					$label->uiType('success')->show();
					echo "</td>";
				}
				echo "</tr>";
			}
			echo '</tbody>';
			$table->close();
		}
		$box->close();
	$h_col->close();
$head->close();
?>