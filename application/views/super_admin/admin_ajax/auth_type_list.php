<?php
	foreach($auths as $auth)
	{
	   echo '<option value="'.$auth->id.'">'.ucwords($auth->type).'</option>';
	}
?>