<div id="print">
<h2><center>Personal Details of Archived Guards</br>Switch to: <a href="<?= base_url()."index.php/guard/manage_guard/view/current"?>">Current List</a></center></h2>
 <table align="center">
	<tr>
		<th>Registration Number</th>
		<th>Guard Name</th>
		<th class="print-no-display">Photo</th>
		<th>Father's Name</th>
		<th>Permanent Address</th>
		<th>Local Address</th>
		<th>Mobile Number</th>
		<th>Joining Date</th>
		<th>Removed On</th>
	</tr>
	<?php
	foreach($personal_details_of_guards as $key => $guard) { 
		echo '<tr>
				
				<td align="center">'.$guard->Regno.'</td>
				<td><center>'.$guard->firstname.' '.$guard->lastname.'</center></td>
				<td style="height: 60px; 
									width: 40px;
									background-image: url('.base_url().'assets/images/guard/'.$guard->photo.');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
								" class="print-no-display"></td>
				<td align="center">'.$guard->fathersname.'</td>
				<td align="center">'.$guard->permanentaddress.'</td>
				<td align="center">'.$guard->localaddress.'</td>
				<td align="center">'.$guard->mobilenumber.'</td>
				<td align="center">'.date('d M Y',strtotime($guard->dateofjoining)+19800).'</td>
				<td align="center">'.date('d M Y',strtotime($guard->removed_on)+19800).'</td>
			</tr>';
	}
	?>
	</table>
	</div>