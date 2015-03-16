<?php
	$ui = new UI();

	$box = $ui->box()->uiType('primary')->open();
	
	$table = $ui->table()->hover()->bordered()
				->sortable()->searchable()->paginated()
				->open();
?>
	<thead>
		<tr>
			<th>Complaint ID</th>
			<th>Status</th>
			<th>Registered On</th>
			<th>Type of Complaint</th>
			<th>Location</th>
<!--		<th>Location Details</th>
			<th>Problem Details</th>
			<th>Remarks</th> -->
		</tr>
	</thead>
	<?php
			$sno=1;
			while ($sno <= $total_rows)
			{
	?>
				<tr>
					<td><a href="<?php echo site_url("complaint/complaint_details/details/".$data_array[$sno][1]);?>"><?php echo $data_array[$sno][1];?></a></td>
					<td><?php echo $data_array[$sno][2];?></td>
					<td><?php echo $data_array[$sno][3];?></td>
					<td><?php echo $data_array[$sno][4];?></td>
					<td><?php echo $data_array[$sno][5];?></td>
<!--					<td><?php //echo $data_array[$sno][6];?></td>
					<td><?php //echo $data_array[$sno][7];?></td>
					<td><?php //echo $data_array[$sno][8];?></td> -->
				</tr>
<?php
				$sno++;
			}
?>
</table>
<?php
	$table->close();

	$box->close();
?>