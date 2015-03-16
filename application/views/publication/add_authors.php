<?php
	$ui = new UI();
	for ($i=1; $i<=$total_authors; $i++)
	{
		$row = $ui->row()->open();
		$table = $ui->table()->hover()->bordered()->open();
		?><tr><td><?php
		$col = $ui->col()->width(4)->open();
			?>
				Author <?php echo $i; ?>
				</td><td>
			<?php
		$col->close();
		$col1=$ui->col()->width(4)->open();
		$ui->radio()
			->name('author_'.$i.'_type')
			->label('ISM')
			->id($i)
			->style('width: 15px; height: 15px;')
			->extras(' onclick="add_template(this.value,this.id)" ')
			->value('ISM')
			->show();
		$col1->close();
		?>
		</td><td>
		<?php
		$col2 = $ui->col()->width(4)->open();
			$ui->radio()
			->name('author_'.$i.'_type')
			->value('OTHER')
			->label('OTHER')
			->style('width: 15px; height: 15px;')
			->id($i)
			->extras(' onclick="add_template(this.value,this.id)" ')
			->show();
		$col2->close();
		?></td></tr><?php
		$table->close();
		$row->close();
		$row2 = $ui->col()->id('other_author'.$i)->open();		
		$row2->close();
		
	}
	
?>
