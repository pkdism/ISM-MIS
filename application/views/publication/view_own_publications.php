<?php
	$ui = new UI();
	for ($i=0; $i<=10; $i++)
		$str[$i]="";
	$num = 0;
	for ($i=0; $i<=10; $i++)
		$current_num[$i]=1;
	if ($flag == 1)
	{
		for ($i=0; $i<sizeof($publications); $i++)
		{
			$type = $publications[$i]['type_id'];
			$j=$i+1;
			$no_of_ism_authors = $publications[$i]['no_of_authors'] - $publications[$i]['other_authors'];
			$no_of_authors = $publications[$i]['no_of_authors'];
			$str[$type] .= "<tr><td>".$current_num[$type]++.". 	 ";
			$count = 0;
			foreach ($publications[$i]['authors']['ism'] as $key=>$auth)
			{
				if ($count != $no_of_authors-2)
					$str[$type] .= $auth->name.", ";
				else
					$str[$type] .= $auth->name." & ";
				$count++;
			}
			if($publications[$i]['other_authors']>0)
			{
			    foreach ($publications[$i]['authors']['others'] as $key=>$auth)
			    {
					if ($count != $no_of_authors-2)
						$str[$type] .= $auth->name.", ";
					else
						$str[$type] .= $auth->name." & ";
					$count++;
				}  
			}
			if ($type != 5 && $type != 6)
				$str[$type].= "\"".$publications[$i]['title']."\", ";
			if ($type==1 || $type==2)
			{
				$date="";
				for ($k=0; $k<10; $k++)
					$date .= $publications[$i]['begin_date'][$k];
				$str[$type] .= "Published in the ".$publications[$i]['name'].", Vol. ";
				$str[$type] .= $publications[$i]['vol_no'].", No. ";
				$str[$type] .= $publications[$i]['issue_no'].", ".$date.", ";
				$str[$type] .= "pp ".$publications[$i]['page_no'].".";
			}
			else if ($type==3 || $type==4)
			{
				$begin_date = "";
				$end_date = "";
				for ($k=0; $k<10; $k++){
					$begin_date .= $publications[$i]['begin_date'][$k];
					$end_date .= $publications[$i]['end_date'][$k];
				}
				$str[$type] .= "Published in the ".$publications[$i]['name'].", held at ";
				$str[$type] .= $publications[$i]['place']." during ".$begin_date;
				$str[$type] .= " to ".$end_date.", pp ".$publications[$i]['page_no'].".";
			}
			else if ($type == 5)
			{
				$str[$type] .= "authored the book titled ".$publications[$i]['title']." published by ";
				$str[$type] .= $publications[$i]['publisher']." which is currently in its ";
				if ($publications[$i]['edition']%10 == 1)
					$str[$type] .= $publications[$i]['edition']."st edition.";
				else if ($publications[$i]['edition']%10 == 2)
					$str[$type] .= $publications[$i]['edition']."nd edition.";
				else if ($publications[$i]['edition']%10 == 3)
					$str[$type] .= $publications[$i]['edition']."rd edition.";
				else
					$str[$type] .= $publications[$i]['edition']."th edition.";
			}
			else if ($type == 6)
			{
				$str[$type] .= " authored the chapter titled ".$publications[$i]['chapter_name']." in the book ";
				$str[$type] .= $publications[$i]['title']." which is published by ".$publications[$i]['publisher'];
				$str[$type] .= "and is in its ";
				if ($publications[$i]['edition']%10 == 1)
					$str[$type] .= $publications[$i]['edition']."st edition.";
				else if ($publications[$i]['edition']%10 == 2)
					$str[$type] .= $publications[$i]['edition']."nd edition.";
				else if ($publications[$i]['edition']%10 == 3)
					$str[$type] .= $publications[$i]['edition']."rd edition.";
				else
					$str[$type] .= $publications[$i]['edition']."th edition.";
			}
			$str[$type] .= "</td></tr>";
		}
	}
		
	$column1 = $ui->col()->width(12)->open();
	$tabBox1 = $ui->tabBox()
				   ->tab("all", "All",true)
				   ->tab("national_journal", "National Journal")
				   ->tab("international_journal", "International Journal")
				   ->tab("national_conference","National Conference")
				   ->tab("international_conference","International Conference")
				   ->tab("books","Books")
				   ->tab("book_chapter","Book Chapter")
				   ->tab("search","Search")
				   ->open();

	
	$allPublication = $ui->tabPane()->id("all")->active()->open();
		echo '<div id="all" >';
		?><h4><center> All publications of <? echo $own_name; ?></center></h4><?php
		$table = $ui->table()->hover()->bordered()->open();
			for ($i=1; $i<=10; $i++)
				if ($str[$i]!=""){
					if ($i==1){
						?><th colspan="4">National Journal</th><?php
					}
					else if ($i==2){
						?><th colspan="4">International Journal</th><?php
					}
					else if ($i==3){
						?><th colspan="4">National Conference</th><?php
					}
					else if ($i==4){
						?><th colspan="4">International Conference</th><?php
					}
					else if ($i==5){
						?><th colspan="4">Books</th><?php
					}
					else if ($i==6){
						?><th colspan="4">Book Chapters</th><?php
					}
					echo $str[$i]; 
				}
		$table->close();
		echo '</div>';
		?><center><button value = "PRINT" class = " btn btn-primary "onclick="printContent('all')" >PRINT</button></center><?php
	$allPublication->close();

	$nationalJournal = $ui->tabPane()->id("national_journal")->open();
		echo '<div id="print_nat_jour" >';
		?><h4><center> Paper published by <? echo $own_name; ?> in National Journal</center></h4><?php
		$table = $ui->table()->hover()->bordered()->open();
			?><th>National Publication</th><?php
		$table->close();
		echo '</div>';
		?><center><button value = "PRINT" class = " btn btn-primary "onclick="printContent('print_nat_jour')" >PRINT</button></center><?php
	$nationalJournal->close();

	$internationalJournal = $ui->tabPane()->id("international_journal")->open();
		echo '<div id="print_inat_jour" >';
		?><h4><center> Paper published by <? echo $own_name; ?> in International Journal</center></h4><?php
		$table = $ui->table()->hover()->bordered()->open();
			?><th>International Publication</th><?php
			echo $str[2];
		$table->close();
		echo '</div>';
		?><center><button value = "PRINT" class = " btn btn-primary "onclick="printContent('print_inat_jour')" >PRINT</button></center><?php
	$internationalJournal->close();

	$nationalConference = $ui->tabPane()->id("national_conference")->open();
		echo '<div id="print_nat_conf" >';
		?><h4><center> Paper published by <? echo $own_name; ?> in National Conference</center></h4><?php
		$table = $ui->table()->hover()->bordered()->open();
			?><th>National Conference</th><?php
			echo $str[3];
		$table->close();
		echo '</div>';
		?><center><button value = "PRINT" class = " btn btn-primary "onclick="printContent('print_nat_conf')" >PRINT</button></center><?php
	$nationalConference->close();

	$internationalConference = $ui->tabPane()->id("international_conference")->open();
		echo '<div id="print_inat_conf" >';
		?><h4><center> Paper published by <? echo $own_name; ?> in International Conference</center></h4><?php
		$table = $ui->table()->hover()->bordered()->open();
			?><th>International Conference</th><?php
			echo $str[4];
		$table->close();
		echo '</div>';
		?><center><button value = "PRINT" class = " btn btn-primary "onclick="printContent('print_inat_conf')" >PRINT</button></center><?php
	$internationalConference->close();

	$books = $ui->tabPane()->id("books")->open();
		echo '<div id="print_book" >';
		?><h4><center> Books written by <? echo $own_name; ?></center></h4><?php
		$table = $ui->table()->hover()->bordered()->open();
			?><th>Books</th><?php
			echo $str[5];
		$table->close();
		echo '</div>';
		?><center><button value = "PRINT" class = " btn btn-primary "onclick="printContent('print_book')" >PRINT</button></center><?php
	$books->close();

	$book_chapter = $ui->tabPane()->id("book_chapter")->open();
		echo '<div id="print_book_chap" >';
		?><h4><center> Chapters in books written by <? echo $own_name; ?></center></h4><?php
		$table = $ui->table()->hover()->bordered()->open();
			?><th>Book Chapters</th><?php
			echo $str[6];
		$table->close();
		echo '</div>';
		?><center><button value = "PRINT" class = " btn btn-primary "onclick="printContent('print_book_chap')" >PRINT</button></center><?php
	$book_chapter->close();

	$search = $ui->tabPane()->id("search")->open();
		$box = $ui->box()->uiType('primary')->solid()->title('Search Publications')->open();
		$form_attrinutes = array("id"=>"search_publication_form","method"=>"post");
		$form = $ui->form()->action('publication/publication/search_result',$form_attrinutes)->open();
			$table = $ui->table()->hover()->bordered()->open();

				?>
					<tr>
						<th>Department</th>
						<th>
							<?php
								$ui->select()
									->name('department_name')
									->id('department_name')
									->options(array($ui->option()->value('""')->text('Select')))
									->show();
							?>
						</th>
					</tr>
					<tr>
						<th>Faculty</th>
						<th>
							<?php
								$ui->select()
									->name('faculty_name')
									->id('faculty_name')
									->options(
										//$ui->option()->value("all")->text("All"),
										array($ui->option()->value('""')->text('Select')))
									->show();
							?>
						</th>
					</tr>
					<tr>
						<th>Type of Publication</th>
						<th>
							<?php
								$ui->select()
									->name('type_of_pub')
									->id('type_of_pub')
									->options(array(
										$ui->option()->value("all")->text("All"),
										$ui->option()->value(1)->text("National Journal"),
										$ui->option()->value(2)->text("International Journal"),
										$ui->option()->value(3)->text("National Conference"),
										$ui->option()->value(4)->text("International Conference"),
										$ui->option()->value(5)->text("Others")
									))
									->show();
							?>
						</th>
					</tr>
					<tr>
						<th>Start Date</th>
						<th>
							<?php
							$ui->datePicker()->label('Date')
							   ->name('start_date')->placeholder("Enter the date")
							   ->dateFormat('dd-mm-yyyy')->show();
							?>
						</th>
					</tr>
					<tr>
						<th>End Date</th>
						<th>
							<?php
							$ui->datePicker()->label('Date')
							   ->name('end_date')->placeholder("Enter the date")
							   ->dateFormat('dd-mm-yyyy')->show();
							?>
						</th>
					</tr>
				<?php


			$table->close();
		$row = $ui->row()->open(); 
		?><center><?php
			$ui->button()->name('Submit')->value('Submit')->submit(true)->uiType('primary')->show();
		?></center><?php
		$row->close();
		$form->close();
		$box->close();

	$search->close();

	$tabBox1->close();
	$column1->close();
?>

<script charset="utf-8">
	$(document).ready(function() {
		get_dept_query("abc"); // or $(this).val()
	});
	$("#department_name").on('change', function() {
		find_faculty_query(this.value,"abc"); // or $(this).val()
	});
</script>
<script type="text/javascript">
<!--
	function printContent(id){
		str=document.getElementById(id).innerHTML
		newwin=window.open('','printwin','left=100,top=100,width=400,height=400')
		newwin.document.write('<HTML>\n<HEAD>\n')
		newwin.document.write('<TITLE>Print Page</TITLE>\n')
		newwin.document.write('<script>\n')
		newwin.document.write('function chkstate(){\n')
		newwin.document.write('if(document.readyState=="complete"){\n')
		newwin.document.write('window.close()\n')
		newwin.document.write('}\n')
		newwin.document.write('else{\n')
		newwin.document.write('setTimeout("chkstate()",2000)\n')
		newwin.document.write('}\n')
		newwin.document.write('}\n')
		newwin.document.write('function print_win(){\n')
		newwin.document.write('window.print();\n')
		newwin.document.write('chkstate();\n')
		newwin.document.write('}\n')
		newwin.document.write('<\/script>\n')
		newwin.document.write('</HEAD>\n')
		newwin.document.write('<BODY onload="print_win()">\n')
		newwin.document.write(str)
		newwin.document.write('</BODY>\n')
		newwin.document.write('</HTML>\n')
		newwin.document.close()
	}
//-->
</script>