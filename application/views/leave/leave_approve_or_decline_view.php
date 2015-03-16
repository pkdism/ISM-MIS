<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

function format_fields($string) {
    $formated_str = str_replace("_", " ", $string);
    return ucwords($formated_str);
}

$ui = new UI();

// foreach($leave_details as $key => $value) {
//     echo format_fields($key).": ".$value.'<br>';
// }

$ref_self = $_SERVER['PHP_SELF'];
if (isset($args)) {
	$ref_self .= $args;
}
$ref_self = strstr($ref_self, 'index.php');

$row = $ui->row()->open();
	$margincol = $ui->col()->width(2)->open();
	$margincol->close();

	$contentcol = $ui->col()->width(8)->open();
		$box = $ui->box()->title('Leave Approval/Cancel Permission Portal')->uiType('primary')->solid()->open();
			$table = $ui->table()->hover()->bordered()->open();
?>
				<thead>
					<tr>
						<th><center>Feild Name</center></th>
						<th><center>Value</center></th>
					</tr>
				</thead>	
<?php
				foreach($leave_details as $key => $value) {
	 		   echo '<tr><td>'.format_fields($key).'</td><td>'.$value.'</td></tr>';
				}	
			$table->close();
		$box->close();
		$form = $ui->form()->action(base_url().$ref_self)->open();
			$appcol = $ui->col()->width(6)->open();
?>
<center>
<?php
				$ui->button()
		          ->value('Approve')
		          ->submit(true)
		          ->name('approve')
		          ->uiType('primary')
		          ->show();
?>
</center>
<?php
		  $appcol->close();
		  $deccol = $ui->col()->width(6)->open();
?>
<center>
<?php
		    $ui->button()
		          ->value('Decline')
		          ->submit(true)
		          ->name('decline')
		          ->uiType('danger')
		          ->show();
?>
</center>
<?php
	    $deccol->close();
		$form->close();
	$contentcol->close();
$row->close();

//var_dump($leave_details);
?>

<!--
<form action="<?php $ref_self; ?>" method="POST">
    <input type="submit" name="approve" value="Approve">
    <input type="submit" name="decline" value="Decline">
</form>
-->


