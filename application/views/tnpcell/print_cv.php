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
                  echo $row->title;
              echo '
									</td>
									<td>';
                  echo $row->place;
              echo '
									</td>
									<td>';
                  echo $row->duration." weeks";
              echo '
									</td>
									<td>';
                  echo $row->role;
              echo '
									</td>
									<td>';
                  echo nl2br($row->description);
              echo '
									</td>
									</tr>  ';
		$i++;
    }
    $table->close();
	$box->close();
	 $box = $ui->box()->title("Awards & Achievements")->open();
     $table2 = $ui->table()->responsive()->hover()->bordered()->open();
     foreach($achievements as $row) {
        echo '
              <tr>
              <td colspan="10">  ';
            echo $row->category;
        echo ' </td>
               <td>  ';
            echo nl2br($row->info);
        echo ' </td>
                </tr> ';
     }
     $table2->close();
	$box->close();
		$column1->close();
	$outer_row->close();
?>