<input type="button" value="Auto Fill" name="autofill" id="autofill" style="float:right"><input type="button" value="Reset" name="reset" id="reset" style="float:right">

<br>
<center>
<?php  echo form_open_multipart('guard/duties/assign_regular');   ?>
<?php 
	$numguards	 = count($guards);
?>
<script type="text/javascript">
$(document).ready(function() {
	(function() {
	  if($("input[type=checkbox]:checked.remove-checkbox").length){
		$("#remove-guards").show();
		$("input[name=assignment]").hide();
	  } else {
		$("#remove-guards").hide();
		$("input[name=assignment]").show();
	  }
	})();
	var guards = JSON.parse('<?php echo json_encode($guards); ?>');
	console.log(guards);
	
	var shiftMap = {
			a: 'c',
			b: 'a',
			c: 'b'
	};
	$("#filltoday").click(function() {
		guards.forEach(function(guard){
			$("#guard-"+guard.Regno).each(function() {
				$(this).find("[name=postname_"+guard.Regno+"]").val(guard.post_id);
				$(this).find("[name=shift_"+guard.Regno+"]").val(guard.shift);
			});
		});
	});
	
	$("#autofill").click(function() {
		guards.forEach(function(guard){
			$("#guard-"+guard.Regno).each(function() {
				$(this).find("[name=postname_"+guard.Regno+"]").val(guard.post_id);
				$(this).find("[name=shift_"+guard.Regno+"]").val(shiftMap[guard.shift]);
			});
		});
	});
	
	$("#reset").click(function() {
		guards.forEach(function(guard){
			$("#guard-"+guard.Regno).each(function() {
				$(this).find("[name=postname_"+guard.Regno+"]").val("");
				$(this).find("[name=shift_"+guard.Regno+"]").val("");
			});
		});
	});
	var rearrange = function(table) {
		var innerTables = $(table).find("table");
		var rows = innerTables.find("tr.row-guard");
		var numrows1 = Math.ceil(rows.length/2);
		var currentTable = $(innerTables[0]);
		if(!rows.length) {
			// currentTable.closest('.guard-table-td').remove();
			currentTable.find('tr').remove();
			currentTable.append('You have removed all the guards from the list.<br><center><input type="button" id="restore-guards" name="restore-guards" value="Restore" onclick="window.location.replace(window.location.href)"/></center>');
			$("input[name=assignment]").remove();
			$("div[id=note-to-remove]").remove();
		}
		rows.slice(0, numrows1).each(function() {
			console.log(currentTable);
			var $this = this;
			var ct = currentTable;
			setTimeout(function() {
				ct.append($this);
			});
		});
		
		currentTable = $(innerTables[1]);
		console.log(rows.length, numrows1);
		if(!(rows.length-numrows1)) {
			// alert("No entries for second table.");
			currentTable.closest('.guard-table-td').remove();
		}
		rows.slice(numrows1, rows.length).each(function() {
			var $this = this;
			var ct = currentTable;
			setTimeout(function() {
				ct.append($this);
			});
		})
	}
	
	$(".remove-checkbox").change(function() {
	  if($("input[type=checkbox]:checked.remove-checkbox").length){
		$("#remove-guards").show();
		$("input[name=assignment]").hide();
	  } else {
		$("#remove-guards").hide();
		$("input[name=assignment]").show();
	  }
	});
	$("#remove-guards").click(function(){
		if(!confirm("Are you sure you want to remove the selected guard(s)?")){
			return;
		}
		$("input[type=checkbox]:checked.remove-checkbox").each(function() {
			$(this).closest("tr").remove();
		});
		rearrange("#outer-table");
		$(this).hide();
		$("input[name=assignment]").show();
	});
	
});
</script>
<?php
$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Assign the duties for '.date('d M Y',strtotime(date("Y-m-d"))+86400+19800))
				 ->solid()
				 ->open();
		echo '<h5>*Select the guards to remove from the list of assigning duties</h5>';		 
		$table = $ui->table()
					->responsive()
					->hover()
					->bordered()
					->striped()
					->sortable()
					->paginated()
					->searchable()
					->open();
					?>
							<thead>
								<tr>
									<th width="30px"><center>Photo</center></th>
									<th><center>Guard Name</center></th>
									<th><center>Today Post</center></th>
									<th><center>Today Shift</center></th>
									<th><center>Choose Post</center></th>
									<th><center>Choose Shift</center></th>
								</tr>
							</thead>	
					<?php
						foreach ($guards as $row)
						{
							echo '<tr class="row-guard" id="guard-'.$row['Regno'].'">';
							echo '
									<td style="height: 60px; 
															width: 40px;
															background-image: url('.base_url().'assets/images/guard/'.$row['photo'].');
															background-size: auto 100%;
															background-position: 50% 50%;
															background-repeat: no-repeat;
														"></td>
									<td><center><input type="checkbox" class="remove-checkbox" id="'.$row['Regno'].'"><br>'.$row['firstname'].' '.$row['lastname'].'</center></td>
									
									<td>
										<select name ="postname_'.$row['Regno'].'" required="required">
										<option value="" disabled="disabled" selected="selected">--------------</option>
										';
											foreach($posts as $postrow)
											{
												echo '<option value = "'.$postrow['post_id'].'">'.$postrow['postname'].'</option>';
											}
									echo '</select>
									</td>
									<td>
										<select name="shift_'.$row['Regno'].'" required="required">
										<option value="" disabled="disabled" selected="selected">---</option>
										<option value="a">A</option>
										<option value="b">B</option>
										<option value="c">C</option>
										</select>
									</td>
									<td>
										<select name ="postname_'.$row['Regno'].'" required="required">
										<option value="" disabled="disabled" selected="selected">--------------</option>
										';
											foreach($posts as $postrow)
											{
												echo '<option value = "'.$postrow['post_id'].'">'.$postrow['postname'].'</option>';
											}
									echo '</select>
									</td>
									<td>
										<select name="shift_'.$row['Regno'].'" required="required">
										<option value="" disabled="disabled" selected="selected">---</option>
										<option value="a">A</option>
										<option value="b">B</option>
										<option value="c">C</option>
										</select>
									</td>
								</tr>
							';	
						}
		$table->close();	
$headingBox->close();

?>
<br>
<input type="button" value="Remove" name="remove_gaurds" id="remove-guards" style="display:none"/>

<?php	echo form_submit('assignment','Assign');
		echo form_close();
?>
</center>