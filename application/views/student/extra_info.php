<?php

	$ui = new UI();

	$data_box = $ui->box()
				   ->uiType('warning')
				   ->solid()
				   ->title($data_recv->reason)
				   ->open();

	$data_box->close();

?>