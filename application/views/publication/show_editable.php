<?php

	$ui = new UI();

	$col1 = $ui->col()->width(2)->open();

	$col1->close();


	$col2 = $ui->col()->width(8)->open();
		$box = $ui->box()->uiType('primary')->title('Edit Publlications')->solid()->open();
			$table = $ui->table()->hover()->bordered()->open();
			?>
				<tr>
					<th>Title</th>
					<th>Name</th>
					<th>Authors</th>
					<th>Edit</th>
				</tr>
			<?php 
				for($i=0;$i<sizeof($publications);$i++){
					?>
					<tr>
					<th><?php echo $publications[$i]['title']; ?></th>
					<th><?php echo $publications[$i]['name']; ?></th>
					<th><?php 
						foreach ($publications[$i]['authors']['ism'] as $auth)
							echo $auth->name."<br/>";
						if ($publications[$i]['other_authors']>0)
							foreach ($publications[$i]['authors']['others'] as $auth)
								echo $auth->name."<br/>";
					 ?></th>
					<th><?php echo " <a href='".base_url().'index.php/publication/publication/editpublication/'.$publications[$i]['rec_id']."'>Edit</a>"; ?></th>
				</tr>
			<?php
		}
			$table->close();
		$box->close();
	$col2->close();
?>
