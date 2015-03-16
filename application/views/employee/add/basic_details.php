<?php $ui = new UI();

                                    //pay_options
                                    $pay_options = array($ui->option()->value("")->text("Choose One")->disabled()->selected());
                                    if($pay_bands === FALSE)
                                        array_push($pay_options,$ui->option()->value("")->text("No pay band found")->disabled());
                                    else
                                        foreach($pay_bands as $row)
                                            array_push($pay_options,$ui->option()->value($row->pay_band)->text(strtoupper($row->pay_band).' ('.$row->pay_band_description.')'));

                                    //states options
                                    $state_options = array($ui->option()->value("")->text("Choose One")->disabled()->selected());
                                    foreach($states as $row)
                                        array_push($state_options,$ui->option()->value($row->state_name)->text(ucwords($row->state_name)));

if($error!="")
    $ui->alert()->uiType('danger')->title('ERROR')->desc($error)->show();

$form = $ui->form()->id('basic_details')->multipart()->action('employee/add/insert_basic_details')->open();
    echo '<h2 class="page-header" id="emp_id_display"></h2>';
    $row = $ui->row()->open();
        $col = $ui->col()->id('hide_emp')->width(4)->open();
            $emp_sel_box = $ui->box()->uiType('primary')->title('Select Employee ID')->open();
                            $ui->input()->name('emp_id')->id('emp_id')
                                        ->required()
                                        ->addonRight($ui->button()->value('Go')->id('fetch_id_btn')->uiType('primary'))
                                        ->label('Employee Id<span style= "color:red;"> *</span>')
                                        ->show();
            $emp_sel_box->close();
        $col->close();
        echo '<div class="hideit">';
        $col = $ui->col()->width(12)->open();

            echo '<i class="loading" id="empIdIcon" ></i>';
            $basic_box = $ui->box()->uiType('primary')->solid()->title('Personal Details')->open();
            echo 'Fields marked with <span style= "color:red;">*</span> are mandatory.<br><br> ';

                $row3 = $ui->row()->open();
                        $ui->select()->width(2)->name('salutation')
                                    ->label('Salutation<span style= "color:red;"> *</span>')
                                    ->options(array($ui->option()->value('Dr')->text('Dr'),
                                                    $ui->option()->value('Prof')->text('Prof'),
                                                    $ui->option()->value('Mr')->text('Mr'),
                                                    $ui->option()->value('Mrs')->text('Mrs'),
                                                    $ui->option()->value('Ms')->text('Ms')))
                                    ->show();
                        $ui->input()->width(3)->name('firstname')
                                    ->required()
                                    ->placeholder("First Name")
                                    ->label('First Name<span style= "color:red;"> *</span>')
                                    ->show();
                        $ui->input()->width(3)->name('middlename')
                                        ->label('Middle Name')
                                        ->placeholder("Middle Name")
                                        ->show();
                        $ui->input()->width(3)->name('lastname')
                                    ->placeholder("Last Name")
                                    ->label('Last Name')
                                    ->show();
                $row3->close();

                $row4 = $ui->row()->open();
                    $ui->select()->width(3)->name('mstatus')
                                    ->label('Marital Status<span style= "color:red;"> *</span>')
                                    ->options(array($ui->option()->value('married')->text('Married'),
                                                    $ui->option()->value('unmarried')->text('Unmarried'),
                                                    $ui->option()->value('widow')->text('Widow'),
                                                    $ui->option()->value('widower')->text('Widower'),
                                                    $ui->option()->value('separated')->text('Separated'),
                                                    $ui->option()->value('divorced')->text('Divorced')))
                                    ->show();

                    $ui->datePicker()
                        ->label('DOB<span style= "color:red;"> *</span>')
                        ->id('dob')
                        ->name('dob')
                        ->required()
                        ->dateFormat('dd-mm-yyyy')
                        ->width(3)
                        ->addonRight($ui->icon("calendar"))
                        ->value(date("d-m-Y"))
                        ->extras('max="'.date("d-m-Y").'"') //max not working
                        ->show();

                    $ui->input()->width(3)->name('pob')
                                    ->required()
                                    ->label('Place of Birth<span style= "color:red;"> *</span>')
                                    ->show();
                $row4->close();



                $row2 = $ui->row()->open();
                    $col1 = $ui->col()->width(3)->open();
                        echo '<label>Gender<span style= "color:red;"> *</span></label>';
                        $ui->radio()->name('sex')->value('m')->label('Male')->checked()->show();
                        $ui->radio()->name('sex')->value('f')->label('Female')->show();
                        $ui->radio()->name('sex')->value('o')->label('Others')->show();
                    $col1->close();

                    $col2 = $ui->col()->width(3)->open();
                        echo '<label>Physically Challenged<span style= "color:red;"> *</span></label>';
                        $ui->radio()->name('pd')->value('yes')->label('Yes')->show();
                        $ui->radio()->name('pd')->value('no')->label('No')->checked()->show();
                    $col2->close();

                    $col3 = $ui->col()->width(3)->open();
                        echo '<label>Kashmiri Immigrant<span style= "color:red;"> *</span></label>';
                        $ui->radio()->name('kashmiri')->value('yes')->label('Yes')->show();
                        $ui->radio()->name('kashmiri')->value('no')->label('No')->checked()->show();
                    $col3->close();
                $row2->close();





                $row5 = $ui->row()->open();
                    $ui->input()->width(3)->name('father')
                                    ->required()
                                    ->label('Father\'s Name<span style= "color:red;"> *</span>')
                                    ->show();
                    $ui->input()->width(3)->name('mother')
                                    ->required()
                                    ->label('Mother\'s Name<span style= "color:red;"> *</span>')
                                    ->show();
                $row5->close();

                $row6 = $ui->row()->open();
                    $ui->select()->width(3)->name('category')
                                    ->label('Category<span style= "color:red;"> *</span>')
                                    ->options(array($ui->option()->value('General')->text('GEN')->selected(),
                                                    $ui->option()->value('OBC')->text('OBC'),
                                                    $ui->option()->value('SC')->text('SC'),
                                                    $ui->option()->value('ST')->text('ST'),
                                                    $ui->option()->value('Others')->text('Others')))
                                    ->show();
                    $ui->input()->width(3)->name('nationality')
                                    ->required()
                                    ->value('Indian')
                                    ->label('Nationality<span style= "color:red;"> *</span>')
                                    ->show();
                    $ui->input()->width(3)->name('religion')
                                    ->required()
                                    ->label('Religion<span style= "color:red;"> *</span>')
                                    ->show();
                    $ui->imagePicker()->width(12)->label("Photograph<span style= \"color:red;\"> *</span>")->required()->id('photo')->name('photo')->show();
                $row6->close();





            $basic_box->close();

        $col->close();
        $col = $ui->col()->width(4)->open();
            $emp_box = $ui->box()->uiType('primary')->solid()->title('Employment Details')->open();
                $ui->select()->name('tstatus')
                                ->id('tstatus')
                                ->label('Employee Type<span style= "color:red;"> *</span>')
                                ->options(array($ui->option()->value('ft')->text('Faculty')->selected(),
                                                $ui->option()->value('nfta')->text('Non Faculty (Academic)'),
                                                $ui->option()->value('nftn')->text('Non Faculty (Non Academic)')))
                                ->show();

                $ui->datePicker()
                    ->label('Date of Joining<span style= "color:red;"> *</span>')
                    ->name('entrance_age')
                    ->required()
                    ->dateFormat('dd-mm-yyyy')
                    ->addonRight($ui->icon("calendar"))
                    ->value(date("d-m-Y"))
                    ->show();

                $ui->select()->name('designation')
                            ->label('Designation<span style= "color:red;"> *</span>')
                            ->id('des')
                            ->show();

                $ui->select()->name('department')
                            ->label('Department/Section<span style= "color:red;"> *</span>')
                            ->id('depts')
                            ->show();

                $ui->input()->name('research_int')
                                ->id('res_int_id')
                                ->label('Research Interest')
                                ->show();

                $ui->select()->name('empnature')
                                ->label('Nature of Employment<span style= "color:red;"> *</span>')
                                ->options(array($ui->option()->value('permanent')->text('Permanent'),
                                                $ui->option()->value('temporary')->text('Temporary'),
                                                $ui->option()->value('probation')->text('Probation'),
                                                $ui->option()->value('contract')->text('Contract'),
                                                $ui->option()->value('others')->text('Others')))
                                ->show();

                $ui->datePicker()
                    ->label('Date of Retirement<span style= "color:red;"> *</span>')
                    ->id('retire')
                    ->name('retire')
                    ->required()
                    ->dateFormat('dd-mm-yyyy')
                    ->addonRight($ui->icon("calendar"))
                    ->show();
            $emp_box->close();

            $pay_box = $ui->box()->uiType('primary')->solid()->title('Salary Details')->open();

                $ui->select()->name('payscale')->id('payscale')->label('Pay Band<span style= "color:red;"> *</span>')
                            ->options($pay_options)->required()->show();

                $ui->select()->name("gradepay")->id("gradepay")->label('Grade Pay<span style= "color:red;"> *</span>')
                                ->addonLeft($ui->icon('rupee'))
                                ->addonRight('.00')
                                ->options(array($ui->option()->value("")->text("Choose One")->disabled()->selected()))
                                ->disabled()->required()->show();

                $ui->input()->name("basicpay")
                            ->id("basicpay")
                            ->label('Basic Pay<span style= "color:red;"> *</span>')
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
                                    ->show();
                    $ui->input()->name('line21')
                                    ->label('Address Line 2')
                                    ->show();
                    $ui->input()->name('city1')
                                    ->label('City<span style= "color:red;"> *</span>')
                                    ->required()
                                    ->show();
                    $ui->select()->name('state1')
                                    ->label('State<span style= "color:red;"> *</span>')
                                    ->options($state_options)
                                    ->required()
                                    ->show();
                    $ui->input()->name('pincode1')
                                    ->label('Pin Code<span style= "color:red;"> *</span>')
                                    ->type('tel')
                                    ->required()
                                    ->show();
                    $ui->input()->name('country1')
                                    ->label('Country<span style= "color:red;"> *</span>')
                                    ->value('India')
                                    ->required()
                                    ->show();
                    $ui->input()->name('contact11')
                                    ->label('Contact No<span style= "color:red;"> *</span>')
                                    ->type('tel')
                                    ->required()
                                    ->show();
                $col1->close();

                $col2 = $ui->col()->width(6)->t_width(6)->open();
                echo '<h3 class="page-header">Permanent Address</h3>';
                    $ui->textarea()->name('line12')
                                    ->required()
                                    ->label('Address Line 1<span style= "color:red;"> *</span>')
                                    ->show();
                    $ui->input()->name('line22')
                                    ->label('Address Line 2')
                                    ->show();
                    $ui->input()->name('city2')
                                    ->label('City<span style= "color:red;"> *</span>')
                                    ->required()
                                    ->show();
                    $ui->select()->name('state2')
                                    ->label('State<span style= "color:red;"> *</span>')
                                    ->options($state_options)
                                    ->required()
                                    ->show();
                    $ui->input()->name('pincode2')
                                    ->label('Pin Code<span style= "color:red;"> *</span>')
                                    ->type('tel')
                                    ->required()
                                    ->show();
                    $ui->input()->name('country2')
                                    ->label('Country<span style= "color:red;"> *</span>')
                                    ->value('India')
                                    ->required()
                                    ->show();
                    $ui->input()->name('contact12')
                                    ->label('Contact No<span style= "color:red;"> *</span>')
                                    ->type('tel')
                                    ->required()
                                    ->show();
                $col2->close();
                $row1->close();
            $addr_box->close();

            $other_box = $ui->box()->uiType('primary')->open();
                $row1 = $ui->row()->open();
                    $ui->input()->name('hobbies')->width(4)->t_width(6)->label('Hobbies')->show();
                    $ui->input()->name('favpast')->width(4)->t_width(6)->label('Favourite Past Time')->show();
                    $ui->input()->name('fax')->width(4)->t_width(6)->label('Fax')->type('tel')->show();
                    $ui->input()->name('office')->width(4)->t_width(6)->label('Office No')->type('tel')->show();
                    $ui->input()->name('email')->width(4)->t_width(6)->label('Email')->type('email')->addonLeft($ui->icon('envelope'))->show();
                    $ui->input()->name('mobile')->width(4)->t_width(6)->addonLeft('+91')->label('Mobile No')->type('tel')->show();
                $row1->close();
            $other_box->close();
        $col->close();
        echo '</div>';
    $row->close();
    echo '<hr class="hideit" />';

    $nextRow = $ui->row()->classes("hideit")->open();
        $ui->button()->submit()->classes("pull-right")->value('Next')->name('submit')->large()->uiType('primary')->icon($ui->icon("arrow-right"))->show();
        echo "<br />";
    $nextRow->close();
$form->close();
?>
<style type="text/css">
.hideit {
    display: none;
}
</style>