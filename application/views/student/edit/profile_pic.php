<?php

    $ui = new UI();

        $form=$ui->form()
                 ->action('student/student_edit/update_profile_pic/'.$stu_id)
                 ->multipart()
                 ->id('form_submit')
                 ->open();

            $photedit_row_0 = $ui->row()
                                 ->open();

                $photoedit_box_1 = $ui->box()
                                      ->title('Admission No. '.$stu_id)
                                      ->solid()
                                      ->uiType('primary')
                                      ->open();

                    $photoedit_row_4 = $ui->row()
                                          ->open();

                        $photoedit_col_4_1 = $ui->col()
                                                ->width(4)
                                                ->open();

                            echo '<label>Previous Profile Pic</label>';

                        $photoedit_col_4_1->close();

                        $photoedit_col_4_2 = $ui->col()
                                                ->width(4)
                                                ->open();

                            if($photopath == FALSE || $photopath == "")
                                echo '<img src="'.base_url().'assets/images/student/noProfileImage.png" id="view_photo" width="145" height="150"/>';
                            else
                                echo '<img src="'.base_url().'assets/images/'.$photopath.'" id="view_photo" width="145" height="150"/>';

                        $photoedit_col_4_2->close();

                    $photoedit_row_4->close();

                    $photoedit_row_1 = $ui->row()
                                          ->open();

                        $upload_img = $ui->imagePicker()
                                         ->id('photo')
                                         ->name('photo')
                                         ->value('hi')
                                         ->required()
                                         ->width(12)
                                         ->required()
                                         ->show();

                    $photoedit_row_1->close();

                    $photoedit_row_2 = $ui->row()
                                          ->open();

                        $photoedit_col_2_1 = $ui->col()
                                                ->width(5)
                                                ->open();

                        $photoedit_col_2_1->close();

                        $ui->button()
                           ->submit(true)
                           ->value('Save')
                           ->uiType('primary')
                           ->width(2)
                           ->show();

                    $photoedit_row_2->close();

                    $photoedit_row_3 = $ui->row()
                                          ->open();

                        $photoedit_col_3_1 = $ui->col()
                                                ->width(11)
                                                ->open();

                        $photoedit_col_3_1->close();?>

                        <a href= <?= site_url('student/student_edit')?> ><?php

                        $ui->button()
                           ->value('Back')
                           ->uiType('primary')
                           ->width(1)
                           ->show();?></a><?php

                    $photoedit_row_3->close();

                $photoedit_box_1->close();

            $photedit_row_0->close();
?>