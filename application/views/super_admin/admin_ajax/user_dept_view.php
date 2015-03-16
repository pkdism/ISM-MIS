<?php
$ui = new UI();
 $myTable = $ui->table()
							  ->id('usersTable')
							  ->bordered()
							  ->hover()
							  ->striped()
							  ->open();
							  ?>
     <thead>
	<tr>
	<th>Total Users</th><td><? echo count($users); ?></td>
	</tr>
    </thead>
    <tbody>
	<?php if(count($users))	{ ?>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Department</th>
		<th>Operation</th>
	</tr>
	<?php
		foreach($users as $user)
		{
			echo '<td>'.$user->id.'</td>';
			echo '<td>'.$user->salutation.'. '.ucwords(trim($user->first_name)).(($user->middle_name != '')? ' '.ucwords(trim($user->middle_name)):'').(($user->last_name != '')? ' '.ucwords(trim($user->last_name)):'').'</td>';
			echo '<td>'.$user->dept_name.'</td>';
			echo '<td><input type="button" value="Deny" name="deny" onclick="delete_auth('.$user->id.');"/></td>';
		}
	}
	?>
    </tbody>
</table>