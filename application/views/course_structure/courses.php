<?php 
   echo "<h4>".$CS_session['course_name']." (".$CS_session['branch'].") for Session ".$CS_session['session']."</h4>";
   
   $ui = new UI();
    $outer_row = $ui->row()->id('or')->open();
		$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			$formbox =  $ui->box()->id('box_form')->open();
                 $form=$ui->form()->id("add_course_form")->action("course_structure/add/AddCoreSubjects")->multipart()->open();
				   if($CS_session['count_core']>0)
				   {
					 	echo "Enter subjects for semester ".$CS_session['sem'];
						 $table = $ui->table()->responsive()->hover()->bordered()->open();
							echo '
								  <tr>
									<th>Order</th>
									<th>Subject ID</th>
									<th>Subject Name</th>
									<th>Lecture</th>
									<th>Tutorial</th>
									<th>Practical</th>
									<th>Credit Hours</th>
									<th>Type</th>
								  </tr>';
								  for($counter = 1;$counter<=$CS_session['count_core'];$counter++)
								  {
							echo '
								  <tr> 
									<td>';
									$array_option = array();
										for($i=1;$i<=$CS_session['count_core']+$CS_session['count_elective'];$i++) 
										{
											array_push($array_option,$ui->option()->value($i)->text($i));
											//echo '<option value="'.$i.'">'.$i.'</option>';
										} 
										$ui->select()
										   ->label()
										   ->name("sequence".$counter)
										   ->id("sequence_".$counter)
										   ->options($array_option)
										   ->show();
							
							echo '
									</td>      
									<td>';
										$ui->input()
											->placeholder('Subject ID')
											->id('id'.$counter)
											->name('id'.$counter)
											->required()
											->show();
								echo '
									</td>
									<td>';
									$ui->input()
										->placeholder('Subject Name')
										->id('name'.$counter)
										->name('name'.$counter)
										->required()
										->show(); 
								echo '
									</td> 
									<td>';
									$array_option = array();
									//array_push($array_option,$ui->option()->value('""')->text("Lectures")->disabled()->selected());
									for($it = 0;$it<=5;$it++)
										array_push($array_option,$ui->option()->value($it)->text($it));
										
									$ui->select()
									   ->label()
									   ->id("L".$counter)
									   ->name("L".$counter)
									   ->options($array_option)
									   ->required()
									   ->show();
									echo '
									</td>
									<td>';
									$array_option = array();
									//array_push($array_option,$ui->option()->value('""')->text("Tutorials")->disabled()->selected());
									for($it = 0;$it<=5;$it++)
										array_push($array_option,$ui->option()->value($it)->text($it));
										
									$ui->select()
									   ->label()
									   ->id("T".$counter)
									   ->name("T".$counter)
									   ->options($array_option)
									   ->required()
									   ->show();
								echo '
									</td>
									<td>';
									$array_option = array();
									for($it = 0; $it<=10; $it+=0.5)
										array_push($array_option,$ui->option()->value($it)->text($it));
										
									$ui->select()
									   ->label()
									   ->id("P".$counter)
									   ->name("P".$counter)
									   ->options($array_option)
									   ->required()
									   ->show();
								echo '
									</td>
									<td>';
									$ui->input()
											->placeholder('Credit Hours')
											->id('credit_hours'.$counter)
											->name('credit_hours'.$counter)
											->required()
											->show();
								echo '
									</td>
									<td>';
									$array_option = array();
									//array_push($array_option,$ui->option()->value('""')->text("Type"));
									array_push($array_option,$ui->option()->value("Theory")->text("Theory"));
									array_push($array_option,$ui->option()->value("Practical")->text("Practical"));
									array_push($array_option,$ui->option()->value("Sessional")->text("Sessional"));
									array_push($array_option,$ui->option()->value("Non-Contact")->text("Non-Contact"));
									$ui->select()
									   ->label()
									   ->id("type".$counter)
									   ->name("type".$counter)
									   ->options($array_option)
									   ->required()
									   ->show();
								echo '
									</td>
									</tr>  ';
								  }
						 $table->close();
					 
				   }
									
					
		
	//$second_row = $ui->row()->id('or')->open();
		$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			$box =  $ui->box()->id('box')->open();
             	if($CS_session['count_elective']>0)
				{
					echo "<h4>Add Details for Elective Subjects of Semester ".$CS_session['sem']."</h4>";
					$table = $ui->table()->responsive()->hover()->bordered()->id("elective_table")->open();
						if($CS_session['count_elective'] > 1)
						{
							echo '
								<tr>
									<td>Please Select the type for Elective list</td>
									<td>';
										$ui->select()
											->required()
										   ->options(array($ui->option()->value("0")->text("Please Select")->disabled()->selected(),$ui->option()->
										   value("1")->text("Same List For All Electives"),$ui->option()->value("2")->text("Seperate List For All 
										   Electives")))
										   ->id("list-type")
										   ->name("list_type")
										   ->show();
							echo '
									</td>
									</tr>
							';	
						}
						//Display the normal fields if only 1 elective
						if($CS_session['count_elective'] == 1)
						{
							echo '
								<tr>
								  <td>
								  	Enter number of options for Elective 1
								  </td>
								  <td>';
								  $ui->input()->name("options1")->id("options1")->placeholder("Number of subjects in elective list")->show();
								  echo '
								  </td>
								  <td>';
								  $array_option = array();
								  for($j=1;$j<=$CS_session['count_core']+$CS_session['count_elective'];$j++) 
									  array_push($array_option,$ui->option()->value($j)->text($j));
								  $ui->select()
								     ->name("seq_e1")
								     ->id('sequence_'.($CS_session['count_core']+$CS_session['count_elective']))
									 ->options($array_option)
									 ->show();
							echo '
								  </td>
								</tr>';
						}
						else
						{
					echo '
								<tr class = "same_options">
									<td>Please Enter the Number of Options</td>
    								<td>';
										$ui->input()->width("6")->placeholder("Number of options")->name("options1")->show();
								echo '
									</td>
								</tr>';
									
								
								for($i = 1;$i<=$CS_session['count_elective'];$i++)
								{
									echo '
									<tr class="same_options">
										<td>Select order of Elective '.$i.'</td>';
								
								echo '
									<td>';
									$array_option = array();
									for($it = 1;$it<=$CS_session['count_elective']+$CS_session['count_core'];$it++)
										array_push($array_option,$ui->option()->value($it)->text($it));
										$ui->select()
										   ->name("seq_e".$i)
										   ->id('sequence_'.($CS_session['count_core']+$i))
										   ->options($array_option)
										   ->show();
								echo '
									</td></tr>';
								}
								
								for($i = 1;$i<=$CS_session['count_elective'];$i++)
								{
									echo '
									<tr class="diff_options">
										<td>Number of options and order for Elective '.$i.'</td>
										<td>';
											$ui->input()->width("6")->placeholder("Number of options")->name("options".$i)->show();
											
										$array_option = array();
										array_push($array_option,$ui->option()->value($it)->text("Order of Elective ".$i));
										for($it = 1;$it<=$CS_session['count_elective']+$CS_session['count_core'];$it++)
											array_push($array_option,$ui->option()->value($it)->text($it));
										
										$ui->select()
										   ->name("seq_e".$i)
										   ->width("6")
										   ->id('sequence_'.($CS_session['count_core']+$i))
										   ->options($array_option)
										   ->show();	
									echo '
										</td>';
								}
						}
					$table->close();
				}
			$box->close();
		$column1->close();
	//$second_row->close();
				$ui->button()
					->value('Add Core Subjects')
					->uiType('primary')
					->submit()
					->name('submit')
					->show();
		
				 $form->close();
			$formbox->close();
				
		$column1->close();
	$outer_row->close();
	
?>


    
   
    

<script>
  var core_count = <?php echo $CS_session['count_core']; ?>;  
  var elective_count = <?php echo $CS_session['count_elective']; ?>;
  $(document).ready(function(){
    var $list_type = $('#list-type');
    var $elective_table = $('#elective_table');
    $list_type.on('change',function(d){
      if(parseInt($list_type.val()) == 1){
        $('tr.diff_options').hide();
		//$('tr.diff_options').attr("disabled",true);
		$('tr.diff_options').find("input").attr("disabled",true);
	  	$('tr.diff_options').find("select").attr("disabled",true);
	  
		$('tr.same_options').show();
		$('tr.same_options').find("input").attr("disabled",false);
		$('tr.same_options').find("select").attr("disabled",false);
		
      }
      else{
		$('tr.same_options').hide();
        $('tr.same_options').find("input").attr("disabled",true);
		$('tr.same_options').find("select").attr("disabled",true);
		$('tr.diff_options').show();
		$('tr.diff_options').find("input").attr("disabled",false);
		$('tr.diff_options').find("select").attr("disabled",false);
        
      }
    });

  });
  var select_val=[];
  for(i=0;i<elective_count+core_count;i++){
  	select_val[i]=0;
  }  
  $(document).on('change','select[id^="sequence_"]',function(event){

  	var _this = $(this);
  	var id = _this.attr('id');
  	id = id.split('_');
  	id = parseInt(id[1]);
  	
	var flag = true;
	for(i=0;i<elective_count+core_count;i++){
  	
	  	if(select_val[i] === parseInt(_this.val())){
	  		alert('No two subjects can have same sequence number');
	  		flag = false;
	  		_this.focus();
	  		event.preventDefault();
	  	}
	
	}
	if(flag){
		select_val[id] = parseInt(_this.val());
	}
  	
  });
  $(document).ready(function(){
	  $('tr.diff_options').hide();
	  $('tr.same_options').hide();
	  $('tr.same_options').attr("disabled",true);
  });
</script>

