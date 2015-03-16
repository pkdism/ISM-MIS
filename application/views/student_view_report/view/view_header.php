<div id="print">
<?php

	 $ui = new UI();
	    $stuRow = $ui->row()->open();
			$col1 = $ui->col()->width(6)->open();
			
			$col2 = $ui->col()->width(3)->open();
			echo "<label>Admission No.</label>";
			$col2->close();
			$col3 = $ui->col()->width(3)->open();
			echo $admn_no;
			$col3->close();
		
				
			$col1->close();
	    $stuRow->close();
?>



