<script>
$(document).ready(function(){	
	var photopath = "<?php echo $details_of_a_guard['photo'];?>";
	$("#edit_photo_container"+" img").attr("src", base_url()+'assets/images/guard/'+photopath);	
});
</script>
<?php
$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Edit the details of Guard <div style="height: 30px; 
									width: 30px;
									background-image: url('.base_url().'assets/images/guard/'.$details_of_a_guard['photo'].');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
									float: right;
									margin-left: 10px;
									"
									data-photo-url="'.base_url().'assets/images/guard/'.$details_of_a_guard['photo'].'"
									class="print-no-display photo-zoom"></div>')
				 ->solid()
				 ->open();
	$form = $ui->form()
		   ->multipart()
		   ->action('guard/manage_guard/edit')
		   ->open();
						  
	$registrationRow = $ui->row()
					->id('searchRow')
					->open();

			$registrationlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Registration Number';
            $registrationlabel->close();

            $registrationinput = $ui->col()
                              ->width(10)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  
							$ui->input()
							   ->id('Regnos')
							   ->name('Regnos')
							   ->value($details_of_a_guard['Regno'])
							   ->disabled()
							   ->show();	
		   $registrationinput->close();		
	$registrationRow->close();
	$guardRow = $ui->row()
					->id('guardRow')
					->open();

		    $guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Guard Name';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('firstname')
							   ->name('firstname')
							   ->placeholder('Enter First Name')
							   ->value($details_of_a_guard['firstname'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
			$guardlabel = $ui->col()
                              ->width(3)
                              ->t_width(6)
                              ->m_width(12)
                              ->open();
                              $ui->input()
							   ->id('middlename')
							   ->name('middlename')
							   ->placeholder('Enter Middle Name')
							   ->value($details_of_a_guard['middlename'])
							   ->show();

            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(3)
                              ->t_width(6)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('lastname')
							   ->name('lastname')
							   ->placeholder('Enter Last Name')
							   ->value($details_of_a_guard['lastname'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
	$guardRow->close();
	$fatherRow = $ui->row()
					->id('fatherRow')
					->open();

		    $guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Father\'s Name';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('fathersname')
							   ->name('fathersname')
							   ->placeholder('Enter Father\'s Name')
							   ->value($details_of_a_guard['fathersname'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
			$guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Mobile Number';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('mobilenumber')
							   ->name('mobilenumber')
							   ->type('tel')
							   ->addonLeft($ui->icon("mobile"))
							   ->placeholder('Enter Mobile Number')
							   ->value($details_of_a_guard['mobilenumber'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
	$fatherRow->close();
	$dateRow = $ui->row()
					->id('dateRow')
					->open();

		    $guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Date of Birth';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->datePicker()
								 ->name('dateofbirth')
								 ->placeholder('Enter Date of Birth')
							   	 ->value($details_of_a_guard['dateofbirth'])
								 ->addonLeft($ui->icon("calendar"))
								 ->dateFormat('yyyy-mm-dd')
								 ->required()
								 ->show();
							  
			$guardinput->close();
			$guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Date of Joining';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->datePicker()
								 ->name('dateofjoining')
								 ->placeholder('Enter Date of Joining')
								 ->value($details_of_a_guard['dateofjoining'])
								 ->addonLeft($ui->icon("calendar"))
								 ->dateFormat('yyyy-mm-dd')
								 ->required()
								 ->show();
							  
			$guardinput->close();
	$dateRow->close();
	$addressRow = $ui->row()
					->id('addressRow')
					->open();

		    $guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Local Address';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('localaddress')
							   ->name('localaddress')
							   ->placeholder('Enter Local Address')
							   ->addonLeft($ui->icon("building"))
							   ->value($details_of_a_guard['localaddress'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
			$guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Permanent Address';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('permanentaddress')
							   ->name('permanentaddress')
							   ->placeholder('Enter Permanent Address')
							   ->addonLeft($ui->icon("building"))
							   ->value($details_of_a_guard['permanentaddress'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
	$addressRow->close();
	$photoRow = $ui->row()
					->id('photoRow')
					->open();

		    $guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Qualification';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('qualification')
							   ->name('qualification')
							   ->placeholder('Enter Qualification')
							   ->addonLeft($ui->icon("book"))
							   ->value($details_of_a_guard['qualification'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
			$photolabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Photo';
            $photolabel->close();
			$photoinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                 $ui->imagePicker()->name('photo')->id('photo')->addonLeft($ui->icon("upload"))->containerId('edit_photo_container')->show();
				 echo '(*size less than 1 MB jpeg/bmp/png/jpg/gif)';
            $photoinput->close();

	$photoRow->close();
			
	$buttonRow = $ui->row()
					->open();
					
			$abuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(4)
                              ->open();
			$abuttonCol->close();
			$bbuttonCol = $ui->col()
                              ->width(2)
                              ->t_width(8)
                              ->m_width(4)
                              ->open();
							  
						$ui->button()
						   ->value('Save')
						   ->uiType('primary')
						   ->submit()
						   ->icon($ui->icon('save'))
						   ->name('savesubmit')
						   ->show();
			$bbuttonCol->close();
			$cbuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(4)
                              ->open();
			$cbuttonCol->close();
	$buttonRow->close();
	$ui->input()
		   ->id('Regno')
		   ->name('Regno')
		   ->extras("type='hidden'")
		   ->value($details_of_a_guard['Regno'])
		   ->show();	
	$form->close();
$headingBox->close();	

?>