<?php

	$ui = new UI();

	$data_box = $ui->box()
				   ->uiType('warning')
				   ->solid()
				   ->title('The following details were modified : '.$data_recv->details)
				   ->open();

	$data_box->close();

?>