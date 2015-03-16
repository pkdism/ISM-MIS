<?php

    $ui = new UI();

        $form=$ui->form()
                 ->action('student/student_editable_by_student/update_my_details')
                 ->multipart()
                 ->id('form_submit')
                 ->open();


            $studenteditable_details = $ui->row()
                                  ->open();

                 $student_editable_details_box = $ui->box()
                                                  ->uiType('primary')
                                                  ->solid()
                                                  ->title('Editable Details')
                                                  ->open();

                    $editable_details_row_1 = $ui->row()
                                                 ->open();

                        $ui->input()
                           ->label('Email')
                           ->name('email')
                           ->type('email')
                           ->required()
                           ->value($user_detail->email)
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Alternate Email')
                           ->name('alternate_email_id')
                           ->id('alternate_email_id')
                           ->type('email')
                           ->value($stu_detail->alternate_email_id)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Mobile No.')
                           ->name('mobile')
                           ->id('mobile')
                           ->required()
                           ->value($user_other_detail->mobile_no)
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Alternate Mobile No.')
                           ->name('alternate_mobile')
                           ->id('alternate_mobile')
                           ->value($stu_detail->alternate_mobile_no)
                           ->width(3)
                           ->show();


                    $editable_details_row_1 ->close();

                    $editable_details_row_2 = $ui->row()
                                                 ->open();

                        $ui->input()
                           ->label('Hobbies')
                           ->name('hobbies')
                           ->width(3)
                           ->id('hobbies')
                           ->value($user_other_detail->hobbies)
                           ->show();

                        $ui->input()
                           ->label('Favourite Pass Time')
                           ->name('favpast')
                           ->id('favpast')
                           ->value($user_other_detail->fav_past_time)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Extra-Curricular Activities ( if any):')
                           ->name('extra_activity')
                           ->id('extra_activity')
                           ->value($stu_other_detail->extra_curricular_activity)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Any other relevant information')
                           ->name('any_other_information')
                           ->id('any_other_information')
                           ->value($stu_other_detail->other_relevant_info)
                           ->width(3)
                           ->show();


                    $editable_details_row_2 ->close();

                    $editable_details_row_3 = $ui->row()
                                                 ->open();

                        $editable_col_3_1 = $ui->col()
                                                ->width(5)
                                                ->open();
                        $editable_col_3_1->close();

                        $ui->button()
                           ->submit(true)
                           ->value('Update')
                           ->uiType('primary')
                           ->width(2)
                           ->show();

                    $editable_details_row_3 ->close();

                    $editable_details_row_4 = $ui->row()
                                                 ->open();

                        $editable_col_4_1 = $ui->col()
                                                ->width(11)
                                                ->open();

                        $editable_col_4_1->close();?>

                        <a href= <?= site_url()?> ><?php

                        $ui->button()
                           ->value('Back')
                           ->width(1)
                           ->show();?></a><?php

                    $editable_details_row_4 ->close();

                $student_editable_details_box->close();

            $studenteditable_details->close();

        $form->close();

?>