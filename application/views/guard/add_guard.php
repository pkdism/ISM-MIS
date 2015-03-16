<?php
$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Enter the details of Guard')
				 ->solid()
				 ->open();
	$form = $ui->form()
		   ->multipart()
		   ->action('guard/manage_guard/add')
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
							   ->id('Regno')
							   ->name('Regno')
							   ->placeholder('Enter Registration Number')
							   ->required()
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
							   	 ->placeholder("Enter Date of Birth")
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
								 ->placeholder("Enter Date of Joining")
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
							   ->addonLeft($ui->icon("building"))
							   ->placeholder('Enter Local Address')
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
							   ->addonLeft($ui->icon("building"))
							   ->placeholder('Enter Permanent Address')
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
							   ->addonLeft($ui->icon("book"))
							   ->placeholder('Enter Qualification')
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
                 $ui->imagePicker()->name('photo')->id('photo')->addonLeft($ui->icon("upload"))->required()->show();
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
						   ->value('Add')
						   ->icon($ui->icon('plus'))
						   ->uiType('primary')
						   ->submit()
						   ->name('addsubmit')
						   ->show();
			$bbuttonCol->close();
			$cbuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(4)
                              ->open();
			$cbuttonCol->close();
	$buttonRow->close();
	
	$form->close();
$headingBox->close();	

?>