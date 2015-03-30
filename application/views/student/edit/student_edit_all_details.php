<?php
    if($correspondence_address)
        $coress_recv = true;
    else
        $coress_recv = false;

    $ui = new UI();

        $form=$ui->form()
                 ->action('student/student_edit/update_all_details/'.$stu_id.'/'.$coress_recv)
                 ->multipart()
                 ->id('form_submit')
                 ->open();

            $student_details_row = $ui->row()
                                  ->open();

                $student_details_box = $ui->box()
                                          ->uiType('primary')
                                          ->solid()
                                          ->title('Personal Details')
                                          ->open();

                    $student_name = $ui->row()
                                       ->open();

/*                        $salutation_column = $ui->col()
                                                ->width(3)
                                                ->open();
*/
                            $ui->select()
                               ->name('salutation')
                               ->width(3)
                               ->options(array($ui->option()->value('mr')->text('Mr')->selected($user_details->salutation=="mr"),
                                               $ui->option()->value('mrs')->text('Mrs')->selected($user_details->salutation=="mrs"),
                                               $ui->option()->value('ms')->text('Ms')->selected($user_details->salutation=="ms"),
                                               $ui->option()->value('dr')->text('Dr')->selected($user_details->salutation=="dr")))
                            ->show();

                        /*$salutation_column->close();

                        $firstname_column = $ui->col()
                                               ->width(3)
                                               ->open();
*/
                            $ui->input()
                               ->placeholder('First Name')
                               ->id('firstname')
                               ->required()
                               ->value($user_details->first_name)
                               ->width(3)
                               ->name('firstname')
                               ->show();

/*                        $firstname_column->close();

                        $middlename_column = $ui->col()
                                                ->width(3)
                                                ->open();

*/                            $ui->input()
                               ->placeholder('Middle Name')
                               ->id('middlename')
                               ->width(3)
                               ->value($user_details->middle_name)
                               ->name('middlename')
                               ->show();

/*                        $middlename_column->close();

                        $lastname_column = $ui->col()
                                              ->width(3)
                                              ->open();
*/
                            $ui->input()
                               ->placeholder('Last Name')
                               ->width(3)
                               ->id('lastname')
                               ->name('lastname')
                               ->value($user_details->last_name)
                               ->show();

//                        $lastname_column->close();

                    $student_name->close();

                    $student_personal_details_row_1 = $ui->row()
                                                         ->open();

                        /*$column3 = $ui->col()
                                      ->width(3)
                                      ->open();*/

                            $ui->input()
                               ->label('पूरा नाम हिन्दी में')
                               ->id('stud_name_hindi')
                               ->name('stud_name_hindi')
                               ->value($stu_basic_details->name_in_hindi)
                               ->width(3)
                               ->show();

                       // $column3->close();

                        $column_gender = $ui->col()
                                      ->width(3)
                                      ->open();
                            echo '<label>Gender</label>';

                            $ui->radio()
                               ->name('sex')
                               ->label('Male')
                               ->value('m')
                               ->checked($user_details->sex=="m")
                               ->show();

                            $ui->radio()
                               ->name('sex')
                               ->label('Female')
                               ->value('f')
                               ->checked($user_details->sex=="f")
                               ->show();

                            $ui->radio()
                               ->name('sex')
                               ->label('Others')
                               ->value('o')
                               ->checked($user_details->sex=="o")
                               ->show();

                        $column_gender->close();

                        /*$column5 = $ui->col()
                                      ->width(3)
                                      ->open();*/

                            $ui->datePicker()
                               ->label('Date of Birth')
                               ->width(3)
                               ->name('dob')
                               ->value(date('d-m-Y',strtotime($user_details->dob)))
                               ->dateFormat('dd-mm-yyyy')
                               ->show();

                        /*$column5->close();

                        $column6 = $ui->col()
                                      ->width(3)
                                      ->open();

                        $column6->close();*/

                            $ui->input()
                               ->label('Place of Birth')
                               ->name('pob')
                               ->required()
                               ->value($user_other_details->birth_place)
                               ->width(3)
                               ->show();

                    $student_personal_details_row_1->close();

                    $student_personal_details_row_2 = $ui->row()
                                                         ->open();

                        $column_pd = $ui->col()
                                            ->width(3)
                                            ->open();
                            echo '<label>Physically Challenged</label>';

                            $ui->radio()
                               ->name('pd')
                               ->label('Yes')
                               ->value('yes')
                               ->checked($user_details->physically_challenged=="yes")
                               ->show();

                            $ui->radio()
                               ->name('pd')
                               ->label('No')
                               ->value('no')
                               ->checked($user_details->physically_challenged=="no")
                               ->show();

                        $column_pd->close();

                        $ui->select()
                           ->name('blood_group')
                           ->width(3)
                           ->label('Blood Group')
                           ->options(array($ui->option()->value('A+')->text('A+')->selected($stu_basic_details->blood_group=="A+"),
                                           $ui->option()->value('A-')->text('A-')->selected($stu_basic_details->blood_group=="A-"),
                                           $ui->option()->value('B+')->text('B+')->selected($stu_basic_details->blood_group=="B+"),
                                           $ui->option()->value('B-')->text('B-')->selected($stu_basic_details->blood_group=="B-"),
                                           $ui->option()->value('O+')->text('O+')->selected($stu_basic_details->blood_group=="O+"),
                                           $ui->option()->value('O-')->text('O-')->selected($stu_basic_details->blood_group=="O-"),
                                           $ui->option()->value('AB+')->text('AB+')->selected($stu_basic_details->blood_group=="AB+"),
                                           $ui->option()->value('AB-')->text('AB-')->selected($stu_basic_details->blood_group=="AB-")))
                           ->show();

                        $column_ki = $ui->col()
                                        ->width(3)
                                        ->open();
                            echo '<label>Kashmiri Immigrant</label>';

                            $ui->radio()
                               ->name('kashmiri')
                               ->label('Yes')
                               ->value('yes')
                               ->checked($user_other_details->kashmiri_immigrant=="yes")
                               ->show();

                            $ui->radio()
                               ->name('kashmiri')
                               ->label('No')
                               ->value('no')
                               ->checked($user_other_details->kashmiri_immigrant=="no")
                               ->show();

                        $column_ki->close();

                        $ui->select()
                           ->name('mstatus')
                           ->width(3)
                           ->label('Marital Status')
                           ->options(array($ui->option()->value('unmarried')->text('Unmarried')->selected($user_details->marital_status == "unmarried"),
                                           $ui->option()->value('married')->text('Married')->selected($user_details->marital_status == "married"),
                                           $ui->option()->value('widow')->text('Widow')->selected($user_details->marital_status == "widow"),
                                           $ui->option()->value('Widower')->text('Widower')->selected($user_details->marital_status == "widower"),
                                           $ui->option()->value('divorcee')->text('Divorcee')->selected($user_details->marital_status == "divorcee"),
                                           $ui->option()->value('separated')->text('Separated')->selected($user_details->marital_status == "separated")))
                           ->show();

                    $student_personal_details_row_2->close();

                    $student_personal_details_row_3 = $ui->row()
                                                         ->open();

                        $ui->select()
                           ->name('category')
                           ->width(3)
                           ->label('Category')
                           ->options(array($ui->option()->value('General')->text('GEN')->selected($user_details->category =="General"),
                                           $ui->option()->value('OBC')->text('OBC')->selected($user_details->category =="OBC"),
                                           $ui->option()->value('SC')->text('SC')->selected($user_details->category =="SC"),
                                           $ui->option()->value('ST')->text('ST')->selected($user_details->category =="ST"),
                                           $ui->option()->value('Others')->text('OTHERS')->selected($user_details->category =="Others")))
                           ->show();

                        $ui->select()
                           ->name('religion')
                           ->width(3)
                           ->label('Religion')
                           ->options(array($ui->option()->value('HINDU')->text('HINDU')->selected($user_other_details->religion == "hindu"),
                                           $ui->option()->value('CHRISTIAN')->text('CHRISTIAN')->selected($user_other_details->religion == "christian"),
                                           $ui->option()->value('MUSLIM')->text('MUSLIM')->selected($user_other_details->religion == "muslim"),
                                           $ui->option()->value('SIKH')->text('SIKH')->selected($user_other_details->religion == "sikh"),
                                           $ui->option()->value('BAUDHH')->text('BAUDHH')->selected($user_other_details->religion == "baudhh"),
                                           $ui->option()->value('JAIN')->text('JAIN')->selected($user_other_details->religion == "jain"),
                                           $ui->option()->value('PARSI')->text('PARSI')->selected($user_other_details->religion == "parsi"),
                                           $ui->option()->value('YAHUDI')->text('YAHUDI')->selected($user_other_details->religion == "yahudi"),
                                           $ui->option()->value('OTHERS')->text('OTHERS')->selected($user_other_details->religion == "others")))
                           ->show();

                        $ui->input()
                           ->label('Nationality')
                           ->name('nationality')
                           ->value($user_other_details->nationality)
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Aadhaar Card No.')
                           ->id('aadhaar_no')
                           ->name('aadhaar_no')
                           ->value($stu_other_details->aadhaar_card_no)
                           ->width(3)
                           ->show();

                    $student_personal_details_row_3->close();

                    $student_personal_details_row_4 = $ui->row()
                                                         ->open();

                        $ui->input()
                           ->label('Identification Mark')
                           ->name('identification_mark')
                           ->required()
                           ->value($stu_basic_details->identification_mark)
                           ->width(12)
                           ->show();

                    $student_personal_details_row_4->close();


                $student_details_box->close();

                $student_family_details_box = $ui->box()
                                                 ->uiType('primary')
                                                 ->solid()
                                                 ->title('Family Details')
                                                 ->open();

                    $family_details_row = $ui->row()
                                             ->open();

                    $family_father = $ui->col()
                                         ->width(4)
                                         ->open();

                        $student_father_details_box = $ui->box()
                                                         ->uiType('primary')
                                                         ->solid()
                                                         ->title('Father\'s Details')
                                                         ->open();

                            $ui->input()
                               ->label('Father\'s Name')
                               ->id('father_name')
                               ->name('father_name')
                               ->value($user_other_details->father_name)
                               ->show();

                            $ui->input()
                               ->label('Father\'s Occupation')
                               ->id('father_occupation')
                               ->name('father_occupation')
                               ->value($stu_other_details->fathers_occupation)
                               ->show();

                            $ui->input()
                               ->label('Father\'s Gross Annual Income')
                               ->id('father_gross_income')
                               ->name('father_gross_income')
                               ->value($stu_other_details->fathers_annual_income)
                               ->show();

                        $student_father_details_box->close();


                    $family_father->close();

                    $family_mother = $ui->col()
                                         ->width(4)
                                         ->open();

                        $student_mother_details_box = $ui->box()
                                                         ->uiType('primary')
                                                         ->solid()
                                                         ->title('Mother\'s Details')
                                                         ->open();

                            $ui->input()
                               ->label('Mother\'s Name')
                               ->id('mother_name')
                               ->name('mother_name')
                               ->value($user_other_details->mother_name)
                               ->show();

                            $ui->input()
                               ->label('Mother\'s Occupation')
                               ->id('mother_occupation')
                               ->name('mother_occupation')
                               ->value($stu_other_details->mothers_occupation)
                               ->show();

                            $ui->input()
                               ->label('Mother\'s Gross Annual Income')
                               ->id('mother_gross_income')
                               ->name('mother_gross_income')
                               ->value($stu_other_details->mothers_annual_income)
                               ->show();

                        $student_mother_details_box->close();

                    $family_mother->close();

                    $family_guardian = $ui->col()
                                         ->width(4)
                                         ->open();

                        $student_guardian_details_box = $ui->box()
                                                           ->uiType('primary')
                                                           ->solid()
                                                           ->title('Guardian\'s Details')
                                                           ->open();

                            ?><input type='checkbox' id ="depends_on"  name="depends_on" <?php if($stu_other_details->guardian_name != '') echo "checked"; ?>/><?php

                            echo '<label>Fill Guardian Details</label>';

                            /*$ui->checkbox()
                               ->name('depends_on')
                               ->id('depends_on')
                               //->checked()
                               ->checked($stu_other_details->guardian_name != 'na')
                               ->show();*/

                            $ui->input()
                               ->label('Guardian\'s Name')
                               ->id('guardian_name')
                               ->name('guardian_name')
                               ->value($stu_other_details->guardian_name)
                               ->disabled()
                               ->show();

                            $ui->input()
                               ->label('Relationship')
                               ->id('guardian_relation_name')
                               ->name('guardian_relation_name')
                               ->value($stu_other_details->guardian_relation)
                               ->disabled()
                               ->show();

                        $student_guardian_details_box->close();

                    $family_guardian->close();

                    $family_details_row->close();

                    $family_contact_details_row = $ui->row()
                                                     ->open();

                        $ui->input()
                           ->label('Parent/Guardian Mobile No')
                           ->id('parent_mobile')
                           ->required()
                           ->value($stu_basic_details->parent_mobile_no)
                           ->width(6)
                           ->name('parent_mobile')
                           ->show();

                        if($stu_basic_details->parent_landline_no == '0')
                          $parent_landline_number = '';
                        else
                          $parent_landline_number = $stu_basic_details->parent_landline_no;
                        $ui->input()
                           ->label('Parent/Guardian Landline No')
                           ->id('parent_landline')
                           ->width(6)
                           ->value($parent_landline_number)
                           ->name('parent_landline')
                           ->show();

                    $family_contact_details_row->close();

                $student_family_details_box->close();

                $student_admission_details_box = $ui->box()
                                                 ->uiType('primary')
                                                 ->solid()
                                                 ->title('Admission Details')
                                                 ->open();

                    $admission_details_row_1 = $ui->row()
                                                ->open();

                        $ui->input()
                           ->label('Migration Certiificate')
                           ->width(3)
                           ->name('migration_cert')
                           ->value($stu_basic_details->migration_cert)
                           ->show();

                        $ui->input()
                           ->label('Roll No.')
                           ->id('roll_no')
                           ->name('roll_no')
                           ->placeholder('eg. IIT-JEE enrollment no.')
                           ->value($stu_basic_details->enrollment_no)
                           ->width(3)
                           ->show();

                        $ui->datePicker()
                           ->label('Date of Admission')
                           ->width(3)
                           ->name('entrance_date')
                           ->value(date('d-m-Y',strtotime($stu_basic_details->admn_date)))
                           ->dateFormat('dd-mm-yyyy')
                           ->show();

                        $ui->select()
                           ->name('admn_based_on')
                           ->id('id_admn_based_on')
                           ->width(3)
                           ->label('Admission Based On')
                           ->options(array($ui->option()->value('iitjee')->text('IIT JEE')->selected($stu_academic_details->admn_based_on=="iitjee"),
                                           $ui->option()->value('isme')->text('ISM Entrance')->selected($stu_academic_details->admn_based_on=="isme"),
                                           $ui->option()->value('gate')->text('GATE')->selected($stu_academic_details->admn_based_on=="gate"),
                                           $ui->option()->value('cat')->text('CAT')->selected($stu_academic_details->admn_based_on=="cat"),
                                           $ui->option()->value('direct')->text('Direct')->selected($stu_academic_details->admn_based_on=="direct"),
                                           $ui->option()->value('others')->text('Others')->selected($stu_academic_details->admn_based_on!="iitjee"&&$stu_academic_details->admn_based_on!="isme"&&$stu_academic_details->admn_based_on!="gate"&&$stu_academic_details->admn_based_on!="cat"&&$stu_academic_details->admn_based_on!="direct")))
                           ->show();

                    $admission_details_row_1->close();

                    $admission_details_row_2 = $ui->row()
                                                  ->open();

                        if($stu_academic_details->admn_based_on!="iitjee"&&$stu_academic_details->admn_based_on!="isme"&&$stu_academic_details->admn_based_on!="gate"&&$stu_academic_details->admn_based_on!="cat"&&$stu_academic_details->admn_based_on!="direct")
                            $ui->input()
                               ->label('Other Mode of Admission')
                               ->id('other_mode_of_admission')
                               ->name('mode_of_admission')
                               ->value($stu_academic_details->admn_based_on)
                               ->disabled()
                               ->width(3)
                               ->show();
                        else
                            $ui->input()
                               ->label('Other Mode of Admission')
                               ->id('other_mode_of_admission')
                               ->name('mode_of_admission')
                               ->disabled()
                               ->width(3)
                               ->show();

                        $ui->input()
                           ->label('IIT JEE General Rank')
                           ->id('iitjee_rank')
                           ->name('iitjee_rank')
                           ->value($stu_academic_details->iit_jee_rank)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('IIT JEE Category Rank')
                           ->id('iitjee_cat_rank')
                           ->name('iitjee_cat_rank')
                           ->value($stu_academic_details->iit_jee_cat_rank)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Gate Score')
                           ->id('gate_score')
                           ->name('gate_score')
                           ->disabled()
                           ->value($stu_academic_details->gate_score)
                           ->width(3)
                           ->show();

                    $admission_details_row_2->close();

                    $admission_details_row_3 = $ui->row()
                                                ->open();

                        $ui->input()
                           ->label('Cat Score')
                           ->id('cat_score')
                           ->name('cat_score')
                           ->value($stu_academic_details->cat_score)
                           ->disabled()
                           ->width(3)
                           ->show();

                        $ui->select()
                           ->label('Student Type')
                           ->id('stu_type')
                           ->name('stu_type')
                           ->width(3)
                           ->options(array($ui->option()->value('ug')->text('Under Graduate')->selected($stu_academic_details->auth_id=="ug"),
                                           $ui->option()->value('g')->text('Graduate')->selected($stu_academic_details->auth_id=="g"),
                                           $ui->option()->value('pg')->text('Post Graduate')->selected($stu_academic_details->auth_id=="pg"),
                                           $ui->option()->value('jrf')->text('Junior Research Fellow')->selected($stu_academic_details->auth_id=="jrf"),
                                           $ui->option()->value('pd')->text('Post Doctoral Fellow')->selected($stu_academic_details->auth_id=="pd")))
                           ->show();

                        $ui->select()
                           ->label('Present Semester')
                           ->name('semester')
                           ->width(3)
                           ->options(array($ui->option()->value('1')->text('1')->selected($stu_academic_details->semester == '1'),
                                           $ui->option()->value('2')->text('2')->selected($stu_academic_details->semester == '2'),
                                           $ui->option()->value('3')->text('3')->selected($stu_academic_details->semester == '3'),
                                           $ui->option()->value('4')->text('4')->selected($stu_academic_details->semester == '4'),
                                           $ui->option()->value('5')->text('5')->selected($stu_academic_details->semester == '5'),
                                           $ui->option()->value('6')->text('6')->selected($stu_academic_details->semester == '6'),
                                           $ui->option()->value('7')->text('7')->selected($stu_academic_details->semester == '7'),
                                           $ui->option()->value('8')->text('8')->selected($stu_academic_details->semester == '8'),
                                           $ui->option()->value('9')->text('9')->selected($stu_academic_details->semester == '9'),
                                           $ui->option()->value('10')->text('10')->selected($stu_academic_details->semester == '10')))
                           ->show();

                    $admission_details_row_3->close();

                    $admission_details_row_4 = $ui->row()
                                                  ->open();

                        $dept_array = array();

                        if($academic_departments === FALSE)
                            $dept_array[] = $ui->option()->value('')->text('No Depatment');
                        else
                            foreach ($academic_departments as $row)
                            {
                                if($row->id == $user_details->dept_id)
                                    $dept_array[] = $ui->option()->value($row->id)->text($row->name)->selected();
                                else
                                    $dept_array[] = $ui->option()->value($row->id)->text($row->name);
                                $dept_array = array_values($dept_array);
                            }

                        $course_array = array();

                        //case : student type =jrf then course == na // Not Applicable
                        $course_array[] = $ui->option()->value('na')->text('Not Applicable')->selected($stu_academic_details->course_id == 'na');
                        $course_array = array_values($course_array);

                        if($courses === FALSE) {
                            $course_array[] = $ui->option()->value('none')->text('No Course');
                            $course_array = array_values($course_array);
                        }
                        else
                            foreach ($courses as $row)
                            {
                                if($row->id == $stu_academic_details->course_id)
                                    $course_array[] = $ui->option()->value($row->id)->text($row->name)->selected();
                                else
                                    $course_array[] = $ui->option()->value($row->id)->text($row->name);
                                $course_array = array_values($course_array);
                            }

                        $branch_array = array();
                        //case : student type =jrf then branch == na // Not Applicable
                        $branch_array[] = $ui->option()->value('na')->text('Not Applicable')->selected($stu_academic_details->branch_id == 'na');
                        $branch_array = array_values($branch_array);

                        if($branches === FALSE) {
                            $branch_array[] = $ui->option()->value('none')->text('No Branch');
                            $branch_array = array_values($branch_array);
                        }
                        else
                            foreach ($branches as $row)
                            {
                                if($row->id == $stu_academic_details->branch_id)
                                    $branch_array[] = $ui->option()->value($row->id)->text($row->name)->selected();
                                else
                                    $branch_array[] = $ui->option()->value($row->id)->text($row->name);
                                $branch_array = array_values($branch_array);
                            }

                        $ui->select()
                           ->width(4)
                           ->label('Department')
                           ->name('department')
                           ->id('depts')
                           ->options($dept_array)
                           ->show();

                        $ui->select()
                           ->width(4)
                           ->label('Course')
                           ->name('course')
                           ->id('course_id')
                           ->options($course_array)
                           ->show();

                        $ui->select()
                           ->width(4)
                           ->label('Branch')
                           ->name('branch')
                           ->id('branch_id')
                           ->options($branch_array)
                           ->show();

                    $admission_details_row_4->close();

                $student_admission_details_box->close();

                $student_bank_details_box = $ui->box()
                                                   ->uiType('primary')
                                                   ->solid()
                                                   ->title('Bank Details')
                                                   ->open();

                    $bank_details_row_1 = $ui->row()
                                             ->open();

                        $ui->input()
                           ->label('Bank Name')
                           ->name('bank_name')
                           ->value($stu_other_details->bank_name)
                           ->required()
                           ->width(6)
                           ->show();

                        $ui->input()
                           ->label('Bank Account No.')
                           ->name('bank_account_no')
                           ->value($stu_other_details->account_no)
                           ->required()
                           ->width(6)
                           ->show();

                    $bank_details_row_1 ->close();

                $student_bank_details_box->close();

                $student_fee_details_box = $ui->box()
                                              ->uiType('primary')
                                              ->solid()
                                              ->title('Details of Fees Payment at the time of Admission')
                                              ->open();

                    $fee_details_row_1 = $ui->row()
                                            ->open();

                        $ui->select()
                           ->label('Mode of Payment')
                           ->name('fee_paid_mode')
                           ->width(3)
                           ->options(array($ui->option()->value('dd')->text('CHEQUE')->selected($stu_fee_details->fee_mode == "dd"),
                                           $ui->option()->value('cheque')->text('CASH')->selected($stu_fee_details->fee_mode == "cheque"),
                                           $ui->option()->value('online')->text('ONLINE TRANSFER')->selected($stu_fee_details->fee_mode == "online"),
                                           $ui->option()->value('none')->text('NONE')->selected()->selected($stu_fee_details->fee_mode == "none")))
                           ->show();

                        $ui->datePicker()
                           ->label('Fees Paid Date')
                           ->width(3)
                           ->name('fee_paid_date')
                           ->value(date('d-m-Y',strtotime($stu_fee_details->payment_made_on)))
                           ->dateFormat('dd-mm-yyyy')
                           ->show();

                        $ui->input()
                           ->label('DD/CHEQUE/ONLINE/CASH NO.')
                           ->name('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
                           ->id('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
                           ->value($stu_fee_details->transaction_id)
                           ->width(3)
                           ->show();

                        if($stu_fee_details->fee_amount == '0')
                          $fee_amt = '';
                        else
                          $fee_amt = $stu_fee_details->fee_amount;
                        $ui->input()
                           ->label('Fees Paid Amount')
                           ->name('fee_paid_amount')
                           ->id('fee_paid_amount')
                           ->value($fee_amt)
                           ->width(3)
                           ->show();

                    $fee_details_row_1 ->close();

                $student_fee_details_box->close();

                $student_address_details_box = $ui->box()
                                                  ->uiType('primary')
                                                  ->solid()
                                                  ->title('Address Details')
                                                  ->open();

                    $state1_array = array();
                    foreach ($states as $row)
                    {
                        $state1_array[] = $ui->option()->value($row->state_name)->text(ucwords($row->state_name))->selected($present_address->state == $row->state_name);
                        $state1_array = array_values($state1_array);
                    }

                    $state2_array = array();
                    foreach ($states as $row)
                    {
                        $state2_array[] = $ui->option()->value($row->state_name)->text(ucwords($row->state_name))->selected($permanent_address->state == $row->state_name);
                        $state2_array = array_values($state2_array);
                    }

                    $address_details_row_1 = $ui->row()
                                                ->open();

                        $address_col_1 = $ui->col()
                                          ->width(6)
                                          ->open();

                        $present_address_details_box = $ui->box()
                                                          ->uiType('primary')
                                                          ->solid()
                                                          ->title('Present Address')
                                                          ->open();

                            $ui->input()
                               ->label('Address Line 1')
                               ->name('line11')
                               ->value($present_address->line1)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Address Line 2')
                               ->name('line21')
                               ->value($present_address->line2)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('City')
                               ->name('city1')
                               ->value($present_address->city)
                               ->required()
                               ->show();

                            /*$ui->input()
                               ->label('State')
                               ->name('state1')
                               ->required()
                               ->value($present_address->state)
                               ->show();*/

                            $ui->select()
                               ->label('State')
                               ->name('state1')
                               ->options($state1_array)
                               ->show();

                            $ui->input()
                               ->label('Pincode')
                               ->name('pincode1')
                               ->id('pincode1')
                               ->value($present_address->pincode)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Country')
                               ->name('country1')
                               ->value($present_address->country)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Contact No.')
                               ->name('contact1')
                               ->id('contact1')
                               ->value($present_address->contact_no)
                               ->required()
                               ->show();

                        $present_address_details_box->close();

                        $address_col_1->close();

                        $address_col_2 = $ui->col()
                                          ->width(6)
                                          ->open();

                        $permanent_address_details_box = $ui->box()
                                                          ->uiType('primary')
                                                          ->solid()
                                                          ->title('Permanent Address')
                                                          ->width(6)
                                                          ->open();

                            $ui->input()
                               ->label('Address Line 1')
                               ->name('line12')
                               ->value($permanent_address->line1)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Address Line 2')
                               ->name('line22')
                               ->value($permanent_address->line2)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('City')
                               ->name('city2')
                               ->value($permanent_address->city)
                               ->required()
                               ->show();

                            /*$ui->input()
                               ->label('State')
                               ->name('state2')
                               ->value($permanent_address->state)
                               ->required()
                               ->show();*/

                            $ui->select()
                               ->label('State')
                               ->name('state2')
                               ->options($state2_array)
                               ->show();


                            $ui->input()
                               ->label('Pincode')
                               ->name('pincode2')
                               ->id('pincode2')
                               ->value($permanent_address->pincode)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Country')
                               ->name('country2')
                               ->value($permanent_address->country)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Contact No.')
                               ->name('contact2')
                               ->id('contact2')
                               ->value($permanent_address->contact_no)
                               ->required()
                               ->show();

                        $permanent_address_details_box->close();

                        $address_col_2->close();

                    $address_details_row_1 ->close();

                    $address_details_row_2 = $ui->row()
                                                ->open();

                        $check_corr_address_col_0 = $ui->col()
                                                       ->width(3)
                                                       ->open();
                        $check_corr_address_col_0->close();

                        /*$check_corr_address_col_1 = $ui->col()
                                                       ->width(1)
                                                       ->open();

                            $ui->checkbox()
                               ->name('correspondence_addr')
                               ->id('correspondence_addr')
                               ->checked(!$coress_recv)
                               ->show();

                        $check_corr_address_col_1->close();*/

                        $check_corr_address_col_2 = $ui->col()
                                                       ->width(7)
                                                       ->open();

                            ?><input type='checkbox' id ="correspondence_addr"  name="correspondence_addr" <?php if(!$correspondence_address) echo "checked"; ?>/><?php

                            echo '<label>Correspondence address same as Permanent address.</label>';

                        $check_corr_address_col_2->close();

                    $address_details_row_2 ->close();

                    ?><div id="corr_addr_visibility"><?php

                    $address_details_row_3 = $ui->row()
                                                ->open();

                        $corr_address_col_1 = $ui->col()
                                                 ->width(3)
                                                 ->open();

                        $corr_address_col_1->close();

                        $corr_address_col_2 = $ui->col()
                                                 ->width(6)
                                                 ->open();

                            $correspondence_address_details_box = $ui->box()
                                                          ->uiType('primary')
                                                          ->solid()
                                                          ->title('Correspondence Address')
                                                          ->open();

                                if($coress_recv){

                                $state3_array = array();
                                foreach ($states as $row)
                                {
                                    $state3_array[] = $ui->option()->value($row->state_name)->text(ucwords($row->state_name))->selected($correspondence_address->state == $row->state_name);
                                    $state3_array = array_values($state3_array);
                                }
                                $ui->input()
                                   ->label('Address Line 1')
                                   ->name('line13')
                                   ->value($correspondence_address->line1)
                                   ->show();

                                $ui->input()
                                   ->label('Address Line 2')
                                   ->name('line23')
                                   ->value($correspondence_address->line2)
                                   ->show();

                                $ui->input()
                                   ->label('City')
                                   ->name('city3')
                                   ->value($correspondence_address->city)
                                   ->show();

                                /*$ui->input()
                                   ->label('State')
                                   ->name('state3')
                                   ->value($correspondence_address->state)
                                   ->show();*/

                                $ui->select()
                                   ->label('State')
                                   ->name('state3')
                                   ->options($state3_array)
                                   ->show();

                                $ui->input()
                                   ->label('Pincode')
                                   ->name('pincode3')
                                   ->id('pincode3')
                                   ->value($correspondence_address->pincode)
                                   ->show();

                                $ui->input()
                                   ->label('Country')
                                   ->name('country3')
                                   ->value($correspondence_address->country)
                                   ->show();

                                $ui->input()
                                   ->label('Contact No.')
                                   ->name('contact3')
                                   ->id('contact3')
                                   ->value($correspondence_address->contact_no)
                                   ->show();
                                }
                                else{
                                    $ui->input()
                                   ->label('Address Line 1')
                                   ->name('line13')
                                   ->show();

                                $ui->input()
                                   ->label('Address Line 2')
                                   ->name('line23')
                                   ->show();

                                $ui->input()
                                   ->label('City')
                                   ->name('city3')
                                   ->show();

                                $ui->input()
                                   ->label('State')
                                   ->name('state3')
                                   ->show();

                                $ui->input()
                                   ->label('Pincode')
                                   ->name('pincode3')
                                   ->id('pincode3')
                                   ->show();

                                $ui->input()
                                   ->label('Country')
                                   ->name('country3')
                                   ->value('India')
                                   ->show();

                                $ui->input()
                                   ->label('Contact No.')
                                   ->name('contact3')
                                   ->id('contact3')
                                   ->show();
                                }

                        $correspondence_address_details_box->close();

                        $corr_address_col_2->close();

                    $address_details_row_3 ->close();

                    ?></div><?php

                $student_address_details_box->close();

            $student_details_row->close();

            $student_educational_details_row = $ui->row()
                                ->open();

        $student_educational_details_box = $ui->box()
                                                      ->uiType('primary')
                                                      ->solid()
                                                      ->title('Educational Details')
                                                      ->open();

                    $ui->input()
                       ->type('hidden')
                       ->value($stu_basic_details->type)
                       ->id('student_type')
                       ->show();

                  $educational_details_row = $ui->row()
                                                ->open();

                    $educational_details_row_1 = $ui->row()
                                                    ->open();

                    if($stu_education_details != FALSE)
                    {

                        $table = $ui->table()
                                    ->responsive()
                                    ->id('tableid')
                                    ->hover()
                                    ->width(12)
                                    ->bordered()
                                    ->open();


                            echo '
                            <tr>
                                <th>S no.</th>
                                <th>Examination</th>
                                <th>Branch/Specialization</th>
                                <th>School/College/University/Institute</th>
                                <th>Year</th>
                                <th>Percentage/Grade</th>
                                <th>Class/Division</th>
                            </tr>';

                            $i=1;
              foreach($stu_education_details as $row)
              {
                $year_array = array();
                              $year = 1926;
                              $present_year = date('Y');
                              while ($year <= $present_year)
                              {
                                if($row->year == $year)
                                  $year_array[] = $ui->option()->value($year)->text($year)->selected();
                                else
                                    $year_array[] = $ui->option()->value($year)->text($year);
                                  $year_array = array_values($year_array);
                                  $year++;
                              }

                              $class_div_array = array();

                              if($row->division=="first")
                                $class_div_array[] = $ui->option()->value('first')->text('FIRST')->selected();
                              else
                                $class_div_array[] = $ui->option()->value('first')->text('FIRST');

                              $class_div_array = array_values($class_div_array);

                              if($row->division=="second") 
                                $class_div_array[] = $ui->option()->value('second')->text('SECOND')->selected();
                              else
                                $class_div_array[] = $ui->option()->value('second')->text('SECOND');

                              $class_div_array = array_values($class_div_array);

                            if($row->division=="third") 
                                $class_div_array[] = $ui->option()->value('third')->text('THIRD')->selected();
                              else
                                $class_div_array[] = $ui->option()->value('third')->text('THIRD');

                              $class_div_array = array_values($class_div_array);

                            if($row->division=="na") 
                                $class_div_array[] = $ui->option()->value('na')->text('NA')->selected();
                              else
                                $class_div_array[] = $ui->option()->value('na')->text('NA');
                echo '
                              <tr name="row[]" id="addrow" align="center">
                                  <td id="sno">'.$i.'</td>
                                  <td>';$ui->input()
                                           ->name('exam4[]')
                                           ->value(strtoupper($row->exam))
                                           ->show();echo'</td>
                                  <td>';$ui->input()
                                           ->name('branch4[]')
                                           ->value(strtoupper($row->branch))
                                           ->show();echo'</td>
                                  <td>';$ui->input()
                                           ->name('clgname4[]')
                                           ->value(strtoupper($row->institute))
                                           ->show();echo'</td>
                                  <td>';$ui->select()
                                           ->name('year4[]')
                                           ->options($year_array)
                                           ->show();echo'</td>
                                  <td>';$ui->input()
                                           ->name('grade4[]')
                                           ->value(strtoupper($row->grade))
                                           ->show();echo'</td>
                                  <td>';$ui->select()
                                           ->name('div4[]')
                                           ->options($class_div_array)
                                           ->show();echo'</td>
                              </tr>';
                              $i++;
                          }

                        $table->close();
                    }

                    $educational_details_row_1->close();

                    $educational_details_row_2 = $ui->row()
                                                    ->open();

                        $educational_detail_col_1 = $ui->col()
                                                       ->width(5)
                                                       ->open();
                        $educational_detail_col_1->close();

                        $educational_detail_col_1 = $ui->col()
                                                       ->width(2)
                                                       ->open();

                            $ui->button()
                               ->block()
                               ->value('Add More')
                               ->id('add')
                               ->name('add')
                               ->show();

                        $educational_detail_col_1->close();

                    $educational_details_row_2->close();

                  $educational_details_row->close();

                $student_educational_details_box->close();

          $student_educational_details_row->close();

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
                           ->value($user_details->email)
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Alternate Email')
                           ->name('alternate_email_id')
                           ->id('alternate_email_id')
                           ->type('email')
                           ->value($stu_basic_details->alternate_email_id)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Mobile No.')
                           ->name('mobile')
                           ->id('mobile')
                           ->required()
                           ->value($user_other_details->mobile_no)
                           ->required()
                           ->width(3)
                           ->show();

                        if($stu_basic_details->alternate_mobile_no == '0')
                          $alternate_mobile_number = '';
                        else
                          $alternate_mobile_number = $stu_basic_details->alternate_mobile_no;
                        $ui->input()
                           ->label('Alternate Mobile No.')
                           ->name('alternate_mobile')
                           ->id('alternate_mobile')
                           ->value($alternate_mobile_number)
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
                           ->value($user_other_details->hobbies)
                           ->show();

                        $ui->input()
                           ->label('Favourite Pass Time')
                           ->name('favpast')
                           ->id('favpast')
                           ->value($user_other_details->fav_past_time)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Extra-Curricular Activities ( if any):')
                           ->name('extra_activity')
                           ->id('extra_activity')
                           ->value($stu_other_details->extra_curricular_activity)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Any other relevant information')
                           ->name('any_other_information')
                           ->id('any_other_information')
                           ->value($stu_other_details->other_relevant_info)
                           ->width(3)
                           ->show();


                    $editable_details_row_2 ->close();

                $student_editable_details_box->close();

            $studenteditable_details->close();

            $photedit_row_0 = $ui->row()
                                 ->open();

                $photoedit_box_1 = $ui->box()
                                      ->title('Profile Pic')
                                      ->solid()
                                      ->uiType('primary')
                                      ->open();

                    $photoedit_row_4 = $ui->row()
                                          ->open();

                        $photoedit_col_4_1 = $ui->col()
                                                ->width(4)
                                                ->open();

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
                                         ->width(12)
                                         ->show();

                    $photoedit_row_1->close();

                $photoedit_box_1->close();

            $photedit_row_0->close();

            $student_details_row_2 = $ui->row()
                                          ->open();

                    $student_details_2_1 = $ui->col()
                                              ->width(5)
                                              ->open();

                        $student_details_2_1->close();

                        $ui->button()
                           ->submit(true)
                           ->value('Submit')
                           ->uiType('primary')
                           ->id('submit_button_id')
                           ->width(2)
                           ->show();

                $student_details_row_2->close();

                $student_details_row_3 = $ui->row()
                                          ->open();

                    $student_details_3_1 = $ui->col()
                                              ->width(11)
                                              ->open();

                        $student_details_3_1->close();

                      ?><a href= <?= site_url('student/student_edit')?> ><?php

                        $ui->button()
                           ->value('Back')
                           ->uiType('primary')
                           ->width(1)
                           ->show();?></a><?php

                $student_details_row_3->close();
?>