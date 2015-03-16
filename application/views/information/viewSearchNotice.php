<?php
	$ui = new UI();
	$outer_row = $ui->row()->open();
	$column1 = $ui->col()->width(12)->open();
	$table = $ui->table()->responsive()->hover()->bordered()->striped()->id('content')->open();
<table align="center" id ="content">
	<tr>
		
		<th>Notice Number</th>
		<th width="300px">Notice Subject</th>
		<th>Posted On/ Edited On</th>
		<th width="150px">Issued By</th>
		<th width="100px">Revision Status</th>
		<th width="150px">Links</th>
	</tr>
	
	<?php
	foreach($notices as $key => $notice) 
	{ 
		echo '<tr>
				
				<td align="center">'.$notice->notice_no.'</td>
				<td>'.$notice->notice_sub.'</td>
				<td align="center">'.date('d M Y g:i a',strtotime($notice->posted_on)+19800).'</td>
				<td align="center">'.$notice->salutation.' '.$notice->first_name.' '.$notice->middle_name.' '.$notice->last_name.'<br>('.$notice->auth_name.')</td>
				<td align="center">';
					if ($notice->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised '.$notice->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/notice/".$notice->notice_path ?>">Download File</a>
				<?php if ($notice->modification_value != 0 && isset($firstLink))
					  {
					  ?>
					  <br>and</br>
					  <a href="<?= base_url()."index.php/information/view_notice/prev/".$notice->notice_id ?>">Get Prev Versions</a>
					  <?php
					  }
					  ?>
				</td>
			</tr>
	<?php
	}
	?>
	</table><table align="center" id ="content">
	<tr>
		
		<th>Notice Number</th>
		<th width="300px">Notice Subject</th>
		<th>Posted On/ Edited On</th>
		<th width="150px">Issued By</th>
		<th width="100px">Revision Status</th>
		<th width="150px">Links</th>
	</tr>
	
	<?php
	foreach($notices as $key => $notice) { 
		echo '<tr>
				
				<td align="center">'.$notice->notice_no.'</td>
				<td>'.$notice->notice_sub.'</td>
				<td align="center">'.date('d M Y g:i a',strtotime($notice->posted_on)+19800).'</td>
				<td align="center">'.$notice->salutation.' '.$notice->first_name.' '.$notice->middle_name.' '.$notice->last_name.'<br>('.$notice->auth_name.')</td>
				<td align="center">';
					if ($notice->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised '.$notice->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/notice/".$notice->notice_path ?>">Download File</a>
				<?php if ($notice->modification_value != 0 && isset($firstLink))
					  {
					  ?>
					  <br>and</br>
					  <a href="<?= base_url()."index.php/information/view_notice/prev/".$notice->notice_id ?>">Get Prev Versions</a>
					  <?php
					  }
					  ?>
				</td>
			</tr>
	<?php
	}
	?>
	</table>