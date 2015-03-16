<?php $ui = new UI();

                                    //states options
                                    $present_state_options = array($ui->option()->value("")->text("Choose One")->disabled()->selected());
                                    foreach($states as $row)
                                        array_push($present_state_options,$ui->option()->value($row->state_name)->text(ucwords($row->state_name))->selected($row->state_name == $pending_present_address->state));

                                    $permanent_state_options = array($ui->option()->value("")->text("Choose One")->disabled()->selected());
                                    foreach($states as $row)
                                        array_push($permanent_state_options,$ui->option()->value($row->state_name)->text(ucwords($row->state_name))->selected($row->state_name == $pending_permanent_address->state));

                                    //designation options
                                    $designations=$this->designations_model->get_designations("type in ('".(($pending_emp->auth_id == 'ft')? 'ft':'nft')."','others')");
                                    $des_options = array();
                                    if($designations == FALSE)
                                        array_push($des_options,$ui->option()->value("")->disabled()->text('No designation found'));
                                    else
                                        foreach($designations as $row)
                                            array_push($des_options,$ui->option()->value($row->id)->text(ucwords($row->name))->selected($row->id == $pending_emp->designation));

                                    //to get previously accpeted designation
                                    $emp_designation = '';
                                    $emp_designations = $this->designations_model->get_designations();
                                    foreach($emp_designations as $row)
                                        if($row->id == $emp->designation)   $emp_designation = ucwords($row->name);


                                    //department options
                                    $dept_options = array();
                                    if($pending_emp->auth_id == 'ft')
                                        $departments = $this->departments_model->get_departments('academic');
                                    else if($pending_emp->auth_id == 'nftn')
                                        $departments = $this->departments_model->get_departments('nonacademic');
                                    else
                                        $departments = $this->departments_model->get_departments();

                                    if($departments === FALSE)
                                        array_push($dept_options,$ui->option()->value("")->text('No department found')->disabled());
                                    else
                                        foreach($departments as $row)
                                            array_push($dept_options,$ui->option()->value($row->id)->text($row->name)->selected($row->id == $pending_user_details->dept_id));

                                    //to get previously accpeted department
                                    $emp_department = '';
                                    $emp_departments = $this->departments_model->get_departments();
                                    foreach($emp_departments as $row)
                                        if($row->id == $user_details->dept_id)   $emp_department = $row->name;


                                    //pay_options
                                    $emp_payband = $emp_gradepay = '';

                                    $pay_options = array($ui->option()->value("")->text("Choose One")->disabled());
                                    if($pay_bands === FALSE)
                                        array_push($pay_options,$ui->option()->value("")->text("No pay band found")->disabled());
                                    else
                                        foreach($pay_bands as $row) {
                                            array_push($pay_options,$ui->option()->value($row->pay_band)->text(strtoupper($row->pay_band).' ('.$row->pay_band_description.')')->selected($row->pay_band == $pending_emp_pay_details->pay_band));
                                            if($row->pay_band == $emp_pay_details->pay_band)    $emp_payband = strtoupper($row->pay_band).' ('.$row->pay_band_description.')';
                                        }
                                    //gradepay options
                                    $grade_options = array();
                                    $gradepay=$this->pay_scales_model->get_grade_pay($pending_emp_pay_details->pay_band);
                                    foreach($gradepay as $row) {
                                        array_push($grade_options,$ui->option()->value($row->pay_code)->text($row->grade_pay)->selected($row->grade_pay == $pending_emp_pay_details->grade_pay));
                                        if($row->grade_pay == $emp_pay_details->grade_pay)  $emp_gradepay = $row->grade_pay;
                                    }
                                    //grade pay to get previously accepted
                                    $emp_gradepays = $this->pay_scales_model->get_grade_pay($emp_pay_details->pay_band);
                                    foreach($emp_gradepays as $row)
                                        if($row->grade_pay == $emp_pay_details->grade_pay)  $emp_gradepay = $row->grade_pay;


$form = $ui->form()->id('basic_details')->action('employee/edit/update_basic_details/'.$emp_id)->open();
$row = $ui->row()->open();
    $col = $ui->col()->width(12)->open();
        $basic_box = $ui->box()->uiType('primary')->solid()->title('Personal Details')->open();

        if($status == 'pending')    $type = 'warning';
        else if($status == 'rejected') $type = 'error';
        else $status = '';

        echo 'Fields marked with <span style= "color:red;">*</span> are mandatory.<br><br> ';

            $row3 = $ui->row()->open();
                    $ui->select()->width(2)->name('salutation')
                                ->help(($pending_user_details->salutation == $user_details->salutation)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$user_details->salutation)
                                ->uiType(($pending_user_details->salutation == $user_details->salutation)?  '':$type)
                                ->label('Salutation<span style= "color:red;"> *</span> ')
                                ->options(array($ui->option()->value('Dr')->text('Dr')->selected($pending_user_details->salutation == 'Dr'),
                                                $ui->option()->value('Prof')->text('Prof')->selected($pending_user_details->salutation == 'Prof'),
                                                $ui->option()->value('Mr')->text('Mr')->selected($pending_user_details->salutation == 'Mr'),
                                                $ui->option()->value('Mrs')->text('Mrs')->selected($pending_user_details->salutation == 'Mrs'),
                                                $ui->option()->value('Ms')->text('Ms')->selected($pending_user_details->salutation == 'Ms')))
                                ->show();
                    $ui->input()->width(3)->name('firstname')
                                ->required()
                                ->help(($pending_user_details->first_name == $user_details->first_name)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$user_details->first_name)
                                ->uiType(($pending_user_details->first_name == $user_details->first_name)?  '':$type)
                                ->placeholder("First Name")
                                ->value($pending_user_details->first_name)
                                ->label('First Name<span style= "color:red;"> *</span>')
                                ->show();
                    $ui->input()->width(3)->name('middlename')
                                ->label('Middle Name')
                                ->help(($pending_user_details->middle_name == $user_details->middle_name)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$user_details->middle_name)
                                ->uiType(($pending_user_details->middle_name == $user_details->middle_name)?  '':$type)
                                ->value($pending_user_details->middle_name)
                                ->placeholder("Middle Name")
                                ->show();
                    $ui->input()->width(3)->name('lastname')
                                ->value($pending_user_details->last_name)
                                ->help(($pending_user_details->last_name == $user_details->last_name)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$user_details->last_name)
                                ->uiType(($pending_user_details->last_name == $user_details->last_name)?  '':$type)
                                ->placeholder("Last Name")
                                ->label('Last Name')
                                ->show();
            $row3->close();

            $row4 = $ui->row()->open();
                $ui->select()->width(3)->name('mstatus')
                                ->label('Marital Status<span style= "color:red;"> *</span>')
                                ->help(($pending_user_details->marital_status == $user_details->marital_status)? '':'Above detail is '.$status.'.<br>Previously accepted : '.ucwords($user_details->marital_status))
                                ->uiType(($pending_user_details->marital_status == $user_details->marital_status)?  '':$type)
                                ->options(array($ui->option()->value('married')->text('Married')->selected($pending_user_details->marital_status == 'married'),
                                                $ui->option()->value('unmarried')->text('Unmarried')->selected($pending_user_details->marital_status == 'unmarried'),
                                                $ui->option()->value('widow')->text('Widow')->selected($pending_user_details->marital_status == 'widow'),
                                                $ui->option()->value('widower')->text('Widower')->selected($pending_user_details->marital_status == 'widower'),
                                                $ui->option()->value('separated')->text('Separated')->selected($pending_user_details->marital_status == 'separated'),
                                                $ui->option()->value('divorced')->text('Divorced')->selected($pending_user_details->marital_status == 'divorced')))
                                ->show();

                $ui->datePicker()
                    ->label('DOB<span style= "color:red;"> *</span>')
                    ->id('dob')
                    ->name('dob')
                    ->required()
                    ->help(($pending_user_details->dob == $user_details->dob)? '':'Above detail is '.$status.'.<br>Previously accepted : '.date("d-m-Y",strtotime($user_details->dob)))
                    ->uiType(($pending_user_details->dob == $user_details->dob)?  '':$type)
                    ->dateFormat('dd-mm-yyyy')
                    ->width(3)
                    ->addonRight($ui->icon("calendar"))
                    ->value(date("d-m-Y",strtotime($pending_user_details->dob)))
                    ->extras('max="'.date("d-m-Y").'"')
                    ->show();

                $ui->input()->width(3)->name('pob')
                                ->required()
                                ->help(($pending_user_other_details->birth_place == $user_other_details->birth_place)? '':'Above detail is '.$status.'.<br>Previously accepted : '.ucwords($user_other_details->birth_place))
                                ->uiType(($pending_user_other_details->birth_place == $user_other_details->birth_place)?  '':$type)
                                ->value($pending_user_other_details->birth_place)
                                ->label('Place of Birth<span style= "color:red;"> *</span>')
                                ->show();
            $row4->close();



            $row2 = $ui->row()->open();
                $col1 = $ui->col()->width(3)->open();

                    if($pending_user_details->sex != $user_details->sex) {
                        echo '<div class = "form-group has-'.$type.'"><label>';
                        if($type == 'warning')  echo '<i class = "fa fa-warning"></i>';
                        else if($type == 'error') echo '<i class = "fa fa-times-circle-o"></i>';
                        echo 'Gender<span style= "color:red;"> *</span></label></div>';
                    }
                    else
                        echo '<label>Gender<span style= "color:red;"> *</span></label>';

                    $ui->radio()->name('sex')->value('m')->label('Male')->checked($pending_user_details->sex == 'm')->show();
                    $ui->radio()->name('sex')->value('f')->label('Female')->checked($pending_user_details->sex == 'f')->show();
                    $ui->radio()->name('sex')->value('o')->label('Others')->checked($pending_user_details->sex == 'o')->show();

                    if($pending_user_details->sex != $user_details->sex) {
                        $sex_val = ($user_details->sex=='m')? 'Male':(($user_details->sex=='f')? 'Female':'Others');
                        echo '<div class="form-group has-'.$type.'"><p class="help-block">Above detail is '.$status.'.<br>Previously accepted : '.$sex_val.'</p></div>';
                    }
                $col1->close();

                $col2 = $ui->col()->width(3)->open();

                    if($pending_user_details->physically_challenged != $user_details->physically_challenged) {
                        echo '<div class = "form-group has-'.$type.'"><label>';
                        if($type == 'warning')  echo '<i class = "fa fa-warning"></i>';
                        else if($type == 'error') echo '<i class = "fa fa-times-circle-o"></i>';
                        echo 'Physically Challenged<span style= "color:red;"> *</span></label></div>';
                    }
                    else
                        echo '<label>Physically Challenged<span style= "color:red;"> *</span></label>';

                    $ui->radio()->name('pd')->value('yes')->label('Yes')->checked($pending_user_details->physically_challenged=="yes")->show();
                    $ui->radio()->name('pd')->value('no')->label('No')->checked($pending_user_details->physically_challenged=="no")->show();

                    if($pending_user_details->physically_challenged != $user_details->physically_challenged)
                        echo '<div class="form-group has-'.$type.'"><p class="help-block">Above detail is '.$status.'.<br>Previously accepted : '.ucwords($user_details->physically_challenged).'</p></div>';
                $col2->close();

                $col3 = $ui->col()->width(3)->open();

                    if($pending_user_other_details->kashmiri_immigrant != $user_other_details->kashmiri_immigrant) {
                        echo '<div class = "form-group has-'.$type.'"><label>';
                        if($type == 'warning')  echo '<i class = "fa fa-warning"></i>';
                        else if($type == 'error') echo '<i class = "fa fa-times-circle-o"></i>';
                        echo 'Kashmiri Immigrant<span style= "color:red;"> *</span></label></div>';
                    }
                    else
                        echo '<label>Kashmiri Immigrant<span style= "color:red;"> *</span></label>';

                    $ui->radio()->name('kashmiri')->value('yes')->label('Yes')->checked($pending_user_other_details->kashmiri_immigrant=='yes')->show();
                    $ui->radio()->name('kashmiri')->value('no')->label('No')->checked($pending_user_other_details->kashmiri_immigrant=='no')->show();

                    if($pending_user_other_details->kashmiri_immigrant != $user_other_details->kashmiri_immigrant)
                        echo '<div class="form-group has-'.$type.'"><p class="help-block">Above detail is '.$status.'.<br>Previously accepted : '.ucwords($user_other_details->kashmiri_immigrant).'</p></div>';
                $col3->close();
            $row2->close();





            $row5 = $ui->row()->open();
                $ui->input()->width(3)->name('father')
                                ->required()
                                ->help(($pending_user_other_details->father_name == $user_other_details->father_name)? '':'Above detail is '.$status.'.<br>Previously accepted : '.ucwords($user_other_details->father_name))
                                ->uiType(($pending_user_other_details->father_name == $user_other_details->father_name)?  '':$type)
                                ->label('Father\'s Name<span style= "color:red;"> *</span>')
                                ->value($pending_user_other_details->father_name)
                                ->show();
                $ui->input()->width(3)->name('mother')
                                ->required()
                                ->help(($pending_user_other_details->mother_name == $user_other_details->mother_name)? '':'Above detail is '.$status.'.<br>Previously accepted : '.ucwords($user_other_details->mother_name))
                                ->uiType(($pending_user_other_details->mother_name == $user_other_details->mother_name)?  '':$type)
                                ->label('Mother\'s Name<span style= "color:red;"> *</span>')
                                ->value($pending_user_other_details->mother_name)
                                ->show();
            $row5->close();

            $row6 = $ui->row()->open();
                $ui->select()->width(3)->name('category')
                                ->label('Category<span style= "color:red;"> *</span>')
                                ->help(($pending_user_details->category == $user_details->category)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$user_details->category)
                                ->uiType(($pending_user_details->category == $user_details->category)?  '':$type)
                                ->options(array($ui->option()->value('General')->text('General')->selected($pending_user_details->category=="General"),
                                                $ui->option()->value('OBC')->text('OBC')->selected($pending_user_details->category=="OBC"),
                                                $ui->option()->value('SC')->text('SC')->selected($pending_user_details->category=="SC"),
                                                $ui->option()->value('ST')->text('ST')->selected($pending_user_details->category=="ST"),
                                                $ui->option()->value('Others')->text('Others')->selected($pending_user_details->category=="Others")))
                                ->show();
                $ui->input()->width(3)->name('nationality')
                                ->required()
                                ->help(($pending_user_other_details->nationality == $user_other_details->nationality)? '':'Above detail is '.$status.'.<br>Previously accepted : '.ucwords($user_other_details->nationality))
                                ->uiType(($pending_user_other_details->nationality == $user_other_details->nationality)?  '':$type)
                                ->value($pending_user_other_details->nationality)
                                ->label('Nationality<span style= "color:red;"> *</span>')
                                ->show();
                $ui->input()->width(3)->name('religion')
                                ->required()
                                ->help(($pending_user_other_details->religion == $user_other_details->religion)? '':'Above detail is '.$status.'.<br>Previously accepted : '.ucwords($user_other_details->religion))
                                ->uiType(($pending_user_other_details->religion == $user_other_details->religion)?  '':$type)
                                ->value($pending_user_other_details->religion)
                                ->label('Religion<span style= "color:red;"> *</span>')
                                ->show();
            $row6->close();
        $basic_box->close();

    $col->close();
    $col = $ui->col()->width(4)->open();
        $emp_box = $ui->box()->uiType('primary')->solid()->title('Employment Details')->open();

            if($emp->auth_id == 'ft') $emp_type = 'Faculty';
            else if($emp->auth_id == 'nfta') $emp_type = 'Non Faculty (Academic)';
            else $emp_type = 'Non Faculty (Non Academic)';

            $ui->select()->name('tstatus')
                            ->id('tstatus')
                            ->label('Employee Type<span style= "color:red;"> *</span>')
                            ->help(($pending_emp->auth_id == $emp->auth_id)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$emp_type)
                            ->uiType(($pending_emp->auth_id == $emp->auth_id)?  '':$type)
                            ->options(array($ui->option()->value('ft')->text('Faculty')->selected($pending_emp->auth_id=='ft'),
                                            $ui->option()->value('nfta')->text('Non Faculty (Academic)')->selected($pending_emp->auth_id=='nfta'),
                                            $ui->option()->value('nftn')->text('Non Faculty (Non Academic)')->selected($pending_emp->auth_id=='nftn')))
                            ->show();

            $ui->datePicker()
                ->label('Date of Joining<span style= "color:red;"> *</span>')
                ->name('entrance_age')
                ->required()
                ->dateFormat('dd-mm-yyyy')
                ->addonRight($ui->icon("calendar"))
                ->help(($pending_emp->joining_date == $emp->joining_date)? '':'Above detail is '.$status.'.<br>Previously accepted : '.date("d-m-Y",strtotime($emp->joining_date)))
                ->uiType(($pending_emp->joining_date == $emp->joining_date)?  '':$type)
                ->value(date("d-m-Y",strtotime($pending_emp->joining_date)))
                ->show();

            $ui->select()->name('designation')
                        ->label('Designation<span style= "color:red;"> *</span>')
                        ->help(($pending_emp->designation == $emp->designation)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$emp_designation)
                        ->uiType(($pending_emp->designation == $emp->designation)?  '':$type)
                        ->options($des_options)
                        ->id('des')
                        ->show();

            $ui->select()
                ->name('department')
                ->label('Department/Section<span style= "color:red;"> *</span>')
                ->help(($pending_user_details->dept_id == $user_details->dept_id)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$emp_department)
                ->uiType(($pending_user_details->dept_id == $user_details->dept_id)?  '':$type)
                ->options($dept_options)
                ->id('depts')
                ->show();

            $research = $ui->input()->name('research_int')
                            ->id('res_int_id')
                            ->label('Research Interest');
            if($pending_emp->auth_id == 'ft')
                $research->help(($emp->auth_id == 'ft' && $pending_ft->research_interest == $ft->research_interest)? '':'Above detail is '.$status.'.<br>Previously accepted : '.((isset($ft->research_interest)? $ft->research_interest:'')))
                            ->uiType(($emp->auth_id == 'ft' && $pending_ft->research_interest == $ft->research_interest)?  '':$type)
                            ->value($pending_ft->research_interest);
            else    $research->disabled();
            $research->show();

            $ui->select()->name('empnature')
                            ->label('Nature of Employment<span style= "color:red;"> *</span>')
                            ->help(($pending_emp->employment_nature == $emp->employment_nature)? '':'Above detail is '.$status.'.<br>Previously accepted : '.ucwords($emp->employment_nature))
                            ->uiType(($pending_emp->employment_nature == $emp->employment_nature)?  '':$type)
                            ->options(array($ui->option()->value('permanent')->text('Permanent')->selected($pending_emp->employment_nature=='permanent'),
                                            $ui->option()->value('temporary')->text('Temporary')->selected($pending_emp->employment_nature=='temporary'),
                                            $ui->option()->value('probation')->text('Probation')->selected($pending_emp->employment_nature=='probation'),
                                            $ui->option()->value('contract')->text('Contract')->selected($pending_emp->employment_nature=='contract'),
                                            $ui->option()->value('others')->text('Others')->selected($pending_emp->employment_nature=='others')))
                            ->show();

            $dt = DateTime::createFromFormat("Y-m-d", $pending_emp->retirement_date);
            $emp_dt = DateTime::createFromFormat("Y-m-d", $emp->retirement_date);
            $ui->datePicker()
                ->label('Date of Retirement<span style= "color:red;"> *</span>')
                ->id('retire')
                ->name('retire')
                ->help(($pending_emp->retirement_date == $emp->retirement_date)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$emp_dt->format('d-m-Y'))
                ->uiType(($pending_emp->retirement_date == $emp->retirement_date)?  '':$type)
                ->value($dt->format('d-m-Y'))
                ->required()
                ->dateFormat('dd-mm-yyyy')
                ->addonRight($ui->icon("calendar"))
                ->show();

        $emp_box->close();

        $pay_box = $ui->box()->uiType('primary')->solid()->title('Salary Details')->open();

            $ui->select()->name('payscale')->id('payscale')->label('Pay Band<span style= "color:red;"> *</span>')
                        ->help(($pending_emp_pay_details->pay_band == $emp_pay_details->pay_band)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$emp_payband)
                        ->uiType(($pending_emp_pay_details->pay_band == $emp_pay_details->pay_band)?  '':$type)
                        ->options($pay_options)->required()->show();

            $ui->select()->name("gradepay")->id("gradepay")->label('Grade Pay<span style= "color:red;"> *</span>')
                            ->addonLeft($ui->icon('rupee'))
                            ->addonRight('.00')
                            ->help(($pending_emp_pay_details->grade_pay == $emp_pay_details->grade_pay)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$emp_gradepay)
                            ->uiType(($pending_emp_pay_details->grade_pay == $emp_pay_details->grade_pay)?  '':$type)
                            ->options($grade_options)
                            ->required()->show();

            $ui->input()->name("basicpay")
                        ->id("basicpay")
                        ->label('Basic Pay<span style= "color:red;"> *</span>')
                        ->help(($pending_emp_pay_details->basic_pay == $emp_pay_details->basic_pay)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$emp_pay_details->basic_pay)
                        ->uiType(($pending_emp_pay_details->basic_pay == $emp_pay_details->basic_pay)?  '':$type)
                        ->value($pending_emp_pay_details->basic_pay)
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
                                ->help(($pending_present_address->line1 == $present_address->line1)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$present_address->line1)
                                ->uiType(($pending_present_address->line1 == $present_address->line1)?  '':$type)
                                ->label('Address Line 1<span style= "color:red;"> *</span>')
                                ->value($pending_present_address->line1)
                                ->show();
                $ui->input()->name('line21')
                                ->label('Address Line 2')
                                ->help(($pending_present_address->line2 == $present_address->line2)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$present_address->line2)
                                ->uiType(($pending_present_address->line2 == $present_address->line2)?  '':$type)
                                ->value($pending_present_address->line2)
                                ->show();
                $ui->input()->name('city1')
                                ->label('City<span style= "color:red;"> *</span>')
                                ->help(($pending_present_address->city == $present_address->city)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$present_address->city)
                                ->uiType(($pending_present_address->city == $present_address->city)?  '':$type)
                                ->value($pending_present_address->city)
                                ->required()
                                ->show();
                $ui->select()->name('state1')
                                ->label('State<span style= "color:red;"> *</span>')
                                ->help(($pending_present_address->state == $present_address->state)? '':'Above detail is '.$status.'.<br>Previously accepted : '.ucwords($present_address->state))
                                ->uiType(($pending_present_address->state == $present_address->state)?  '':$type)
                                ->options($present_state_options)
                                ->required()
                                ->show();
                $ui->input()->name('pincode1')
                                ->label('Pin Code<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->help(($pending_present_address->pincode == $present_address->pincode)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$present_address->pincode)
                                ->uiType(($pending_present_address->pincode == $present_address->pincode)?  '':$type)
                                ->value($pending_present_address->pincode)
                                ->required()
                                ->show();
                $ui->input()->name('country1')
                                ->label('Country<span style= "color:red;"> *</span>')
                                ->help(($pending_present_address->country == $present_address->country)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$present_address->country)
                                ->uiType(($pending_present_address->country == $present_address->country)?  '':$type)
                                ->value($pending_present_address->country)
                                ->required()
                                ->show();
                $ui->input()->name('contact11')
                                ->label('Contact No<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->help(($pending_present_address->contact_no == $present_address->contact_no)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$present_address->contact_no)
                                ->uiType(($pending_present_address->contact_no == $present_address->contact_no)?  '':$type)
                                ->value($pending_present_address->contact_no)
                                ->required()
                                ->show();
            $col1->close();

            $col2 = $ui->col()->width(6)->t_width(6)->open();
            echo '<h3 class="page-header">Permanent Address</h3>';
                $ui->textarea()->name('line12')
                                ->required()
                                ->label('Address Line 1<span style= "color:red;"> *</span>')
                                ->help(($pending_permanent_address->line1 == $permanent_address->line1)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$permanent_address->line1)
                                ->uiType(($pending_permanent_address->line1 == $permanent_address->line1)?  '':$type)
                                ->value($pending_permanent_address->line1)
                                ->show();
                $ui->input()->name('line22')
                                ->help(($pending_permanent_address->line2 == $permanent_address->line2)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$permanent_address->line2)
                                ->uiType(($pending_permanent_address->line2 == $permanent_address->line2)?  '':$type)
                                ->value($pending_permanent_address->line2)
                                ->label('Address Line 2')
                                ->show();
                $ui->input()->name('city2')
                                ->label('City<span style= "color:red;"> *</span>')
                                ->required()
                                ->help(($pending_permanent_address->city == $permanent_address->city)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$permanent_address->city)
                                ->uiType(($pending_permanent_address->city == $permanent_address->city)?  '':$type)
                                ->value($pending_permanent_address->city)
                                ->show();
                $ui->select()->name('state2')
                                ->label('State<span style= "color:red;"> *</span>')
                                ->required()
                                ->help(($pending_permanent_address->state == $permanent_address->state)? '':'Above detail is '.$status.'.<br>Previously accepted : '.ucwords($permanent_address->state))
                                ->uiType(($pending_permanent_address->state == $permanent_address->state)?  '':$type)
                                ->options($permanent_state_options)
                                ->show();
                $ui->input()->name('pincode2')
                                ->label('Pin Code<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->required()
                                ->help(($pending_permanent_address->pincode == $permanent_address->pincode)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$permanent_address->pincode)
                                ->uiType(($pending_permanent_address->pincode == $permanent_address->pincode)?  '':$type)
                                ->value($pending_permanent_address->pincode)
                                ->show();
                $ui->input()->name('country2')
                                ->label('Country<span style= "color:red;"> *</span>')
                                ->required()
                                ->help(($pending_permanent_address->country == $permanent_address->country)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$permanent_address->country)
                                ->uiType(($pending_permanent_address->country == $permanent_address->country)?  '':$type)
                                ->value($pending_permanent_address->country)
                                ->show();
                $ui->input()->name('contact12')
                                ->label('Contact No<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->required()
                                ->help(($pending_permanent_address->contact_no == $permanent_address->contact_no)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$permanent_address->contact_no)
                                ->uiType(($pending_permanent_address->contact_no == $permanent_address->contact_no)?  '':$type)
                                ->value($pending_permanent_address->contact_no)
                                ->show();
            $col2->close();
            $row1->close();
        $addr_box->close();

        $other_box = $ui->box()->uiType('primary')->open();
            $row1 = $ui->row()->open();
                $ui->input()->name('hobbies')->width(4)->t_width(6)->label('Hobbies')
                                ->help(($pending_user_other_details->hobbies == $user_other_details->hobbies)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$user_other_details->hobbies)
                                ->uiType(($pending_user_other_details->hobbies == $user_other_details->hobbies)?  '':$type)
                                ->value($pending_user_other_details->hobbies)->show();

                $ui->input()->name('favpast')->width(4)->t_width(6)->label('Favourite Past Time')
                                ->help(($pending_user_other_details->fav_past_time == $user_other_details->fav_past_time)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$user_other_details->fav_past_time)
                                ->uiType(($pending_user_other_details->fav_past_time == $user_other_details->fav_past_time)?  '':$type)
                                ->value($pending_user_other_details->fav_past_time)->show();

                $ui->input()->name('fax')->width(4)->t_width(6)->label('Fax')->type('tel')
                                ->help(($pending_emp->fax == $emp->fax)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$emp->fax)
                                ->uiType(($pending_emp->fax == $emp->fax)?  '':$type)
                                ->value($pending_emp->fax)->show();

                $ui->input()->name('office')->width(4)->t_width(6)->label('Office No')->type('tel')
                                ->help(($pending_emp->office_no == $emp->office_no)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$emp->office_no)
                                ->uiType(($pending_emp->office_no == $emp->office_no)?  '':$type)
                                ->value($pending_emp->office_no)->show();

                $ui->input()->name('email')->width(4)->t_width(6)->label('Email')->type('email')->addonLeft($ui->icon('envelope'))
                                ->help(($pending_user_details->email == $user_details->email)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$user_details->email)
                                ->uiType(($pending_user_details->email == $user_details->email)?  '':$type)
                                ->value($pending_user_details->email)->show();

                $ui->input()->name('mobile')->width(4)->t_width(6)->addonLeft('+91')->label('Mobile No')->type('tel')
                                ->help(($pending_user_other_details->mobile_no == $user_other_details->mobile_no)? '':'Above detail is '.$status.'.<br>Previously accepted : '.$user_other_details->mobile_no)
                                ->uiType(($pending_user_other_details->mobile_no == $user_other_details->mobile_no)?  '':$type)
                                ->value($pending_user_other_details->mobile_no)->show();
            $row1->close();
        $other_box->close();
    $col->close();
    echo '</div>';
    $ui->button()->id('back_btn')->value("Back")->large()->uiType('primary')->icon($ui->icon("arrow-left"))->show();
    $ui->button()->submit()->classes("pull-right")->value('Save')->name('submit')->large()->uiType('primary')->icon($ui->icon("floppy-o"))->show();
    echo "<br />";
$row->close();
$form->close();
?>