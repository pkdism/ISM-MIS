<?php $ui = new UI();

                                    //states options
                                    $present_state_options = array($ui->option()->value("")->text("Choose One")->disabled()->selected());
                                    foreach($states as $row)
                                        array_push($present_state_options,$ui->option()->value($row->state_name)->text(ucwords($row->state_name))->selected($row->state_name == $present_address->state));

                                    $permanent_state_options = array($ui->option()->value("")->text("Choose One")->disabled()->selected());
                                    foreach($states as $row)
                                        array_push($permanent_state_options,$ui->option()->value($row->state_name)->text(ucwords($row->state_name))->selected($row->state_name == $permanent_address->state));

                                    //designation options
                                    $designations=$this->designations_model->get_designations("type in ('".(($emp->auth_id == 'ft')? 'ft':'nft')."','others')");
                                    $des_options = array();
                                    if($designations == FALSE)
                                        array_push($des_options,$ui->option()->value("")->disabled()->text('No designation found'));
                                    else
                                        foreach($designations as $row)
                                        {
                                            array_push($des_options,$ui->option()->value($row->id)->text(ucwords($row->name))->selected($row->id == $emp->designation));
                                        }

                                    //department options
                                    $dept_options = array();
                                    if($emp->auth_id == 'ft')
                                        $departments=$this->departments_model->get_departments('academic');
                                    else if($emp->auth_id == 'nftn')
                                        $departments=$this->departments_model->get_departments('nonacademic');
                                    else
                                        $departments=$this->departments_model->get_departments();

                                    if($departments === FALSE)
                                        array_push($dept_options,$ui->option()->value("")->text('No department found')->disabled());
                                    else
                                        foreach($departments as $row)
                                        {
                                            array_push($dept_options,$ui->option()->value($row->id)->text($row->name)->selected($row->id == $user_details->dept_id));
                                        }
                                    //pay_options
                                    $pay_options = array($ui->option()->value("")->text("Choose One")->disabled());
                                    if($pay_bands === FALSE)
                                        array_push($pay_options,$ui->option()->value("")->text("No pay band found")->disabled());
                                    else
                                        foreach($pay_bands as $row)
                                            array_push($pay_options,$ui->option()->value($row->pay_band)->text(strtoupper($row->pay_band).' ('.$row->pay_band_description.')')->selected($row->pay_band == $emp_pay_details->pay_band));

                                    //gradepay options
                                    $grade_options = array();
                                    $gradepay=$this->pay_scales_model->get_grade_pay($emp_pay_details->pay_band);
                                    foreach($gradepay as $row)
                                        array_push($grade_options,$ui->option()->value($row->pay_code)->text($row->grade_pay)->selected($row->grade_pay == $emp_pay_details->grade_pay));


$form = $ui->form()->id('basic_details')->action('employee/edit/update_own_basic_details/'.$emp_id)->open();
$row = $ui->row()->open();
    $col = $ui->col()->width(12)->open();
        $basic_box = $ui->box()->uiType('primary')->solid()->title('Personal Details')->open();
        echo 'Fields marked with <span style= "color:red;">*</span> are mandatory.<br><br> ';

            $row3 = $ui->row()->open();
                    $ui->select()->width(2)->name('salutation')
                                ->label('Salutation<span style= "color:red;"> *</span>')
                                ->options(array($ui->option()->value('Dr')->text('Dr')->selected($user_details->salutation == 'Dr'),
                                                $ui->option()->value('Prof')->text('Prof')->selected($user_details->salutation == 'Prof'),
                                                $ui->option()->value('Mr')->text('Mr')->selected($user_details->salutation == 'Mr'),
                                                $ui->option()->value('Mrs')->text('Mrs')->selected($user_details->salutation == 'Mrs'),
                                                $ui->option()->value('Ms')->text('Ms')->selected($user_details->salutation == 'Ms')))
                                ->show();
                    $ui->input()->width(3)->name('firstname')
                                ->required()
                                ->disabled()
                                ->placeholder("First Name")
                                ->value($user_details->first_name)
                                ->label('First Name<span style= "color:red;"> *</span>')
                                ->show();
                    $ui->input()->width(3)->name('middlename')
                                    ->disabled()
                                    ->label('Middle Name')
                                    ->value($user_details->middle_name)
                                    ->placeholder("Middle Name")
                                    ->show();
                    $ui->input()->width(3)->name('lastname')
                                ->disabled()
                                ->value($user_details->last_name)
                                ->placeholder("Last Name")
                                ->label('Last Name')
                                ->show();
            $row3->close();

            $row4 = $ui->row()->open();
                $ui->select()->width(3)->name('mstatus')
                                ->label('Marital Status<span style= "color:red;"> *</span>')
                                ->options(array($ui->option()->value('married')->text('Married')->selected($user_details->marital_status == 'married'),
                                                $ui->option()->value('unmarried')->text('Unmarried')->selected($user_details->marital_status == 'unmarried'),
                                                $ui->option()->value('widow')->text('Widow')->selected($user_details->marital_status == 'widow'),
                                                $ui->option()->value('widower')->text('Widower')->selected($user_details->marital_status == 'widower'),
                                                $ui->option()->value('separated')->text('Separated')->selected($user_details->marital_status == 'separated'),
                                                $ui->option()->value('divorced')->text('Divorced')->selected($user_details->marital_status == 'divorced')))
                                ->show();

                $ui->datePicker()
                    ->label('DOB<span style= "color:red;"> *</span>')
                    ->id('dob')
                    ->disabled()
                    ->name('dob')
                    ->required()
                    ->dateFormat('dd-mm-yyyy')
                    ->width(3)
                    ->addonRight($ui->icon("calendar"))
                    ->value(date("d-m-Y",strtotime($user_details->dob)))
                    ->extras('max="'.date("d-m-Y").'"')
                    ->show();

                $ui->input()->width(3)->name('pob')
                                ->required()->disabled()
                                ->value($user_other_details->birth_place)
                                ->label('Place of Birth<span style= "color:red;"> *</span>')
                                ->show();
            $row4->close();



            $row2 = $ui->row()->open();
                $col1 = $ui->col()->width(3)->open();
                    echo '<label>Gender<span style= "color:red;"> *</span></label>';
                    $ui->radio()->name('sex')->value('m')->label('Male')->disabled()->checked($user_details->sex == 'm')->show();
                    $ui->radio()->name('sex')->value('f')->label('Female')->disabled()->checked($user_details->sex == 'f')->show();
                    $ui->radio()->name('sex')->value('k')->label('Others')->disabled()->checked($user_details->sex == 'k')->show();
                $col1->close();

                $col2 = $ui->col()->width(3)->open();
                    echo '<label>Physically Challenged<span style= "color:red;"> *</span></label>';
                    $ui->radio()->name('pd')->value('yes')->label('Yes')->checked($user_details->physically_challenged=="yes")->show();
                    $ui->radio()->name('pd')->value('no')->label('No')->checked($user_details->physically_challenged=="no")->show();
                $col2->close();

                $col3 = $ui->col()->width(3)->open();
                    echo '<label>Kashmiri Immigrant<span style= "color:red;"> *</span></label>';
                    $ui->radio()->name('kashmiri')->value('yes')->label('Yes')->disabled()->checked($user_other_details->kashmiri_immigrant=='yes')->show();
                    $ui->radio()->name('kashmiri')->value('no')->label('No')->disabled()->checked($user_other_details->kashmiri_immigrant=='no')->show();
                $col3->close();
            $row2->close();





            $row5 = $ui->row()->open();
                $ui->input()->width(3)->name('father')
                                ->required()
                                ->label('Father\'s Name<span style= "color:red;"> *</span>')
                                ->value($user_other_details->father_name)
                                ->disabled()
                                ->show();
                $ui->input()->width(3)->name('mother')
                                ->required()
                                ->label('Mother\'s Name<span style= "color:red;"> *</span>')
                                ->value($user_other_details->mother_name)
                                ->disabled()
                                ->show();
            $row5->close();

            $row6 = $ui->row()->open();
                $ui->select()->width(3)->name('category')
                                ->label('Category<span style= "color:red;"> *</span>')
                                ->disabled()
                                ->options(array($ui->option()->value('General')->text('GEN')->selected($user_details->category=="General"),
                                                $ui->option()->value('OBC')->text('OBC')->selected($user_details->category=="OBC"),
                                                $ui->option()->value('SC')->text('SC')->selected($user_details->category=="SC"),
                                                $ui->option()->value('ST')->text('ST')->selected($user_details->category=="ST"),
                                                $ui->option()->value('Others')->text('Others')->selected($user_details->category=="Others")))
                                ->show();
                $ui->input()->width(3)->name('nationality')
                                ->required()
                                ->disabled()
                                ->value($user_other_details->nationality)
                                ->label('Nationality<span style= "color:red;"> *</span>')
                                ->show();
                $ui->input()->width(3)->name('religion')
                                ->required()
                                ->disabled()
                                ->value($user_other_details->religion)
                                ->label('Religion<span style= "color:red;"> *</span>')
                                ->show();
            $row6->close();
        $basic_box->close();

    $col->close();
    $col = $ui->col()->width(4)->open();
        $emp_box = $ui->box()->uiType('primary')->solid()->title('Employment Details')->open();
            $ui->select()->name('tstatus')
                            ->id('tstatus')
                            ->disabled()
                            ->label('Employee Type<span style= "color:red;"> *</span>')
                            ->options(array($ui->option()->value('ft')->text('Faculty')->selected($emp->auth_id=='ft'),
                                            $ui->option()->value('nfta')->text('Non Faculty (Academic)')->selected($emp->auth_id=='nfta'),
                                            $ui->option()->value('nftn')->text('Non Faculty (Non Academic)')->selected($emp->auth_id=='nftn')))
                            ->show();

            $ui->datePicker()
                ->label('Date of Joining<span style= "color:red;"> *</span>')
                ->name('entrance_age')
                ->required()
                ->disabled()
                ->dateFormat('dd-mm-yyyy')
                ->addonRight($ui->icon("calendar"))
                ->value(date("d-m-Y",strtotime($emp->joining_date)))
                ->show();

            $ui->select()->name('designation')
                        ->label('Designation<span style= "color:red;"> *</span>')
                        ->options($des_options)
                        ->disabled()
                        ->id('des')
                        ->show();

            $ui->select()
                ->name('department')
                ->label('Department/Section<span style= "color:red;"> *</span>')
                ->options($dept_options)
                ->disabled()
                ->id('depts')
                ->show();

            $research = $ui->input()->name('research_int')
                            ->id('res_int_id')
                            ->label('Research Interest');
            if($emp->auth_id == 'ft')
                $research->value($ft->research_interest);
            else    $research->disabled();
            $research->show();

            $ui->select()->name('empnature')
                            ->disabled()
                            ->label('Nature of Employment<span style= "color:red;"> *</span>')
                            ->options(array($ui->option()->value('permanent')->text('Permanent')->selected($emp->employment_nature=='permanent'),
                                            $ui->option()->value('temporary')->text('Temporary')->selected($emp->employment_nature=='temporary'),
                                            $ui->option()->value('probation')->text('Probation')->selected($emp->employment_nature=='probation'),
                                            $ui->option()->value('contract')->text('Contract')->selected($emp->employment_nature=='contract'),
                                            $ui->option()->value('others')->text('Others')->selected($emp->employment_nature=='others')))
                            ->show();

            $dt = DateTime::createFromFormat("Y-m-d", $emp->retirement_date);
            $ui->datePicker()
                ->label('Date of Retirement<span style= "color:red;"> *</span>')
                ->id('retire')
                ->disabled()
                ->name('retire')
                ->value($dt->format('d-m-Y'))
                ->required()
                ->dateFormat('dd-mm-yyyy')
                ->addonRight($ui->icon("calendar"))
                ->show();

        $emp_box->close();

        $pay_box = $ui->box()->uiType('primary')->solid()->title('Payment Details')->open();

            $ui->select()->name('payscale')->id('payscale')->label('Pay Band<span style= "color:red;"> *</span>')
                        ->options($pay_options)->required()->disabled()->show();

            $ui->select()->name("gradepay")->id("gradepay")->label('Grade Pay<span style= "color:red;"> *</span>')
                            ->addonLeft($ui->icon('rupee'))
                            ->addonRight('.00')
                            ->disabled()
                            ->options($grade_options)
                            ->disabled()->required()->show();

            $ui->input()->name("basicpay")
                        ->id("basicpay")
                        ->label('Basic Pay<span style= "color:red;"> *</span>')
                        ->value($emp_pay_details->basic_pay)
                        ->disabled()
                        ->addonLeft($ui->icon('rupee'))
                        ->addonRight('.00')
                        ->required()->show();
        $pay_box->close();
    $col->close();

    $col = $ui->col()->width(8)->open();
        $addr_box = $ui->box()->uiType('primary')->solid()->title('Address Details')->open();
            $row1 = $ui->row()->open();
            $col1 = $ui->col()->width(6)->t_width(6)->open();
            echo '<h3 class="page-header">Present Address</h3>';
                $ui->textarea()->name('line11')
                                ->required()
                                ->label('Address Line 1<span style= "color:red;"> *</span>')
                                ->value($present_address->line1)
                                ->show();
                $ui->input()->name('line21')
                                ->label('Address Line 2')
                                ->value($present_address->line2)
                                ->show();
                $ui->input()->name('city1')
                                ->label('City<span style= "color:red;"> *</span>')
                                ->value($present_address->city)
                                ->required()
                                ->show();
                $ui->select()->name('state1')
                                ->label('State<span style= "color:red;"> *</span>')
                                ->required()
                                ->options($present_state_options)
                                ->show();
                $ui->input()->name('pincode1')
                                ->label('Pin Code<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->value($present_address->pincode)
                                ->required()
                                ->show();
                $ui->input()->name('country1')
                                ->label('Country<span style= "color:red;"> *</span>')
                                ->value($present_address->country)
                                ->required()
                                ->show();
                $ui->input()->name('contact11')
                                ->label('Contact No<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->value($present_address->contact_no)
                                ->required()
                                ->show();
            $col1->close();

            $col2 = $ui->col()->width(6)->t_width(6)->open();
            echo '<h3 class="page-header">Permanent Address</h3>';
                $ui->textarea()->name('line12')
                                ->disabled()
                                ->label('Address Line 1<span style= "color:red;"> *</span>')
                                ->value($permanent_address->line1)
                                ->show();
                $ui->input()->name('line22')
                                ->disabled()
                                ->value($permanent_address->line2)
                                ->label('Address Line 2')
                                ->show();
                $ui->input()->name('city2')
                                ->label('City<span style= "color:red;"> *</span>')
                                ->disabled()
                                ->value($permanent_address->city)
                                ->show();
                $ui->select()->name('state2')
                                ->label('State<span style= "color:red;"> *</span>')
                                ->disabled()
                                ->options($permanent_state_options)
                                ->show();
                $ui->input()->name('pincode2')
                                ->label('Pin Code<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->disabled()
                                ->value($permanent_address->pincode)
                                ->show();
                $ui->input()->name('country2')
                                ->label('Country<span style= "color:red;"> *</span>')
                                ->disabled()
                                ->value($permanent_address->country)
                                ->show();
                $ui->input()->name('contact12')
                                ->label('Contact No<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->disabled()
                                ->value($permanent_address->contact_no)
                                ->show();
            $col2->close();
            $row1->close();
        $addr_box->close();

        $other_box = $ui->box()->uiType('primary')->open();
            $row1 = $ui->row()->open();
                $ui->input()->name('hobbies')->width(4)->t_width(6)->label('Hobbies')->value($user_other_details->hobbies)->show();
                $ui->input()->name('favpast')->width(4)->t_width(6)->label('Favourite Past Time')->value($user_other_details->fav_past_time)->show();
                $ui->input()->name('fax')->width(4)->t_width(6)->label('Fax')->type('tel')->value($emp->fax)->show();
                $ui->input()->name('office')->width(4)->t_width(6)->label('Office No')->type('tel')->value($emp->office_no)->show();
                $ui->input()->name('email')->width(4)->t_width(6)->label('Email')->type('email')->addonLeft($ui->icon('envelope'))->value($user_details->email)->show();
                $ui->input()->name('mobile')->width(4)->t_width(6)->addonLeft('+91')->label('Mobile No')->type('tel')->value($user_other_details->mobile_no)->show();
            $row1->close();
        $other_box->close();
    $col->close();
    echo '</div>';
    echo '<a href="'.site_url('home').'">';
    $ui->button()->value("Back")->large()->uiType('primary')->icon($ui->icon("arrow-left"))->show();
    echo '</a>';
    $ui->button()->submit()->classes("pull-right")->value('Save')->name('submit')->large()->uiType('primary')->icon($ui->icon("floppy-o"))->show();
    echo "<br />";
$row->close();
$form->close();
?>