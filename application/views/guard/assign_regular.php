<script type="text/javascript">
$(document).ready(function() {
	$("#remove-guards").hide();
	var guards = JSON.parse('<?php echo json_encode($guards); ?>');
	console.log(guards);
	
	var shiftMap = {
			a: 'c',
			b: 'a',
			c: 'b'
	};
	$("#filltoday").click(function() {
		guards.forEach(function(guard){
			$("#guard-"+guard.Regno).each(function() {
				$(this).find("[name=postname_"+guard.Regno+"c]").val(guard.post_id);
				$(this).find("[name=shift_"+guard.Regno+"c]").val(guard.shift);
			});
		});
	});
	
	$("#autofill").click(function() {
		guards.forEach(function(guard){
			$("#guard-"+guard.Regno).each(function() {
				$(this).find("[name=postname_"+guard.Regno+"]").val(guard.post_id);
				$(this).find("[name=shift_"+guard.Regno+"]").val(shiftMap[guard.shift]);
			});
		});
	});
	
	$("#reset").click(function() {
		guards.forEach(function(guard){
			$("#guard-"+guard.Regno).each(function() {
				$(this).find("[name=postname_"+guard.Regno+"]").val("");
				$(this).find("[name=shift_"+guard.Regno+"]").val("");
			});
		});
	});
		
	$(".remove-checkbox").on('ifChanged',function() {
		if($("input[type=checkbox]:checked.remove-checkbox").length){
			$("#remove-guards").show();
			$("#assign").hide();
		} else {
			$("#remove-guards").hide();
			$("#assign").show();
		}
	});
	$("#remove-guards").click(function(){
		if(!confirm("Are you sure you want to remove the selected guard(s)?")){
			return;
		}
		$("input[type=checkbox]:checked.remove-checkbox").each(function() {
			$(this).closest(".row-guard").remove();
		});
		$(this).hide();
		$("#assign").show();
	});
	
});
</script>
<?php
// getting unique guards in the list
$new_array = array();
$array_regno = array();
foreach($guards as $row)
{
	if(!in_array($row["Regno"],$array_regno))
	{
		array_push($array_regno,$row["Regno"]);
		array_push($new_array,$row);
	}
}
$guards = $new_array;
// end of unique guards

$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Assign the duties for '.date('d M Y',strtotime(date("Y-m-d"))+86400+19800))
				 ->solid()
				 ->open();
		$form = $ui->form()
				   ->multipart()
				   ->action('guard/duties/assign_regular')
				   ->open();
		
		$row = $ui->row()->open();
			$col1 = $ui->col()->width(8)->open();		
				echo '<h5>*Select the guards to remove from the list of assigning duties</h5>';
			$col1->close();

			$col3 = $ui->col()->width(1)->open();
						$ui->button()
					   ->value('Remove')
					   ->uiType('danger')
					   ->id('remove-guards')
					   ->icon($ui->icon('trash-o'))
					   ->mini()
					   ->show();
					   
						$ui->button()
					   ->value('Assign Duty')
					   ->uiType('primary')
					   ->id('assign')
					   ->name('assignment')
					   ->submit()
					   ->mini()
					   ->show();
			$col3->close();
			$col3 = $ui->col()->width(1)->open();

						$ui->button()
					   ->value('Today Fill')
					   ->uiType('primary')
					   ->id('filltoday')
					   ->icon($ui->icon('pencil'))
					   ->mini()
					   ->show();
			$col3->close();
			$col4 = $ui->col()->width(1)->open();
					    $ui->button()
						   ->value('Auto Fill')
						   ->uiType('primary')
						   ->id('autofill')
						   ->icon($ui->icon('pencil'))
						   ->mini()
						   ->show();	
			$col4->close();
			$col2 = $ui->col()->width(1)->open();
						$ui->button()
						   ->value('Reset')
						   ->uiType('warning')
						   ->id('reset')
						   ->icon($ui->icon('refresh'))
						   ->mini()
						   ->show();
			$col2->close();
		$row->close();
			$table = $ui->table()
					->responsive()
					->hover()
					->bordered()
					->striped()
					->sortable()
					->searchable()
					->open();
					?>
							<thead>
								<tr>
									<th width="30px"><center>Photo</center></th>
									<th><center>Guard Name</center></th>
									<th><center>Today Post</center></th>
									<th><center>Today Shift</center></th>
									<th><center>Choose Post</center></th>
									<th><center>Choose Shift</center></th>
								</tr>
							</thead>	
					<?php
						foreach ($guards as $row)
						{
							echo '<tr class="row-guard" id="guard-'.$row['Regno'].'">';
							echo '
									<td style="height: 60px; 
															width: 40px;
															background-image: url('.base_url().'assets/images/guard/'.$row['photo'].');
															background-size: auto 100%;
															background-position: 50% 50%;
															background-repeat: no-repeat;
														"></td>
									<td><center><input type="checkbox" class="remove-checkbox" id="'.$row['Regno'].'"><br>'.$row['firstname'].' '.$row['lastname'].'</center></td>
									
									<td>';
									$postname_array = array();
									if($posts === False)
										$postname_array[] = $ui->option()->value('')->text('No Postname');
									
									else
									{
										$postname_array[] = $ui->option()->value('')->text('')->disabled()->selected();
										foreach ($posts as $postrow)
										{
											$postname_array = array_values($postname_array);
											$postname_array[] = $ui->option()->value($postrow['post_id'])->text($postrow['postname']);
										}
									}
									$ui->select()
									   ->name('postname_'.$row['Regno'].'c')
									   ->addonLeft($ui->icon("building"))
									   ->options($postname_array)
									   ->disabled()
									   ->show();
								echo '</td><td>';		
										  $ui->select()
											 ->name('shift_'.$row['Regno'].'c')
											 ->addonLeft($ui->icon("list"))
											 ->options(array($ui->option()->value('')->text('')->disabled()->selected(),
														$ui->option()->value('a')->text('A'),
														$ui->option()->value('b')->text('B'),
														$ui->option()->value('c')->text('C')))
											 ->disabled()			
											 ->show();
								echo '</td><td>';		
											$ui->select()
												   ->name('postname_'.$row['Regno'])
												   ->addonLeft($ui->icon("building"))
												   ->options($postname_array)
												   ->required()
												   ->show();
								echo '</td><td>';		
										  $ui->select()
											 ->name('shift_'.$row['Regno'])
											 ->addonLeft($ui->icon("list"))
											 ->options(array($ui->option()->value('')->text('')->disabled()->selected(),
														$ui->option()->value('a')->text('A'),
														$ui->option()->value('b')->text('B'),
														$ui->option()->value('c')->text('C')))
											 ->required()			
											 ->show();
								echo '</td>
						</tr>';	
						}
		$table->close();
	$form->close();		
$headingBox->close();

?>
