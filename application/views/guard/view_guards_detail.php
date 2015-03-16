<?php
$ui = new UI();
$tabsRow = $ui->row()->open();

		$tabBox = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Details of Guards")
				   ->tab("current", $ui->icon("bars")."Current List", true)
				   ->tab("archived", $ui->icon("bars")."Archived List")
				   ->open();
			
			
			$tab1 = $ui->tabPane()->id("current")->active()->open();
				if(count($personal_details_of_guards)==0)
				{
					$box = $ui->callout()
							  ->title("Empty List")
							  ->desc("There is no guard in the current list.")
							  ->uiType("info")
							  ->show();
				}				
				else
				{
					$table = $ui->table()
					->id('currentTable')
					->responsive()
					->hover()
					->bordered()
					->striped()
					->sortable()
					->searchable()
					->paginated()
					->open();
	?>
						<thead>
							<tr>
								<th class="print-no-display" width="30px">Photo</th>
								<th><center>Guard Name</center></th>
								<th><center>Mobile Number</center></th>
								<th><center>Local Address</center></th>
								<th><center>Joining Date</center></th>
								<th><center>Edit</center></th>
								<th><center>Remove</center></th>
							</tr>
						</thead>
						<?php	
						foreach($personal_details_of_guards as $key => $guard) { 
							echo '<tr>';
							echo '
								<td style="height: 50px; 
													width: 30px;
													background-image: url('.base_url().'assets/images/guard/'.$guard->photo.');
													background-size: auto 100%;
													background-position: 50% 50%;
													background-repeat: no-repeat;
												" data-photo-url="'.base_url().'assets/images/guard/'.$guard->photo.'" class="print-no-display photo-zoom"></td>
								<td><center>'.$guard->firstname.' '.$guard->middlename.' '.$guard->lastname.'</center></td>
								<td align="center">'.$guard->mobilenumber.'</td>
								<td align="center">'.$guard->localaddress.'</td>
								<td align="center">'.date('d M Y',strtotime($guard->dateofjoining)+19800).'</td>
								<td align="center" class="print-no-display">';
						?>
									  <a href="<?= base_url()."index.php/guard/manage_guard/edit/".$guard->Regno ?>" onclick="return confirm('Are you sure you want to edit?')">
									  <?php
										$ui->button()
										   ->uiType('primary')
										   ->icon($ui->icon('edit'))
										   ->mini()
										   ->value('Edit')
										   ->show();
									  ?>
									  </a>
									  </td><td align="center" class="print-no-display">
									  <a href="<?= base_url()."index.php/guard/manage_guard/remove/".$guard->Regno ?>" onclick="return confirm('Are you sure you want to remove?')">
									  <?php
										$ui->button()
										   ->uiType('danger')
										   ->icon($ui->icon('remove'))
										   ->mini()
										   ->value('Remove')
										   ->show();
									  ?>
									  </a>
								</td>
						<?php
							echo '</tr>';
						}
					$table->close();
				}
			$tab1->close();
			
			$tab1 = $ui->tabPane()->id("archived")->open();
				if(count($personal_details_of_guards_archive)==0)
				{
					$box = $ui->callout()
							  ->title("Empty List")
							  ->desc("There is no guard in the archived list.")
							  ->uiType("info")
							  ->show();
				}
				else
				{
					$table = $ui->table()
					->id('archivedTable')
					->responsive()
					->hover()
					->bordered()
					->striped()
					->sortable()
					->searchable()
					->paginated()
					->open();
	?>
						<thead>
							<tr>
								<th class="print-no-display" width="30px">Photo</th>
								<th><center>Guard Name</center></th>
								<th><center>Mobile Number</center></th>
								<th><center>Father's Name</center></th>
								<th><center>Local Address</center></th>
								<th><center>Permanent Address</center></th>
								<th><center>Joining Date</center></th>
								<th><center>Removed On</center></th>
							</tr>
						</thead>
						<?php	
						foreach($personal_details_of_guards_archive as $key => $guard) { 
							echo '<tr>';
							echo '
								<td style="height: 50px; 
													width: 30px;
													background-image: url('.base_url().'assets/images/guard/'.$guard->photo.');
													background-size: auto 100%;
													background-position: 50% 50%;
													background-repeat: no-repeat;
												" data-photo-url="'.base_url().'assets/images/guard/'.$guard->photo.'" class="print-no-display photo-zoom"></td>
								<td><center>'.$guard->firstname.' '.$guard->middlename.' '.$guard->lastname.'</center></td>
								<td align="center">'.$guard->mobilenumber.'</td>
								<td align="center">'.$guard->fathersname.'</td>
								<td align="center">'.$guard->localaddress.'</td>
								<td align="center">'.$guard->permanentaddress.'</td>
								<td align="center">'.date('d M Y',strtotime($guard->added_on)+19800).'</td>
								<td align="center">'.date('d M Y',strtotime($guard->removed_on)+19800).'</td>
							</tr>';
						}
					$table->close();
				}		
			$tab1->close();
	   $tabBox->close();
$tabsRow->close();
?>