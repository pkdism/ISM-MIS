<div id="print">
<h2><center>Details of all Archived Posts</br>Switch to: <a href="<?= base_url()."index.php/guard/manage_post/view/current"?>">Current List</a></center></h2>
 <table align="center">
	<tr>
		<th>Post ID</th>
		<th>Post Name</th>
		<th>Guards in 'A' Shift</th>
		<th>Guards in 'B' Shift</th>
		<th>Guards in 'C' Shift</th>
		<th>Total Guards</th>
		<th>Added On</th>
		<th>Removed On</th>
		
	</tr>
	<?php
	foreach($details_of_posts as $key => $post) { 
		$total = $post->number_a + $post->number_b + $post->number_c;
		echo '<tr>
				<td align="center">'.$post->post_id.'</td>
				<td align="center">'.$post->postname.'</td>
				<td align="center">'.$post->number_a.'</td>
				<td align="center">'.$post->number_b.'</td>
				<td align="center">'.$post->number_c.'</td>
				<td align="center">'.$total.'</td>
				<td align="center">'.$post->added_on.'</td>
				<td align="center">'.$post->removed_on.'</td>
			</tr>';
	}
	?>
	</table>
	</div>