<?php
	$ui = new UI();
    $outer_row = $ui->row()->id('or')->open();
    $column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
	$box = $ui->box()->title("Project/Internship/Excursion/Training")->open();
    $table = $ui->table()->responsive()->hover()->bordered()->open();
							echo '
								  <tr>
									<th>Sl.No</th>
                  <th>Title</th>
                  <th>Place</th>
                  <th>Duration</th>
                  <th>Role</th>
                  <th>Description</th>
								  </tr>';
    $i=1;
    foreach($projects as $row) {
              echo '
								  <tr> 
									<td>';
                  echo $i;
              echo '
									</td>
									<td>';
                  $ui->input()->name("title".$i)->value($row->title)->disabled()->show();
              echo '
									</td>
									<td>';
                  $ui->input()->name("place".$i)->value($row->place)->disabled()->show();
              echo '
									</td>
									<td>';
                  $ui->input()->name("duration".$i)->value($row->duration." weeks")->disabled()->show();
              echo '
									</td>
									<td>';
                  $ui->input()->name("role".$i)->value($row->role)->disabled()->show();
              echo '
									</td>
									<td>';
                  $ui->input()->name("description".$i)->value($row->description)->disabled()->show();
              echo '
									</td>
									<td>  ';
              $ui->button()
                 ->value('Edit')
                 ->uiType('primary')
                 ->id("editbutton_project".$i)
                 ->icon($ui->icon("edit"))
                 ->extras(' onclick = EditProject("'.$i.'","'.$row->id.'")')
                 ->name('edit')
                 ->show();
              echo ' </td>
                </tr>';
		$i++;
    }
    $table->close();
	$box->close();
	$box = $ui->box()->title("Awards & Achievements")->open();
     $table2 = $ui->table()->responsive()->hover()->bordered()->open();
     $i=1;
     foreach($achievements as $row) {
        echo '
              <tr>
              <td>  ';
              $ui->input()->name("category".$i)->value($row->category)->disabled()->show();
        echo ' </td>
               <td>  ';
              $ui->input()->name("info".$i)->value($row->info." weeks")->disabled()->show();
        echo ' </td>
                <td> ';
                $ui->button()
                 ->value('Edit')
                 ->uiType('primary')
                 ->id("editbutton_achievements".$i)
                 ->icon($ui->icon("edit"))
                 ->extras(' onclick = EditAchievements("'.$i.'")')
                 ->name('edit')
                 ->show();
        echo ' </td>
                </tr>';
      $i++;
     }
     $table2->close();
	 $box->close();
		$column1->close();
	$outer_row->close();
?>