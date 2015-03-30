<script>
$(document).ready(function(){
	$('select[name="purpose"]').change(function(){
		var value  = this.value;
		if(value == 'personal'){
			$("#application_file").removeAttr("required");
			$("#fileRow").hide();
		}
		else{
			$("#application_file").attr("required","required");
			$("#fileRow").show();
		}
	});
	$("#buttonRow").hide();
	$("select[name=no_of_guests]").change(function() {
		var html = $("#guest-details-tpl").html();
		var template = $(html);
		var numGuests = $(this).val();
		numGuests = parseInt(numGuests);
		//console.log(numGuests);
		var box = $("#get-guestdetailscol");
		box.find(".guest-details").remove();
		$("#buttonRow").hide();
		//console.log(box);
		for(var i=0; i<numGuests; i++) {
			var row = template.clone();
			row.addClass("guest-details");
			//console.log(row);
			row.find(".box-title").append('<span class="guest-no"> '+(i+1)+' </span>');
			row.find("#name").attr("name", "guest["+i+"][name]");
			row.find("#designation").attr("name", "guest["+i+"][designation]");
			row.find("#gender").attr("name", "guest["+i+"][gender]");
			row.find("#address").attr("name", "guest["+i+"][address]");
			row.find("#room_preference").attr("name", "guest["+i+"][room_preference]");
			row.find("#boarding_required").attr("name", "guest["+i+"][boarding_required]");
			box.append(row);
		}
		$("#buttonRow").show();
	});
});

</script>
<script type="template" id="guest-details-tpl">
		<?php
		$ui = new UI();
		$guestdetailsRow = $ui->row()
					->id('guestdetailsRow')
					->open();
		$guestdetailsCol = $ui->col()->open();
			$guestdetailsBox = $ui->box()->title('Enter the details of Guest')->open();
					$nameRow = $ui->row()
								  ->open();
								  
						$namelabel = $ui->col()
										  ->width(4)
										  ->t_width(4)
										  ->m_width(12)
										  ->open();
										  echo 'Name';
						$namelabel->close();
					
					
						$nameinput = $ui->col()
										  ->width(8)
										  ->t_width(8)
										  ->m_width(12)
										  ->open();
										  
										$ui->input()
										   ->id('name')
										   ->name('name')
										   ->placeholder('Enter Guest Name')
										   ->required()
										   ->show();
					   $nameinput->close();		
					$nameRow->close();
					
					$designationRow = $ui->row()
								  ->open();
								  
						$designationlabel = $ui->col()
										  ->width(4)
										  ->t_width(4)
										  ->m_width(12)
										  ->open();
										  echo 'Designation';
						$designationlabel->close();
					
					
						$designationinput = $ui->col()
										  ->width(8)
										  ->t_width(8)
										  ->m_width(12)
										  ->open();
										  
										$ui->input()
										   ->id('designation')
										   ->name('designation')
										   ->placeholder('Enter Designation')
										   ->required()
										   ->show();
					   $designationinput->close();		
					$designationRow->close();
					$genderRow = $ui->row()
								->id('genderRow')
								->open();

						$genderlabel = $ui->col()
										  ->width(4)
										  ->t_width(4)
										  ->m_width(12)
										  ->open();
										  echo 'Gender';
						$genderlabel->close();

						$genderinput = $ui->col()
										  ->width(8)
										  ->t_width(8)
										  ->m_width(12)
										  ->open();
										  
										$ui->select()
										   ->name('gender')
										   ->id('gender')
										   ->addonLeft($ui->icon("bars"))
										   ->options(array(
												   $ui->option()->value('M')->text('Male'),
												   $ui->option()->value('F')->text('Female')))
												   ->required()
										   ->show();	
						$genderinput->close();		
					  $genderRow->close();
					  $addressRow = $ui->row()
								->id('addressRow')
								->open();

						$addresslabel = $ui->col()
										  ->width(4)
										  ->t_width(4)
										  ->m_width(12)
										  ->open();
										  echo 'Address';
						$addresslabel->close();

						$addressinput = $ui->col()
										  ->width(8)
										  ->t_width(8)
										  ->m_width(12)
										  ->open();
										  
										$ui->textarea()->name('address')->id('address')->required()->placeholder("Enter the Address")->show();	
					   $addressinput->close();		
					   $addressRow->close();
					  $roomRow = $ui->row()
								->id('roomRow')
								->open();

						$roomlabel = $ui->col()
										  ->width(4)
										  ->t_width(4)
										  ->m_width(12)
										  ->open();
										  echo 'Room Preference';
						$roomlabel->close();

						$roominput = $ui->col()
										  ->width(8)
										  ->t_width(8)
										  ->m_width(12)
										  ->open();
										  
										$ui->select()
										   ->name('room_preference')
										   ->id('room_preference')
										   ->addonLeft($ui->icon("bars"))
										   ->options(array(
												   $ui->option()->value('Double Bedded AC')->text('Double Bedded AC'),
												   $ui->option()->value('Double AC Suit')->text('Double AC Suit')))
												   ->required()
										   ->show();	
						$roominput->close();		
					  $roomRow->close();
					  $boardingRow = $ui->row()
								->id('boardingRow')
								->open();

						$boardinglabel = $ui->col()
										  ->width(4)
										  ->t_width(4)
										  ->m_width(12)
										  ->open();
										  echo 'Boarding Required';
						$boardinglabel->close();

						$boardinginput = $ui->col()
										  ->width(8)
										  ->t_width(8)
										  ->m_width(12)
										  ->open();
										  
										$ui->select()
										   ->name('boarding_required')
										   ->id('boarding_required')
										   ->addonLeft($ui->icon("bars"))
										   ->options(array(
												   $ui->option()->value('no')->text('NO'),
												   $ui->option()->value('yes')->text('YES')))
												   ->required()
										   ->show();	
						$boardinginput->close();		
					  $boardingRow->close();
		$guestdetailsBox->close();
		$guestdetailsCol->close();
	$guestdetailsRow->close();
	?>
</script>
<?php

$ui = new UI();
$boxRow = $ui->row()->open();
$colRow = $ui->col()
			 ->width(3)
             ->open();
$colRow->close();
$colRow = $ui->col()
			 ->width(6)
             ->t_width(12)
             ->m_width(12)
             ->open(); 	


$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Room Booking Application Form')
				 ->solid()
				 ->open();
		$form = $ui->form()
		   ->multipart()
		   ->action('sah/booking/form')
		   ->open();
				 
	$purposeRow = $ui->row()
					->id('purposeRow')
					->open();

			$purposelabel = $ui->col()
                              ->width(4)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Purpose';
            $purposelabel->close();

            $purposeinput = $ui->col()
                              ->width(8)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  
							$ui->select()
							   ->name('purpose')
							   ->addonLeft($ui->icon("bars"))
							   ->options(array(
                                       $ui->option()->value('official')->text('Official'),
                                       $ui->option()->value('personal')->text('Personal')))
                                       ->required()
							   ->show();	
		   $purposeinput->close();		
	$purposeRow->close();
	
	$reasonRow = $ui->row()
					->id('reasonRow')
					->open();

			$reasonlabel = $ui->col()
                              ->width(4)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'If others Please Specify';
            $reasonlabel->close();

            $reasoninput = $ui->col()
                              ->width(8)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  
							$ui->textarea()->name('reason')->placeholder("Enter the purpose")->show();	
		   $reasoninput->close();		
	$reasonRow->close();
	
	$checkinRow = $ui->row()
					->id('checkinRow')
					->open();

			$checkinlabel = $ui->col()
                              ->width(4)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Check-In-Date-Time';
            $checkinlabel->close();

            $checkininput = $ui->col()
                              ->width(8)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  
							$ui->datePicker()
								 ->name('checkin')
							   	 ->placeholder("Select Check-In-Date-Time")
								 ->addonLeft($ui->icon("calendar"))
								 ->dateFormat('yyyy-mm-dd')
								 ->required()
								 ->show();
		   $checkininput->close();		
	$checkinRow->close();
	
	$checkoutRow = $ui->row()
					->id('checkoutRow')
					->open();

			$checkoutlabel = $ui->col()
                              ->width(4)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Check-Out-Date-Time';
            $checkoutlabel->close();

            $checkoutinput = $ui->col()
                              ->width(8)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  
							$ui->datePicker()
								 ->name('checkout')
							   	 ->placeholder("Select Check-Out-Date-Time")
								 ->addonLeft($ui->icon("calendar"))
								 ->dateFormat('yyyy-mm-dd')
								 ->required()
								 ->show();
		   $checkoutinput->close();		
	$checkoutRow->close();
	
	$guestRow = $ui->row()
					->id('guestRow')
					->open();

			$guestlabel = $ui->col()
                              ->width(4)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Whether School Guest?';
            $guestlabel->close();

            $guestinput = $ui->col()
                              ->width(8)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  
							$ui->select()
							   ->name('schoolguest')
							   ->addonLeft($ui->icon("bars"))
							   ->options(array(
									   $ui->option()->value('yes')->text('Yes'),
                                       $ui->option()->value('no')->text('No')))
							   ->show();	
		   $guestinput->close();		
	$guestRow->close();
	
	$fileRow = $ui->row()
					->id('fileRow')
					->open();

			$guestlabel = $ui->col()
                              ->width(4)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Application File';
            $guestlabel->close();

            $guestinput = $ui->col()
                              ->width(8)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  
							 $ui->input()
								->type('file')
								->name('application_file')
								->id('application_file')
								->required()
								->show();
		
		   $guestinput->close();		
			
	$fileRow->close();
	$noofguestRow = $ui->row()
					->id('noofguestRow')
					->open();

			$noofguestlabel = $ui->col()
                              ->width(4)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Number of Guests';
            $noofguestlabel->close();

            $noofguestinput = $ui->col()
                              ->width(8)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  
							$ui->select()
							   ->name('no_of_guests')
							   ->addonLeft($ui->icon("bars"))
							   ->options(array(
                                       $ui->option()->value('0')->text('0')->disabled()->selected(),
                                       $ui->option()->value('1')->text('1'),
									   $ui->option()->value('2')->text('2'),
									   $ui->option()->value('3')->text('3'),
									   $ui->option()->value('4')->text('4'),
									   $ui->option()->value('5')->text('5'),
									   $ui->option()->value('6')->text('6')))
                                       ->required()
							   ->show();	
		   $noofguestinput->close();		
	$noofguestRow->close();
	$guestdetailsRow  = $ui->row()->open();
		$guestdetailsCol = $ui->col()->id('get-guestdetailscol')->open();
		$guestdetailsCol->close();
	$guestdetailsRow->close();
	$buttonRow = $ui->row()->id('buttonRow')
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
						   ->value('Submit')
						   ->uiType('primary')
						   ->submit()
						   ->name('submit')
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
$colRow->close();
$colRow = $ui->col()
			 ->width(3)
             ->open();
$colRow->close();

?>