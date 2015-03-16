<script>
    $(document).ready(function () {
        var leave_type;
        //$("#purpose_reason").hide();
        $(".permission_request").hide();
        $("#half_full_leave").hide();
    $("#before_after_noon").hide();
        $('[name="leave_type"]').change(function () {
            leave_type = $(this).val();
            if (leave_type === "Casual Leave") {
                $("#ending_period").show();
                $('label[for=ending_period]').show();
                $('label[for=starting_period]').html('Starting Period ');
            } else if (leave_type === "Restricted Leave") {
                $("#ending_period").hide();
                $('label[for=ending_period]').hide();
                $('label[for=starting_period]').html('Leave Date');
                $("#half_full_leave").hide();
                $("#before_after_noon").hide();
            }
        });
        $('[name="avail_leave_station"]').change(function () {
            if ($(this).val() === "Yes") {
                $(".permission_request").show();
            } else {
                $(".permission_request").hide();
            }
        });
        $("#starting_period,#ending_period").change(function () {
            if ($("#starting_period").val() === $("#ending_period").val()) {
                $("#half_full_leave").show();
            } else {
                $("#half_full_leave").hide();
                $("#before_after_noon").hide();
            }
        });
        $('[name="leave_casual_period"]').change(function () {
            //alert($(this).val());
            //alert(1);
            if ($(this).val() === "Half Leave") {
                $("#before_after_noon").show();
            } else {
                $("#before_after_noon").hide();
            }
        });
    });
</script>

<?php

/**
 * Author: Rakesh
*/

$ui = new UI();

if (isset($is_notification_on)) {
    // if notifications are on
    if ($is_notification_on == TRUE) {

        // if leave application has some errors show them
        if (isset($errors)) {
            $error_str = "";
            foreach ($errors as $error) {
                $error_str = $error_str . $error . '<br>';
            }
//                $this->notification->drawNotification('', $error_str, 'error');
            $ui->alert()
                    ->uiType('danger')
                    ->desc($error_str)
                    ->show();
        }

        // if successful leave application
        else if (isset($success_msg)) {
       //     $this->notification->drawNotification('', $success_msg, 'success');
             $ui->alert()
                    ->uiType('success')
                    ->desc($success_msg)
                    ->show();
            
        }
    }
}

// self reference
$ref_self = $_SERVER['PHP_SELF'];

// $user_name = $this->session->userdata('name');
// $descp = "Welcome " . $user_name;
// $descp2 = "<h4 class='page-head' align='center'>$descp</align></h4>";
// echo $descp2;
// echo "<br>";


$row = $ui->row()->open();

$column1 = $ui->col()->width(2)->open();
$column1->close();

$column2 = $ui->col()->width(8)->open();
$box = $ui->box()
        ->title('Leave Details')
        ->solid()
        ->uiType('primary')
        ->open();


$form = $ui->form()->action("/leave/leave_application")->open(); //action of the form
$inputRow1 = $ui->row()->open();
$auth_id = $this->session->userdata('auth');


$ui->select()
        ->label('Leave Type: ')
        ->name('leave_type')
        ->options(array(
            $ui->option()->value('$')->text('Select'),
            $ui->option()->value('Casual Leave')->text('Casual Leave'),
            $ui->option()->value('Restricted Leave')->text('Restricted Leave')
        ))
        ->width(10)
        ->show();

$inputRow1->close();

$inputRowBy1 = $ui->row()
        ->id('purpose_reason')
        ->open();
$ui->textarea()
        ->placeholder('Purpose Of Leave')
        ->type('text')
        ->value("")
        ->label('Purpose Of Leave')
        ->name('leave_purpose')
        ->width(12)
        ->show();
$inputRowBy1->close();

$inputRow2 = $ui->row()->open();
$ui->datePicker()
        ->label('Starting Date')
        ->name('leave_start_date')
        ->id('starting_period')
        ->dateFormat('dd-mm-yyyy')
        ->width(6)
        ->value("")
        ->show();
$ui->datePicker()
        ->label('Ending Date')
        ->name('leave_end_date')
        ->id('ending_period')
        ->value("")
        ->width(6)
        ->show();
$inputRow2->close();

$inputRowBy22 = $ui->row()
        ->id('half_full_leave')
        ->open();
$ui->select()
        ->label('Leave Half Or Full ')
        ->name('leave_casual_period')
        ->options(array(
            $ui->option()->value('$')->text('Select'),
            $ui->option()->value('Half Leave')->text('Half Leave'),
            $ui->option()->value('Full Leave')->text('Full Leave')
        ))
        ->width(5)
        ->show();
$inputRowBy22->close();

$inputRowBy32 = $ui->row()
        ->id('before_after_noon')
        ->open();
$ui->select()
        ->label('Leave Before Noon Or After Noon')
        ->name('leave_j_noon')
        ->options(array(
            $ui->option()->value('$')->text('Select'),
            $ui->option()->value('Before Noon')->text('Before Noon'),
            $ui->option()->value('After Noon')->text('After Noon')
        ))
        ->width(5)
        ->show();
$inputRowBy32->close();

// vacation form
$inputRow3 = $ui->row()->open();
$ui->select()
        ->label('Request For Permission To Leave Station')
        ->name('avail_leave_station')
        ->options(array(
            $ui->option()->value('$')->text('Select'),
            $ui->option()->value('Yes')->text('Yes'),
            $ui->option()->value('No')->text('No'))
        )
        ->width(10)
        ->show();
$inputRow3->close();

$inputRow4 = $ui->row()
        ->classes('permission_request')
        ->open();
$ui->datePicker()
        ->label('Proposed Date Of Leaving Station ')
        ->name('leave_st_date')
        ->placeholder("Enter the date")
        ->dateFormat('dd-mm-yyyy')
        ->value("")
        ->width(6)
        ->show();
$ui->datePicker()
        ->label('Proposed Date Of Reurning Station')
        ->name('return_st_date')
        ->placeholder("Enter the date")
        ->dateFormat('dd-mm-yyyy')
        ->width(6)
        ->value("")
        ->show();
$inputRow4->close();

$inputRow5 = $ui->row()
        ->classes('permission_request')
        ->open();
$ui->datePicker()
        ->label('Proposed time Of Leaving Station ')
        ->name('leave_st_time')
        ->placeholder("Enter the time")
        ->dateFormat('dd-mm-yyyy')
        ->value("")
        ->width(6)
        ->show();
$ui->datePicker()
        ->label('Proposed time Of Reurning Station')
        ->name('return_st_time')
        ->placeholder("Enter the time")
        ->dateFormat('dd-mm-yyyy')
        ->width(6)
        ->value("")
        ->show();
$inputRow5->close();

$inputRow6 = $ui->row()
        ->classes('permission_request')
        ->open();
$ui->textarea()
        ->placeholder('Purpose Of Leaving station')
        ->type('text')
        ->value("")
        ->label('Purpose Of Leaving station')
        ->name('file_no')
        ->width(6)
        ->show();
$ui->textarea()
        ->placeholder(' Address During Absence From Station')
        ->type('text')
        ->value("")
        ->label('Address During Absence From Station')
        ->name('file_no')
        ->width(6)
        ->show();
$inputRow6->close();
?>
<center>
<?php
$ui->button()
        ->value('Submit Leave request')
        ->name('submit')
        ->submit(true)
        ->uiType('primary')
        ->show();

$form->close();
$box->close();

$column2->close();

$row->close();
?>
</center>