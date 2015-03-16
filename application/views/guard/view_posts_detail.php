<?php
$ui = new UI();
$tabsRow = $ui->row()->open();

		$tabBox = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Details of Posts")
				   ->tab("current", $ui->icon("bars")."Current List", true)
				   ->tab("archived", $ui->icon("bars")."Archived List")
				   ->open();
			
			
			$tab1 = $ui->tabPane()->id("current")->active()->open();
				if(count($details_of_posts)==0)
				{
					$box = $ui->callout()
							  ->title("Empty List")
							  ->desc("There is no post in the current list.")
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
								<th><center>Post Name</center></th>
								<th><center>IP Address of Post</center></th>
								<th><center>Shift A</center></th>
								<th><center>Shift B</center></th>
								<th><center>Shift C</center></th>
								<th><center>Total</center></th>
								<th><center>Edit</center></th>
								<th><center>Remove</center></th>
							</tr>
						</thead>
						<?php	
						foreach($details_of_posts as $key => $post) { 
								$total = $post->number_a + $post->number_b + $post->number_c;
								echo '<tr>
										<td align="center">'.$post->postname.'</td>
										<td align="center"><a href = "http://'.$post->ipaddress.'" target= "_blank" title="'.$post->postname.'">'.$post->ipaddress.'</a></td>
										<td align="center">'.$post->number_a.'</td>
										<td align="center">'.$post->number_b.'</td>
										<td align="center">'.$post->number_c.'</td>
										<td align="center">'.$total.'</td>
										<td align="center" class="print-no-display">
										<a href="'.base_url().'index.php/guard/manage_post/edit/'.$post->post_id.'" onclick="return confirm(\'Are you sure you want to edit?\')">';
										$ui->button()
										   ->uiType('primary')
										   ->icon($ui->icon('edit'))
										   ->mini()
										   ->value('Edit')
										   ->show();
									echo'</a>
										</td>
										<td align="center" class="print-no-display">
										<a href="'.base_url().'index.php/guard/manage_post/remove/'.$post->post_id.'" onclick="return confirm(\'Are you sure you want to remove?\')">';
										$ui->button()
										   ->uiType('danger')
										   ->icon($ui->icon('remove'))
										   ->mini()
										   ->value('Remove')
										   ->show();
									echo'</a>
										</td>
									</tr>';
							}
					$table->close();
				}
			$tab1->close();
			
			$tab1 = $ui->tabPane()->id("archived")->open();
				if(count($details_of_posts_archive)==0)
				{
					$box = $ui->callout()
							  ->title("Empty List")
							  ->desc("There is no post in the archived list.")
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
								<th><center>Post ID</center></th>
								<th><center>Post Name</center></th>
								<th><center>IP Address of Post</center></th>
								<th><center>Guards in 'A' Shift</center></th>
								<th><center>Guards in 'B' Shift</center></th>
								<th><center>Guards in 'C' Shift</center></th>
								<th><center>Total Guards</center></th>
								<th><center>Added On</center></th>
								<th><center>Removed On</center></th>
							</tr>
						</thead>
						<?php	
							foreach($details_of_posts_archive as $key => $post) { 
								$total = $post->number_a + $post->number_b + $post->number_c;
								echo '<tr>
										<td align="center">'.$post->post_id.'</td>
										<td align="center">'.$post->postname.'</td>
										<td align="center">'.$post->ipaddress.'</td>
										<td align="center">'.$post->number_a.'</td>
										<td align="center">'.$post->number_b.'</td>
										<td align="center">'.$post->number_c.'</td>
										<td align="center">'.$total.'</td>
										<td align="center">'.date('d M Y',strtotime($post->added_on)+19800).'</td>
										<td align="center">'.date('d M Y',strtotime($post->removed_on)+19800).'</td>
									</tr>';
							}
					$table->close();
				}		
			$tab1->close();
	   $tabBox->close();
$tabsRow->close();
?>
