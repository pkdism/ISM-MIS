<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

	if(!isset($msg)) {
		$msg = "You haven't performed any action yet.";
	}

	$ui = new UI();

	$row = $ui->row()->open();

		$margin_col = $ui->col()
										 ->width(2)
										 ->open();
		$margin_col->close();

		$container_col = $ui->col()
												->width(8)
												->open();

			$container_box = $ui->box()
													->uiType('primary')
													->solid()
													->open();

				$ui->callout()
				   ->uiType('info')
				   ->title('Confirmation')
				   ->desc($msg)
				   ->show();

			$container_box->close();

		$container_col->close();

	$row->close();