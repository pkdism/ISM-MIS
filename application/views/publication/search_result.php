<?php
	$ui = new UI();
	
	for ($i=0; $i<=10; $i++)
		$str[$i]="";
	$num = 0;
	for ($i=0; $i<=10; $i++)
		$current_num[$i]=1;
	for ($i=0; $i<sizeof($publications); $i++)
	{
		$type = $publications[$i]['type_id'];
		$j=$i+1;
		$no_of_ism_authors = $publications[$i]['no_of_authors'] - $publications[$i]['other_authors'];
		$no_of_authors = $publications[$i]['no_of_authors'];
		$str[$type] .= "<tr><td>".$current_num[$type]++.". </td><td> ";
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
	$column1 = $ui->col()->width(12)->open();
		$box = $ui->box()->uiType('primary')->solid()->title('Search Publications')->open();
			echo '<div id="all" >';
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
		$box->close();
	$column1->close();
?>


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