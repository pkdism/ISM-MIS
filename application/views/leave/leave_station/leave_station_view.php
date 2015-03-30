<?php

/* 
 * Author :- Nishant Raj
 */
$ui = new UI();

if ($notification == true) {
    $ui->alert()->uiType($type)->desc($string)->show();
}
$row = $ui->row()->open();
$alertRow = $ui->row()->open();
$marginCol = $ui->col()->width(3)->open();
$marginCol->close();


$alertRow->close();
$margin = $ui->col()->width(2)->open();
$margin->close();


$column = $ui->col()->width(8)->open();

$box = $ui->box()
        ->title('Station Leave Details')
        ->solid()
        ->uiType('primary')
        ->open();
$form = $ui->form()->action('leave/leave_station/applyStationLeave')->open();
$inputRow1 = $ui->row()->open();
$ui->datePicker()
        ->required()
        ->label('Proposed Date Of Leaving Station ')
        ->name('leave_st_date')
    ->id('leave_st_date')
        ->placeholder("Enter the date")
        ->dateFormat('dd-mm-yyyy')
        ->value("")
        ->width(6)
        ->show();
$ui->datePicker()
        ->required()
    ->id('return_st_date')
        ->label('Proposed Date Of Reurning Station')
        ->name('return_st_date')
    ->placeholder(" Select Returning Date")
        ->dateFormat('dd-mm-yyyy')
        ->width(6)
        ->value("")
        ->show();
$inputRow1->close();

$inputRow2 = $ui->row()->id('st_time')
        ->open();
$ui->timePicker()
    ->label('Leaving Time')
    ->name('st_leaving_time')
    ->addonLeft($ui->icon("clock-o"))
    ->uiType('primary')
    ->id('st_leaving_time')
    ->showMeridian('false')
    ->required()
    ->showSeconds('true')
    ->width(6)
    ->show();

$ui->timePicker()
    ->label('Arrival Time')
    ->name('st_arrival_time')
    ->addonLeft($ui->icon("clock-o"))
    ->uiType('primary')
    ->id('st_arrival_time')
    ->showMeridian('false')
    ->required()
    ->showSeconds('true')
    ->width(6)
    ->show();
$inputRow2->close();

$inputRow3 = $ui->row()
        ->open();
$ui->textarea()
        ->required()
        ->placeholder('Purpose Of Leaving station')
        ->type('text')
        ->value("")
        ->label('Purpose Of Leaving station')
        ->name('purpose')
        ->width(6)
        ->show();
$ui->textarea()
        ->required()
        ->placeholder(' Address During Absence From Station')
        ->type('text')
        ->value("")
        ->label('Address During Absence From Station')
    ->id('st_address')
        ->name('address')
        ->width(6)
        ->show();
$inputRow3->close();
$box1 = $ui->box()
    ->title('Please Select Approving Employee')
    ->solid()
    ->id('approving_emp')
    ->uiType('primary')
    ->open();
$inputRow4 = $ui->row()->open();
$ui->select()
    ->label('Department Type')
    ->name('type')
    ->id('type')
    ->required()
    ->options(array($ui->option()->value('""')->text('Select')->selected(),
        $ui->option()->value('academic')->text('Academic'),
        $ui->option()->value('nonacademic')->text('Non Academic')))
    ->width(6)
    ->show();
$ui->select()
    ->label('Select Department')
    ->name('department_name')
    ->id('department_name')
    ->required()
    ->options(array($ui->option()->value('""')->text('Select')))
    ->width(6)
    ->show();
$inputRow4->close();

$inputRow5 = $ui->row()->open();
$ui->select()
    ->label('Designation')
    ->name('designation')
    ->id('designation')
    ->required()
    ->options(array($ui->option()->value('""')->text('Select')))
    ->width(6)
    ->show();
$ui->select()
    ->label('Employee Name')
    ->name('emp_name')
    ->id('emp_name')
    ->required()
    ->options(array($ui->option()->value('""')->text('Select')->selected()))
    ->width(6)
    ->show();
$inputRow5->close();
$box1->close();
?>
<center>
    <?php
$ui->button()
        ->value('Submit Station Leave request')
        ->name('submit')
    ->id('application_submit')
        ->submit(true)
    ->extras('onclick="incrementClick()"')
        ->uiType('primary')
        ->show();
    ?>
</center>
<?php
$form->close();
$box->close();
$column->close();
$row->close();
?>
<script charset="utf-8">
    var index = 0;
    $("#return_st_date").on('change', function () {
        if (this.value != "") {
            $('#st_time').show();
        }
    });
    $("#st_address").on('keyup', function () {
        if (this.value != "") {
            $('#approving_emp').show();
        }
    });

    $(window).load(function () {
        $('#st_time').hide();
        $('#approving_emp').hide();
        $('#success_dialog_fade')
    });
    //$("#date")
</script>