<?php $ui = new UI();

$form = $ui->form()->multipart()->action('employee/edit/update_profile_pic/'.$emp_id)->open();
$row = $ui->row()->open();
    $col = $ui->col()->width(6)->open();
        $profile_box = $ui->box()->uiType('primary')->solid()->title('Change Profile Picture')->open();

            $row1 = $ui->row()->open();
                echo '<center><div class="form-group"  >';
                if($pending_photopath)  $col1 = $ui->col()->width(6)->open();
                else    $col1 = $ui->col()->open();
                    if($photopath == FALSE || $photopath == "")
                        echo '<img src="'.base_url().'assets/images/employee/noProfileImage.png" id="view_photo" width="145" height="150"/>';
                    else
                        echo '<img id="view_photo" src="'.base_url().'assets/images/'.$photopath.'"  height="150" />';
                $col1->close();

                if($pending_photopath) {
                    $col2 = $ui->col()->width(6)->open();
                        if($pending_photopath == FALSE || $pending_photopath == "")
                            echo '<img src="'.base_url().'assets/images/employee/noProfileImage.png" id="pending_photo" width="145" height="150"/>';
                        else
                            echo '<img id="pending_photo" src="'.base_url().'assets/images/'.$pending_photopath.'"  height="150" />';
                    if($status == 'pending')    echo '<br>'.$ui->label()->uiType('info')->text('Pending');
                    else if($status == 'rejected')    echo '<br>'.$ui->label()->uiType('danger')->text('Rejected');
                    $col2->close();
                }
                echo '</div></center>';
            $row1->close();

            $row2 = $ui->row()->open();
                $ui->imagePicker()->width(12)->label("Select New Picture<span style= \"color:red;\"> *</span>")->required()->id('photo')->name('photo')->show();
            $row2->close();

            echo '<a href="'.site_url('employee/edit').'">';
            $ui->button()->value("Back")->large()->uiType('primary')->icon($ui->icon("arrow-left"))->show();
            echo '</a>';
            $ui->button()->submit()->classes("pull-right")->value('Save')->name('submit')->large()->uiType('primary')->icon($ui->icon("floppy-o"))->show();
            echo "<br />";

        $profile_box->close();
    $col->close();
$row->close();
$form->close();