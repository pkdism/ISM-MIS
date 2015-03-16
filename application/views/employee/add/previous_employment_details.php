<?php $ui = new UI();

if($error!="")
    $ui->alert()->uiType('danger')->title('ERROR')->desc($error)->show();

if($emp_prev_exp_details != FALSE) {
    $upRow = $ui->row()->open();
        $col = $ui->col()->open();
            $box = $ui->box()->title('Previous Employment Details')->uiType('primary')->open();
                $table = $ui->table()->id('tbl2')->responsive()->bordered()->paginated()->striped()->open();
                    echo '<thead valign="middle" ><tr align="center">
                        <th rowspan="2" >S no.</th>
                        <th rowspan="2">Full address of Employer</th>
                        <th rowspan="2">Position held</th>
                        <th colspan="2">Organization</th>
                        <th rowspan="2">Pay Scale</th>
                        <th rowspan="2">Remarks</th>
                    </tr>
                    <tr align="center">
                        <th>From</th>
                        <th>To</th>
                    </tr></thead><tbody>';
                    $i=1;
                    foreach($emp_prev_exp_details as $row) {
                        if($row->remarks == "") $remarks='NA';
                        else    $remarks = $row->remarks;
                        echo '<tr name="row[]" align="center">
                                <td>'.$i.'</td>
                                <td>'.ucwords($row->address).'</td>
                                <td>'.ucwords($row->designation).'</td>
                                <td>'.date('d M Y', strtotime($row->from)).'</td>
                                <td>'.date('d M Y', strtotime($row->to)).'</td>
                                <td>'.$row->pay_scale.'</td>
                                <td>'.ucfirst($remarks).'</td>
                                </tr>';
                        $i++;
                    }
                    echo'</tbody>';
                $table->close();
            $box->close();
        $col->close();
    $upRow->close();
}

$form = $ui->form()->id('prev_emp_details')->action('employee/add/insert_prev_emp_details/'.$add_emp_id)->open();
    $row = $ui->row()->open();
        $col = $ui->col()->width(12)->open();
            $box = $ui->box()->uiType('primary')->title('Add Previous Employment Details')->tooltip("Click Add after entering following details")->open();
                $row11 = $ui->row()->open();
                    $ui->input()->name('addr2')->label('Full address of Employer')->width(12)->show();
                $row11->close();
                $row12 = $ui->row()->open();
                    $ui->datePicker()->name('from2')
                                    ->id('from21')
                                    ->dateFormat('dd-mm-yyyy')
                                    ->addonRight($ui->icon("calendar"))
                                    ->placeholder("dd-mm-yyyy")
                                    ->label('From')->width(3)->t_width(4)
                                    ->extras('max="'.date('d-m-Y',strtotime($joining_date)).'"') //max not working
                                    ->show();
                    $ui->datePicker()->name('to2')
                                    ->id('to21')
                                    ->dateFormat('dd-mm-yyyy')
                                    ->addonRight($ui->icon("calendar"))
                                    ->placeholder("dd-mm-yyyy")
                                    ->label('To')->width(3)->t_width(4)
                                    ->extras('max="'.date('d-m-Y',strtotime($joining_date)).'"') //max not working
                                    ->show();
                $row12->close();
                $row13 = $ui->row()->open();
                    $ui->input()->name("designation2")->label('Position Held')->width(3)->t_width(12)->show();
                    $ui->input()->name("payscale2")->label('Pay Scale')->width(3)->t_width(12)->show();
                    $ui->input()->name('reason2')->label('Remarks')->width(6)->t_width(12)->show();
                $row13->close();
            $box->close();
        $col->close();
    $row->close();
    $ui->button()->submit()->id('add_btn')->name('submit')->value("Add")->large()->uiType('primary')->icon($ui->icon("plus"))->show();
    $ui->button()->submit()->id('next_btn')->classes("pull-right")->value('Next')->name('submit')->large()->uiType('primary')->icon($ui->icon("arrow-right"))->show();
    echo "<br />";
$form->close();
?>