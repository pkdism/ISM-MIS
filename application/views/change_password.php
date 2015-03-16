<h1 class="page-head" align="center">Change Password</h1>
<br>
<?= form_open('change_password/update_password') ?>
<table align="center">
<tr>
	<th>Old Password</th>
	<td><input type="password" placeholder="Old Password" name="old_password" required /></td>
</tr>
<tr>
	<th>New Password</th>
	<td><input type="password" placeholder="New Password" name="new_password" required /></td>
</tr>
<tr>
	<th>Confirm Password</th>
	<td><input type="password" placeholder="Confirm Password" name="confirm_password" required /></td>
</tr>
</table>
<br>
<center><input type="submit" name="submit"/></center>
<?= form_close() ?>