<?php

	   $ui = new UI();
	     $stuRow = $ui->row()->open();
			$col1 = $ui->col()->width(12)->open();
				if($user_details)
				{
					 echo '<center><img src="'.base_url().'assets/images/'.strtolower($user_details->photopath).'" width="145" height="150" /></center>';
				}
			$col1->close();
	    $stuRow->close();

?>





