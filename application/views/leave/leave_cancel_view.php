<?php
$ui = new UI();
if (isset($is_notification_on) && $is_notification_on == TRUE) {
    
    // if notifications are on    
    if (isset($errors)) {
        $error_str = "";
        foreach($errors as $str) {
            $error_str .= $str.'<br>';
        }
        $ui->alert()
                    ->uiType('danger')
                    ->desc($error_str)
                    ->show();
    }
}

$ref_self = $_SERVER['PHP_SELF'];
    
$row = $ui->row()->open();

$column1 = $ui->col()->width(3)->open();
$column1->close();

$column = $ui->col()->width(6)->open();
    $box = $ui->box()
            ->title('Select Leave Type')
            ->solid()
            ->uiType('primary')
            ->open();

        $ui->select()
            ->id('leave_type_cancel')
            ->label('Type Of Leave')
            ->options(array(
                $ui->option()->value('$')->text('Select'),
                $ui->option()->value('Casual Leave')->text('Casual Leave'),
                $ui->option()->value('Restricted Leave')->text('Restricted Leave')
            ))
            ->show();

    $box->close();
$column->close();
$row->close();

    $row1 = $ui->row()->id('leave_table_container')->open();
    $column3 = $ui->col()->width(1)->open();
    $column3->close();
    $column4 = $ui->col()->width(10)->open();
    $box = $ui->box()
                ->title('Cancellable Leave')
                ->solid()
                ->uiType('primary')
                ->open();
        $form = $ui->form()->action('leave/leave_cancel')->open();

        $table_cancel = $ui->table()->id('leave_to_cancel_table')->hover()->responsive()->sortable()->searchable()->paginated()->bordered()->open();
        $table_cancel->close();

            $ui->button()
                ->type('submit')
                ->value('Cancel')
                ->submit(true)
                ->name('cancel')
                ->uiType('primary')
                ->show();
        $form->close();
    $box->close();
    $column4->close();
    $row1->close();
?>

