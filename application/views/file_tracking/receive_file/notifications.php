<?php
	$ui = new UI();

	if(!$res || $res->num_rows() == 0) {
		$ui->callout()
		   ->uiType("info")
		   ->title("No more notifications")
		   ->desc("You don't have any unread notifications.")
		   ->show();
	}
	else {
//		echo "<h2>Unread Notifications</h2>";
		foreach($res->result() as $row) {
			$ui->callout()
			   ->uiType("info")
			   ->title($row->title)
			   ->desc("<b>" . date("d M Y", strtotime($row->send_date)) . "</b>: " . $row->description ." <a href=\"".site_url($row->path)."\">Know more &raquo;</a>")
			   ->show();
		}
	}
?>