<?php 
	$ui = new UI();

	if ($verify == 1)
	{
	//	function drawNotification($title, $description, $type = "")
		$ui->callout()
		   ->uiType("info")
		   ->title("Track Number Matched.")
		   ->desc("")
		   ->show();
	//	$this->notification->drawNotification("Track Number matched.", "");
	}
	else
	{
	//	function drawNotification($title, $description, $type = "")
		$ui->callout()
		   ->uiType("error")
		   ->title("Track Number not Matched. Try again.")
		   ->desc("")
		   ->show();
	//	$this->notification->drawNotification("Track Number not matched. Try again", "");
	}
?>