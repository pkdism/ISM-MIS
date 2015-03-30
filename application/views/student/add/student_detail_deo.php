<?php

    $ui = new UI();

        $form=$ui->form()
                 ->action('student/student_add_deo/insert_basic_details')
                 ->multipart()
                 ->id('form_submit')
                 ->open();

            $student_admn_no = $ui->row()
                                  ->open();

                $column1 = $ui->col()
                              ->width(10)
                              ->open();

                    $ui->input()
                       ->placeholder('Admission No.')
                       ->uiType('primary')
                       ->id('stu_id')
                       ->name('stu_id')
                       ->show();

                $column1->close();

                $column2 = $ui->col()
                              ->width(2)
                              ->open();

                    $ui->button()
                       ->value('Go')
                       ->uiType('primary')
                       ->id('fetch_id_btn')
                       ->block()
                       ->show();

                $column2->close();

            $student_admn_no->close();

            ?><div id="stu_details_hidden"><?php

            $student_details_row = $ui->row()
                                  ->open();

                $student_details_box = $ui->box()
                                          ->uiType('primary')
                                          ->solid()
                                          ->title('Personal Details')
                                          ->open();

                    $student_name = $ui->row()
                                       ->open();

                            $ui->select()
                               ->name('salutation')
                               ->width(3)
                               ->options(array($ui->option()->value('mr')->text('Mr'),
                                               $ui->option()->value('mrs')->text('Mrs'),
                                               $ui->option()->value('ms')->text('Ms'),
                                               $ui->option()->value('dr')->text('Dr')))
                            ->show();

                            $ui->input()
                               ->placeholder('First Name')
                               ->id('firstname')
                               ->required()
                               ->width(3)
                               ->name('firstname')
                               ->show();

                        $ui->input()
                               ->placeholder('Middle Name')
                               ->id('middlename')
                               ->width(3)
                               ->name('middlename')
                               ->show();

                            $ui->input()
                               ->placeholder('Last Name')
                               ->width(3)
                               ->id('lastname')
                               ->name('lastname')
                               ->show();

                    $student_name->close();

                    $student_personal_details_row_1 = $ui->row()
                                                         ->open();

                            $ui->input()
                               ->label('पूरा नाम हिन्दी में')
                               ->id('stud_name_hindi')
                               ->name('stud_name_hindi')
                               ->width(3)
                               ->show();

                        $column_gender = $ui->col()
                                      ->width(3)
                                      ->open();
                            echo '<label>Gender</label>';

                            $ui->radio()
                               ->name('sex')
                               ->label('Male')
                               ->value('male')
                               ->checked()
                               ->show();

                            $ui->radio()
                               ->name('sex')
                               ->label('Female')
                               ->value('female')
                               ->show();

                            $ui->radio()
                               ->name('sex')
                               ->label('Others')
                               ->value('others')
                               ->show();

                        $column_gender->close();

                            $ui->datePicker()
                               ->label('Date of Birth')
                               ->width(3)
                               ->name('dob')
                               ->value(date("d-m-Y", time()+(19800)))
                               ->dateFormat('dd-mm-yyyy')
                               ->show();

                            $ui->input()
                               ->label('Place of Birth')
                               ->name('pob')
                               ->required()
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
                               ->show();

                            $ui->radio()
                               ->name('pd')
                               ->label('No')
                               ->value('no')
                               ->checked()
                               ->show();

                        $column_pd->close();

                        $ui->select()
                           ->name('blood_group')
                           ->width(3)
                           ->label('Blood Group')
                           ->options(array($ui->option()->value('A+')->text('A+'),
                                           $ui->option()->value('A-')->text('A-'),
                                           $ui->option()->value('B+')->text('B+'),
                                           $ui->option()->value('B-')->text('B-'),
                                           $ui->option()->value('O+')->text('O+'),
                                           $ui->option()->value('O-')->text('O-'),
                                           $ui->option()->value('AB+')->text('AB+'),
                                           $ui->option()->value('AB-')->text('AB-')))
                           ->show();

                        $column_ki = $ui->col()
                                        ->width(3)
                                        ->open();
                            echo '<label>Kashmiri Immigrant</label>';

                            $ui->radio()
                               ->name('kashmiri')
                               ->label('Yes')
                               ->value('yes')
                               ->show();

                            $ui->radio()
                               ->name('kashmiri')
                               ->label('No')
                               ->value('no')
                               ->checked()
                               ->show();

                        $column_ki->close();

                        $ui->select()
                           ->name('mstatus')
                           ->width(3)
                           ->label('Marital Status')
                           ->options(array($ui->option()->value('unmarried')->text('Unmarried'),
                                           $ui->option()->value('married')->text('Married'),
                                           $ui->option()->value('widow')->text('Widow'),
                                           $ui->option()->value('Widower')->text('Widower'),
                                           $ui->option()->value('divorcee')->text('Divorcee'),
                                           $ui->option()->value('separated')->text('Separated')))
                           ->show();

                    $student_personal_details_row_2->close();

                    $student_personal_details_row_3 = $ui->row()
                                                         ->open();

                        $ui->select()
                           ->name('category')
                           ->width(3)
                           ->label('Category')
                           ->options(array($ui->option()->value('General')->text('GEN'),
                                           $ui->option()->value('obc')->text('OBC'),
                                           $ui->option()->value('SC')->text('SC'),
                                           $ui->option()->value('ST')->text('ST'),
                                           $ui->option()->value('Others')->text('OTHERS')))
                           ->show();

                        $ui->select()
                           ->name('religion')
                           ->width(3)
                           ->label('Religion')
                           ->options(array($ui->option()->value('HINDU')->text('HINDU'),
                                           $ui->option()->value('CHRISTIAN')->text('CHRISTIAN'),
                                           $ui->option()->value('MUSLIM')->text('MUSLIM'),
                                           $ui->option()->value('SIKH')->text('SIKH'),
                                           $ui->option()->value('BAUDHH')->text('BAUDHH'),
                                           $ui->option()->value('JAIN')->text('JAIN'),
                                           $ui->option()->value('PARSI')->text('PARSI'),
                                           $ui->option()->value('YAHUDI')->text('YAHUDI'),
                                           $ui->option()->value('OTHERS')->text('OTHERS')))
                           ->show();

                        $ui->input()
                           ->label('Nationality')
                           ->name('nationality')
                           ->value('Indian')
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Aadhaar Card No.')
                           ->id('aadhaar_no')
                           ->name('aadhaar_no')
                           ->width(3)
                           ->show();

                    $student_personal_details_row_3->close();

                    $student_personal_details_row_4 = $ui->row()
                                                         ->open();

                        $ui->input()
                           ->label('Identification Mark')
                           ->name('identification_mark')
                           ->required()
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
                               ->show();

                            $ui->input()
                               ->label('Father\'s Occupation')
                               ->id('father_occupation')
                               ->name('father_occupation')
                               ->show();

                            $ui->input()
                               ->label('Father\'s Gross Annual Income')
                               ->id('father_gross_income')
                               ->name('father_gross_income')
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
                               ->show();

                            $ui->input()
                               ->label('Mother\'s Occupation')
                               ->id('mother_occupation')
                               ->name('mother_occupation')
                               ->show();

                            $ui->input()
                               ->label('Mother\'s Gross Annual Income')
                               ->id('mother_gross_income')
                               ->name('mother_gross_income')
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

                            echo '<input type="checkbox" name="depends_on" id="depends_on"/>        ';

                            echo '<label>Fill Guardian Details</label>';

                            /*$ui->checkbox()
                               ->name('depends_on')
                               ->id('depends_on')
                               ->show();*/

                            $ui->input()
                               ->label('Guardian\'s Name')
                               ->id('guardian_name')
                               ->name('guardian_name')
                               ->disabled()
                               ->show();

                            $ui->input()
                               ->label('Relationship')
                               ->id('guardian_relation_name')
                               ->name('guardian_relation_name')
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
                           ->width(6)
                           ->name('parent_mobile')
                           ->show();

                        $ui->input()
                           ->label('Parent/Guardian Landline No')
                           ->id('parent_landline')
                           ->width(6)
                           ->name('parent_landline')
                           ->show();

                    $family_contact_details_row->close();

                $student_family_details_box->close();

                $student_address_details_box = $ui->box()
                                                  ->uiType('primary')
                                                  ->solid()
                                                  ->title('Address Details')
                                                  ->open();

                    $state_array = array();
                    foreach ($states as $row)
                    {
                      $state_array[] = $ui->option()->value($row->state_name)->text(ucwords($row->state_name));
                      $state_array = array_values($state_array);
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
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Address Line 2')
                               ->name('line21')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('City')
                               ->name('city1')
                               ->required()
                               ->show();

                            /*$ui->input()
                               ->label('State')
                               ->name('state1')
                               ->required()
                               ->show();*/

                            $ui->select()
                               ->label('State')
                               ->name('state1')
                               ->options($state_array)
                               ->show();

                            $ui->input()
                               ->label('Pincode')
                               ->name('pincode1')
                               ->id('pincode1')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Country')
                               ->name('country1')
                               ->value('India')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Contact No.')
                               ->name('contact1')
                               ->id('contact1')
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
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Address Line 2')
                               ->name('line22')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('City')
                               ->name('city2')
                               ->required()
                               ->show();

                            /*$ui->input()
                               ->label('State')
                               ->name('state2')
                               ->required()
                               ->show();*/

                            $ui->select()
                               ->label('State')
                               ->name('state2')
                               ->options($state_array)
                               ->show();

                            $ui->input()
                               ->label('Pincode')
                               ->name('pincode2')
                               ->id('pincode2')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Country')
                               ->name('country2')
                               ->value('India')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Contact No.')
                               ->name('contact2')
                               ->id('contact2')
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
                                                       ->width(2)
                                                       ->open();*/

                            /*$ui->checkbox()
                               ->name('correspondence_addr')
                               ->id('correspondence_addr')
                               ->checked()
                               ->width(2)
                               ->show();*/

                        //$check_corr_address_col_1->close();

                        $check_corr_address_col_2 = $ui->col()
                                                       ->width(7)
                                                       ->open();

                            echo '<input type="checkbox" name="correspondence_addr" id="correspondence_addr" checked/>        ';

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

                                $ui->input()
                                   ->label('Address Line 1')
                                   ->name('line13')
                                   ->id('line13')
                                   ->show();

                                $ui->input()
                                   ->label('Address Line 2')
                                   ->name('line23')
                                   ->id('line23')
                                   ->show();

                                $ui->input()
                                   ->label('City')
                                   ->name('city3')
                                   ->id('city3')
                                   ->show();

                                /*$ui->input()
                                   ->label('State')
                                   ->name('state3')
                                   ->id('state3')
                                   ->show();*/

                                $ui->select()
                                   ->label('State')
                                   ->name('state3')
                                   ->id('state3')
                                   ->options($state_array)
                                   ->show();

                                $ui->input()
                                   ->label('Pincode')
                                   ->name('pincode3')
                                   ->id('pincode3')
                                   ->show();

                                $ui->input()
                                   ->label('Country')
                                   ->name('country3')
                                   ->id('country3')
                                   ->value('India')
                                   ->show();

                                $ui->input()
                                   ->label('Contact No.')
                                   ->name('contact3')
                                   ->id('contact3')
                                   ->show();

                        $correspondence_address_details_box->close();

                        $corr_address_col_2->close();

                    $address_details_row_3 ->close();

                    ?></div><?php

                $student_address_details_box->close();

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
                           ->show();

                        $ui->input()
                           ->label('Roll No.')
                           ->id('roll_no')
                           ->name('roll_no')
                           ->placeholder('eg. IIT-JEE enrollment no.')
                           ->width(3)
                           ->show();

                        $ui->datePicker()
                           ->label('Date of Admission')
                           ->width(3)
                           ->name('entrance_date')
                           ->value(date("d-m-Y", time()+(19800)))
                           ->dateFormat('dd-mm-yyyy')
                           ->show();

                        $ui->select()
                           ->name('admn_based_on')
                           ->id('id_admn_based_on')
                           ->width(3)
                           ->label('Admission Based On')
                           ->options(array($ui->option()->value('iitjee')->text('IIT JEE'),
                                           $ui->option()->value('isme')->text('ISM Entrance'),
                                           $ui->option()->value('gate')->text('GATE'),
                                           $ui->option()->value('cat')->text('CAT'),
                                           $ui->option()->value('direct')->text('Direct'),
                                           $ui->option()->value('others')->text('Others')))
                           ->show();

                    $admission_details_row_1->close();

                    $admission_details_row_2 = $ui->row()
                                                  ->open();

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
                           ->value('0')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('IIT JEE Category Rank')
                           ->id('iitjee_cat_rank')
                           ->name('iitjee_cat_rank')
                           ->value('0')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Gate Score')
                           ->id('gate_score')
                           ->name('gate_score')
                           ->disabled()
                           ->value('0')
                           ->width(3)
                           ->show();

                    $admission_details_row_2->close();

                    $admission_details_row_3 = $ui->row()
                                                ->open();

                        $ui->input()
                           ->label('Cat Score')
                           ->id('cat_score')
                           ->name('cat_score')
                           ->value('0')
                           ->disabled()
                           ->width(3)
                           ->show();

                        $ui->select()
                           ->label('Student Type')
                           ->id('stu_type')
                           ->name('stu_type')
                           ->width(3)
                           ->options(array($ui->option()->value('ug')->text('UnderGraduate'),
										   $ui->option()->value('g')->text('Graduate'),
                                           $ui->option()->value('pg')->text('Post Graduate'),
                                           $ui->option()->value('jrf')->text('Junior Research Fellow'),
                                           $ui->option()->value('pd')->text('Post Doctoral Fellow')))
                           ->show();

                        $ui->select()
                           ->label('Present Semester')
                           ->name('semester')
                           ->width(3)
                           ->options(array($ui->option()->value('1')->text('1'),
                                           $ui->option()->value('2')->text('2'),
                                           $ui->option()->value('3')->text('3'),
                                           $ui->option()->value('4')->text('4'),
                                           $ui->option()->value('5')->text('5'),
                                           $ui->option()->value('6')->text('6'),
                                           $ui->option()->value('7')->text('7'),
                                           $ui->option()->value('8')->text('8'),
                                           $ui->option()->value('9')->text('9'),
                                           $ui->option()->value('10')->text('10')))
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
                                $dept_array[] = $ui->option()->value($row->id)->text($row->name);
                                $dept_array = array_values($dept_array);
                            }

                        $course_array = array();

                        if($courses === FALSE)
                            $course_array[] = $ui->option()->value('none')->text('No Course');
                        else
                            foreach ($courses as $row)
                            {
                                $course_array[] = $ui->option()->value($row->id)->text($row->name);
                                $course_array = array_values($course_array);
                            }

                        $branch_array = array();

                        if($branches === FALSE)
                            $branch_array[] = $ui->option()->value('none')->text('No Branch');
                        else
                            foreach ($branches as $row)
                            {
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

                $student_educational_details_box = $ui->box()
                                                      ->uiType('primary')
                                                      ->solid()
                                                      ->title('Educational Details')
                                                      ->open();

                    $educational_details_row_1 = $ui->row()
                                                    ->open();

                        $educational_detail_col = $ui->col()
                                                     ->width(12)
                                                     ->open();

                        $table = $ui->table()
                                    ->responsive()
                                    ->id('tableid')
                                    ->hover()
                                    ->bordered()
                                    ->open();

                            $year_array = array();
                            $year = 1926;
                            $present_year = date('Y');
                            while ($year <= $present_year)
                            {
                                $year_array[] = $ui->option()->value($year)->text($year);
                                $year_array = array_values($year_array);
                                $year++;
                            }


                            echo '
                            <tr>
                                <th>S No.</th>
                                <th>Examination</th>
                                <th>Branch/Specialization</th>
                                <th>School/College/University/Institute</th>
                                <th>Year</th>
                                <th>Percentage/Grade</th>
                                <th>Class/Division</th>
                            </tr>
                            <tr id="addrow">
                                <td id="sno">1</td>
                                <td>';$ui->input()
                                         ->name('exam4[]')
                                         ->show();echo'</td>
                                <td>';$ui->input()
                                         ->name('branch4[]')
                                         ->show();echo'</td>
                                <td>';$ui->input()
                                         ->name('clgname4[]')
                                         ->show();echo'</td>
                                <td>';$ui->select()
                                         ->name('year4[]')
                                         ->options($year_array)
                                         ->show();echo'</td>
                                <td>';$ui->input()
                                         ->name('grade4[]')
                                         ->show();echo'</td>
                                <td>';$ui->select()
                                         ->name('div4[]')
                                         ->options(array($ui->option()->value('first')->text('FIRST'),
                                               $ui->option()->value('second')->text('SECOND'),
                                               $ui->option()->value('third')->text('THIRD'),
                                               $ui->option()->value('na')->text('NA')))
                                         ->show();echo'</td>
                            </tr>';

                        $table->close();

                        $educational_detail_col->close();

                    $educational_details_row_1->close();

                    $educational_details_row_1 = $ui->row()
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

                    $educational_details_row_1->close();

                $student_educational_details_box->close();

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
                           ->required()
                           ->width(6)
                           ->show();

                        $ui->input()
                           ->label('Bank Account No.')
                           ->name('bank_account_no')
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
                           ->options(array($ui->option()->value('dd')->text('CHEQUE'),
                                           $ui->option()->value('cheque')->text('CASH'),
                                           $ui->option()->value('online')->text('ONLINE TRANSFER'),
                                           $ui->option()->value('none')->text('NONE')->selected()))
                           ->show();

                        $ui->datePicker()
                           ->label('Fees Paid Date')
                           ->width(3)
                           ->name('fee_paid_date')
                           ->value(date("d-m-Y", time()+(19800)))
                           ->dateFormat('dd-mm-yyyy')
                           ->show();

                        $ui->input()
                           ->label('DD/CHEQUE/ONLINE/CASH NO.')
                           ->name('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
                           ->id('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Fees Paid Amount')
                           ->name('fee_paid_amount')
                           ->id('fee_paid_amount')
                           ->width(3)
                           ->show();

                    $fee_details_row_1 ->close();

                $student_fee_details_box->close();

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
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Alternate Email')
                           ->name('alternate_email_id')
                           ->id('alternate_email_id')
                           ->type('email')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Mobile No.')
                           ->name('mobile')
                           ->id('mobile')
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Alternate Mobile No.')
                           ->name('alternate_mobile')
                           ->id('alternate_mobile')
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
                           ->show();

                        $ui->input()
                           ->label('Favourite Pass Time')
                           ->name('favpast')
                           ->id('favpast')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Extra-Curricular Activities ( if any):')
                           ->name('extra_activity')
                           ->id('extra_activity')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Any other relevant information')
                           ->name('any_other_information')
                           ->id('any_other_information')
                           ->width(3)
                           ->show();


                    $editable_details_row_2 ->close();

                $student_editable_details_box->close();

                $student_photo_details_box = $ui->box()
                                                ->uiType('primary')
                                                ->solid()
                                                ->title('Photograph')
                                                ->open();

                    $photo_details_row_1 = $ui->row()
                                              ->open();

                        $upload_img = $ui->imagePicker()
                                         ->id('photo')
                                         ->name('photo')
                                         ->width(12)
                                         ->required()
                                         ->show();

                    $photo_details_row_1 ->close();

                $student_photo_details_box->close();

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

            $student_details_row->close();

        $form->close();

?>