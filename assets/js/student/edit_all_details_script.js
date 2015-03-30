        $(document).ready(function() {
                if(document.getElementById('student_type').value == 'ug')
                        document.getElementById('add').style.display='none';
                else if(document.getElementById("tableid").rows.length > 6)
                        document.getElementById('add').style.display='none';

                document.getElementById("add").onclick = function() {onclick_add();};

                if($('#stu_type').val() == 'jrf')
                {
                        document.getElementById('course_id').innerHTML = '<select id="course_id" name="course"><option value="phd">Ph.D</option></select>';
                        document.getElementById('branch_id').innerHTML = '<select id="branch_id" name="branch"><option value="na">Not Applicable</option></select>';
                        document.getElementsByName('semester')[0].innerHTML = '<select name="semester"><option value="-1">Not Applicable</option></select>';
                }
                else if($('#stu_type').val() == 'pd')
                {
                        document.getElementById('course_id').innerHTML = '<select id="course_id" name="course"><option value="postdoc">Post Doc</option></select>';
                        document.getElementById('branch_id').innerHTML = '<select id="branch_id" name="branch"><option value="na">Not Applicable</option></select>';
                        document.getElementsByName('semester')[0].innerHTML = '<select name="semester"><option value="-1">Not Applicable</option></select>';
                }

                /*if(document.getElementById('middlename').value == 'Na')
                        document.getElementById('middlename').value = '';
                if(document.getElementById('lastname').value == 'Na')
                        document.getElementById('lastname').value = '';
                if(document.getElementById('parent_landline').value == '0')
                        document.getElementById('parent_landline').value = '';
                if(document.getElementById('aadhaar_no').value == 'na')
                        document.getElementById('aadhaar_no').value = '';
                // if(document.getElementById('extra_activity').value == 'na')
                //      document.getElementById('extra_activity').value = '';
                // if(document.getElementById('any_other_information').value == 'na')
                //      document.getElementById('any_other_information').value = '';
                if(document.getElementById('fee_paid_dd_chk_onlinetransaction_cashreceipt_no').value == 'na')
                        document.getElementById('fee_paid_dd_chk_onlinetransaction_cashreceipt_no').value = '';
                if(document.getElementById('fee_paid_amount').value == '0')
                        document.getElementById('fee_paid_amount').value = '';*/
                // if(document.getElementById('alternate_email_id').value == 'na')
                //      document.getElementById('alternate_email_id').value = '';
                // if(document.getElementById('hobbies').value == 'na')
                //      document.getElementById('hobbies').value = '';
                // if(document.getElementById('favpast').value == 'na')
                //      document.getElementById('favpast').value = '';
                // if(document.getElementById('alternate_mobile').value == '0')
                //      document.getElementById('alternate_mobile').value = '';
                if(document.getElementById('father_name').value == '' && document.getElementById('mother_name').value == '')
                {
                        document.getElementById('father_name').value = '';
                        document.getElementById('mother_name').value = '';
                        document.getElementById('father_occupation').value = '';
                        document.getElementById('mother_occupation').value = '';
                        document.getElementById('father_gross_income').value = '';
                        document.getElementById('mother_gross_income').value = '';
                        document.getElementById('depends_on').checked = true;
                        depends_on_whom();
                }
                else
                {
                        document.getElementById('guardian_name').value = '';
                        document.getElementById('guardian_relation_name').value = '';
                        depends_on_whom();
                }
                select_exam_scores();
                if(document.getElementById('roll_no').value == 'na')
                        document.getElementById('roll_no').value = '';
                corrAddr();

                $('#form_submit').on('submit', function(e) {
                        if(!form_validation())
                                e.preventDefault();
                });

                $('#stu_type').on('change', function() {
                        button_for_add();

                        /*if($('#stu_type').val() == 'jrf') {
                                $('#course_id, #branch_id').append($('<option>', {
                                value: 'na',
                                text: 'Not Applicable' ,
                                selected : 'true'
                                }));
                        }*/

                        if($('#stu_type').val() == 'jrf') {
                                document.getElementById('course_id').innerHTML = '<select id="course_id" name="course"><option value="phd">Ph.D</option></select>';
                                document.getElementById('branch_id').innerHTML = '<select id="branch_id" name="branch"><option value="na">Not Applicable</option></select>';
                        }
                        else if($('#stu_type').val() == 'pd') {
                                document.getElementById('course_id').innerHTML = '<select id="course_id" name="course"><option value="postdoc">Post Doc</option></select>';
                                document.getElementById('branch_id').innerHTML = '<select id="branch_id" name="branch"><option value="na">Not Applicable</option></select>';
                        }
                        else
                                options_of_courses();

                        if($('#stu_type').val() == 'jrf' || $('#stu_type').val() == 'pd')
                        {
                                document.getElementsByName('semester')[0].innerHTML = '<select name="semester"><option value="-1">Not Applicable</option></select>';
                        }
                        else
                        {
                                document.getElementsByName('semester')[0].innerHTML = '<select name="semester"><option value="1"  >1</option><option value="2"  >2</option><option value="3"  >3</option><option value="4"  >4</option><option value="5"  >5</option><option value="6"  >6</option><option value="7"  >7</option><option value="8"  >8</option><option value="9"  >9</option><option value="10"  >10</option></select>';
                        }
                });

                $('#depts').on('change', function() {
                        if($('#stu_type').val() != 'jrf')
                                options_of_courses();
                });

                $('#course_id').on('change', function() {
                        if($('#course_id').val() == 'na') {
                                $('#branch_id').html('<option value = "na" selected >Not Applicable</option>');
                        }
                        else
                                options_of_branches();
                });

                $('#id_admn_based_on').on('change', function() {
                        select_exam_scores();
                });

                $('#correspondence_addr').on('ifChanged', function() {
                        corrAddr();
                });

                $('[name="depends_on"]').on('ifChanged', function() {
                depends_on_whom();
                });
        });


        function form_validation()
        {
                if(!parent_guardian_validation())
                        return false;
                if(!admission_based_on_validation())
                        return false;
                if(!correspondence_addr_validation())
                        return false;
                if(!student_type_validation())
                        return false;
                if(!all_number_validation())
                        return false;
                if(!mobile_number_size_validation())
                        return false;
                if(!course_branch_validation())
                        return false;
                if(!education_validation())
                        return false;
                //push_na_in_empty();
                return true;
        }

        function correspondence_addr_validation()
        {
                var ca=document.getElementById("correspondence_addr").checked;
                if(ca)
                        return true;
                else
                {
                        var line1 = document.getElementById("line13").value;
                        var line2 = document.getElementById("line23").value;
                        var city = document.getElementById("city3").value;
                        var state = document.getElementById("state3").value;
                        var pincode = document.getElementById("pincode3").value;
                        var country = document.getElementById("country3").value;
                        var contact = document.getElementById("contact3").value;
                        if(line1.trim() == '' || line2.trim() == '' || city.trim() =='' || pincode.trim() == '' || state.trim() == '' || country.trim() == ''|| contact.trim() == '')
                        {
                                alert("Please fill all the fields of correspondence address.");
                                return false;
                        }
                        else if(isNaN(pincode))
                        {
                                alert("Pincode can contain only numbers.");
                                return false;
                        }
                        if(isNaN(contact))
                        {
                                alert("Correspondance Contact can contain only numbers.");
                                return false;
                        }
                        else if(contact >= 10000000000 || contact < 1000000000)
                        {
                                alert("Correspondence mobile number not in range.");
                                return false;
                        }
                        return true;
                }
        }

        function course_branch_validation()
        {
                var course = document.getElementById("course_id").value;
                var branch = document.getElementById("branch_id").value;
                if(branch == "none" || course == "none")
                {
                                alert("Branch or Course not selected or exists.")
                                return false;
                }
                else
                        return true;
        }

        function parent_guardian_validation()
        {
                var dpe = document.getElementById("depends_on").checked;
                /*if(dpe)
                {
                        if(m == '' && f == '' && g != '' && r != '' && fo == '' && mo == '' && fgai == '' && mgai == '')
                                return true;
                        else
                                return false;
                }
                else
                {
                        if(m != '' && f != '' && g == '' && r == '' && fo != '' && mo != '' && fgai != '' && mgai != '')
                                return true;
                        else
                                return false;
                }*/
                if(!dpe)
                {
                        var m=document.getElementById("mother_name").value;
                        var f= document.getElementById("father_name").value;
                        var fo=document.getElementById("father_occupation").value;
                        var mo=document.getElementById("mother_occupation").value;
                        var fgai=document.getElementById("father_gross_income").value;
                        var mgai=document.getElementById("mother_gross_income").value;
                        if(m.trim() == '' || f.trim() == '' || fo.trim() == '' || mo.trim() == '' || fgai.trim() == '' || mgai.trim() == '')
                        {
                                alert("Please fill all details of parents.")
                                return false;
                        }
                        else
                                return true;
                }
                else
                {
                        var g=document.getElementById("guardian_name").value;
                        var r=document.getElementById("guardian_relation_name").value;
                        if(g.trim() == '' || r.trim() == '')
                        {
                                alert("Please fill all details of guardian.")
                                return false;
                        }
                        else
                                return true;
                }
        }

        function admission_based_on_validation()
        {
                var admission_based_on = document.getElementById("id_admn_based_on").value;
                if(admission_based_on == 'iitjee')
                {
                        var iitjee_rank = document.getElementById('iitjee_rank').value;
                        var iitjee_cat_rank = document.getElementById('iitjee_cat_rank').value;
                        if((iitjee_cat_rank == 0 || iitjee_cat_rank.trim() == '') && (iitjee_rank == 0 || iitjee_rank.trim() == ''))
                        {
                                alert("Please fill the IIT-JEE rank or the category rank.")
                                return false;
                        }
                        else
                                return true;
                }
                else if(admission_based_on == 'gate')
                {
                        var gate_score = document.getElementById('gate_score').value;
                        if(gate_score.trim() == '' || gate_score == 0 || isNaN(gate_score))
                        {
                                alert("Please fill the gate score.")
                                return false;
                        }
                        else
                                return true;
                }
                else if(admission_based_on == 'cat')
                {
                        var cat_score = document.getElementById('cat_score').value;
                        if(cat_score ==0 || cat_score.trim() == '' || isNaN(cat_score))
                        {
                                alert("Please fill the cat score.")
                                return false;
                        }
                        else
                                return true;
                }
                else if(admission_based_on == 'others')
                {
                        var other_mode_of_admission = document.getElementById('other_mode_of_admission').value;
                        if(other_mode_of_admission.trim() == '')
                        {
                                alert("Please fill the other mode of admission.")
                                return false;
                        }
                        else
                                return true;
                }
                return true;
        }

        function student_type_validation()
        {
                var student_type = document.getElementById('stu_type').value;
                if(student_type == 'others')
                {
                        var student_other_type = document.getElementById('student_other_type').value;
                        if(student_other_type.trim() == '')
                        {
                                alert('Please enter the other "Student Other Type".');
                                return false;
                        }
                        else
                                return true;
                }
                return true;
        }

        function corrAddr()
        {
                var y=document.getElementById("correspondence_addr");
                if(y.checked)
                {
                        document.getElementById('corr_addr_visibility').style.display = 'none';
                }
                else
                {
                        document.getElementById('corr_addr_visibility').style.display = 'block';
                }
        }

        function corrAddr1()
        {
                var y=document.getElementById("correspondence_addr");
                if(y.checked)
                {
                        document.getElementById('corr_addr_visibility').style.display = 'none';
                }
                else
                {
                        document.getElementById('corr_addr_visibility').style.display = 'block';
                }
        }

        function depends_on_whom()
        {
                var dpe = document.getElementById("depends_on").checked;

                var m=document.getElementById("mother_name");
                var f= document.getElementById("father_name");
                var g=document.getElementById("guardian_name");
                var r=document.getElementById("guardian_relation_name");
                var fo=document.getElementById("father_occupation");
                var mo=document.getElementById("mother_occupation");
                var fgai=document.getElementById("father_gross_income");
                var mgai=document.getElementById("mother_gross_income");

                if(dpe)
                {
                        m.disabled=true;
                        f.disabled=true;
                        g.disabled=false;
                        r.disabled=false;
                        fo.disabled=true;
                        mo.disabled=true;
                        fgai.disabled=true;
                        mgai.disabled=true;
                }
                else
                {
                        m.disabled=false;
                        f.disabled=false;
                        g.disabled=true;
                        r.disabled=true;
                        fo.disabled=false;
                        mo.disabled=false;
                        fgai.disabled=false;
                        mgai.disabled=false;
                }

        }

        function depends_on_whom1()
        {
                var m=document.getElementById("mother_name");
                var f= document.getElementById("father_name");
                var g=document.getElementById("guardian_name");
                var r=document.getElementById("guardian_relation_name");
                var fo=document.getElementById("father_occupation");
                var mo=document.getElementById("mother_occupation");
                var fgai=document.getElementById("father_gross_income");
                var mgai=document.getElementById("mother_gross_income");

                        m.disabled=true;
                        f.disabled=true;
                        g.disabled=false;
                        r.disabled=false;
                        fo.disabled=true;
                        mo.disabled=true;
                        fgai.disabled=true;
                        mgai.disabled=true;

        }

        /*function depends_on_iitjee()
        {
                var dpe_iitjee = document.getElementById("depends_on_iit").checked;
                var g=document.getElementById("iitjee_rank");
                var h=document.getElementById("iitjee_cat_rank");
                if(dpe_iitjee)
                {
                        g.disabled=false;
                        h.disabled=false;

                }
                else
                {
                        g.disabled=true;
                        h.disabled=true;
                }

        }


        function depends_on_cat()
        {
                var dpe_cat = document.getElementById("depends_on_cat_score").checked;
                var g=document.getElementById("cat_score");
                if(dpe_cat)
                {
                        g.disabled=false;

                }
                else
                {
                        g.disabled=true;
                }

        }

        function depends_on_gate()
        {
                var dpe_gate = document.getElementById("depends_on_gate_score").checked;
                var g=document.getElementById("gate_score");
                if(dpe_gate)
                {
                        g.disabled=false;

                }
                else
                {
                        g.disabled=true;
                }

        }*/

        function select_exam_scores()
        {
                var admission_based_on = document.getElementById('id_admn_based_on').value;
                var iitjee_rank = document.getElementById('iitjee_rank');
                var iitjee_cat_rank = document.getElementById('iitjee_cat_rank');
                var gate_score = document.getElementById('gate_score');
                var cat_score = document.getElementById('cat_score');
                var other_mode_of_admission = document.getElementById('other_mode_of_admission');
                if(admission_based_on == 'iitjee')
                {
                        iitjee_rank.disabled = false;
                        iitjee_cat_rank.disabled = false;
                        gate_score.disabled = true;
                        cat_score.disabled = true;
                        other_mode_of_admission.disabled = true;
                }
                else if(admission_based_on == 'gate')
                {
                        iitjee_rank.disabled = true;
                        iitjee_cat_rank.disabled = true;
                        gate_score.disabled = false;
                        cat_score.disabled = true;
                        other_mode_of_admission.disabled = true;
                }
                else if(admission_based_on == 'cat')
                {
                        iitjee_rank.disabled = true;
                        iitjee_cat_rank.disabled = true;
                        gate_score.disabled = true;
                        cat_score.disabled = false;
                        other_mode_of_admission.disabled = true;
                }
                else if(admission_based_on == 'others')
                {
                        other_mode_of_admission.disabled = false;
                        iitjee_rank.disabled = true;
                        iitjee_cat_rank.disabled = true;
                        gate_score.disabled = true;
                        cat_score.disabled = true;
                }
                else
                {
                        other_mode_of_admission.disabled = true;
                        iitjee_rank.disabled = true;
                        iitjee_cat_rank.disabled = true;
                        gate_score.disabled = true;
                        cat_score.disabled = true;
                }
        }

    function options_of_branches()
    {
        var tr=document.getElementById('branch_id');
        var course=document.getElementById('course_id').value;
        var dept=document.getElementById('depts').value;
        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                tr.innerHTML=xmlhttp.responseText;
            }
        }
        //xmlhttp.open("GET","AJAX_branches_by_dept.php?dept="+dept,true); this is original line to select branch we need to select courses
                xmlhttp.open("POST",site_url("student/student_ajax/update_branch/"+course+"/"+dept),true);
        xmlhttp.send();
        tr.innerHTML="<option selected=\"selected\">Loading...</option>";
    }

    function options_of_courses()
    {
        var tr=document.getElementById('course_id');
        var dept=document.getElementById('depts').value;
        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                tr.innerHTML=xmlhttp.responseText;
                options_of_branches();
            }
        }
        xmlhttp.open("POST",site_url("student/student_ajax/update_courses/"+dept),true);
        xmlhttp.send();
        tr.innerHTML="<option selected=\"selected\">Loading...</option>";
    }

    function all_number_validation()
        {
                if(isNaN(document.getElementById('father_gross_income').value))
                {
                        alert("Father's Gross Income can only contain digits.");
                        return false;
                }
                if(isNaN(document.getElementById('mother_gross_income').value))
                {
                        alert("Mother's Gross Income can only contain digits.");
                        return false;
                }
                if(isNaN(document.getElementById('parent_mobile').value))
                {
                        alert("Parent Mobile number can contain only digits.");
                        return false;
                }
                if(isNaN(document.getElementById('parent_landline').value))
                {
                        alert("Paerent Landline number can only contain digits.");
                        return false;
                }
                if(isNaN(document.getElementById('pincode1').value))
                {
                        alert("Pincode of present address can only contain digits.");
                        return false;
                }
                if(isNaN(document.getElementById('pincode2').value))
                {
                        alert("Pincode of premanent address can only contain digits.");
                        return false;
                }
                if(isNaN(document.getElementById('contact1').value))
                {
                        alert("Contact of present address can contain only digits.");
                        return false;
                }
                if(isNaN(document.getElementById('contact2').value))
                {
                        alert("Contact of permanent address can contain only digits.");
                        return false;
                }
                if(isNaN(document.getElementById('fee_paid_amount').value))
                {
                        alert("Fee Paid Amount field can contain only digits.");
                        return false;
                }
                if(isNaN(document.getElementById('iitjee_cat_rank').value) || isNaN(document.getElementById('iitjee_rank').value))
                {
                        alert("Rank can only contain digits.")
                        return false;
                }
                return true;
        }

        function mobile_number_size_validation()
        {
                var parent_mobile_no = document.getElementById('parent_mobile').value;
                var present_contact_no = document.getElementById('contact1').value;
                var permanent_contact_no = document.getElementById('contact2').value;
                var correspondence_contact_no = document.getElementById('contact3').value;
                //var mobile_no = document.getElementById('mobile').value;
                //var alternate_mobile_no = document.getElementById('alternate_mobile').value;
                if(parent_mobile_no >= 10000000000 || parent_mobile_no < 1000000000)
                {
                        alert("Parent mobile number not in range");
                        return false;
                }
                else if(present_contact_no >= 10000000000 || present_contact_no < 1000000000)
                {
                        alert("Present address mobile number not in range");
                        return false;
                }
                else if(permanent_contact_no >= 10000000000 || permanent_contact_no < 1000000000)
                {
                        alert("Permanent address mobile number not in range");
                        return false;
                }
                // else if(mobile_no >= 10000000000 || mobile_no < 1000000000)
                // {
                //      alert("Your mobile number not in range");
                //      return false;
                // }
                // else if(alternate_mobile_no != '' && (alternate_mobile_no >= 10000000000 || alternate_mobile_no < 1000000000))
                // {
                //      alert("Your alternate mobile number not in range");
                //      return false;
                // }
                return true;
        }

        function push_na_in_empty()
        {
                if( document.getElementById('middlename').value.trim() == '')
                        document.getElementById('middlename').value = 'na';
                if( document.getElementById('lastname').value.trim() == '')
                        document.getElementById('lastname').value = 'na';
                if( document.getElementById('roll_no').value.trim() == '')
                        document.getElementById('roll_no').value = 'na';
                if( document.getElementById('parent_landline').value.trim() == '')
                        document.getElementById('parent_landline').value = 0;
                if( document.getElementById('aadhaar_no').value.trim() == '')
                        document.getElementById('aadhaar_no').value = 'na';
                if( document.getElementById('fee_paid_dd_chk_onlinetransaction_cashreceipt_no').value.trim() == '')
                        document.getElementById('fee_paid_dd_chk_onlinetransaction_cashreceipt_no').value = 'na';
                if( document.getElementById('fee_paid_amount').value.trim() == '')
                        document.getElementById('fee_paid_amount').value = 0;
        }

function onclick_add()
{
        var row=document.getElementById("tableid").rows;
        /*var e=document.getElementsByName("exam4[]")[row.length-2].value;
        var b=document.getElementsByName("branch4[]")[row.length-2].value;
        var c=document.getElementsByName("clgname4[]")[row.length-2].value;
        var g=document.getElementsByName("grade4[]")[row.length-2].value;

        if(e.trim()=="" || b.trim()=="" || c.trim()=="" || g.trim()=="" )
                alert('Sno '+(row.length-1)+' : Please fill up all the fields !!');
        else*/
        if(education_validation())
        {
                if(row.length > 6)
                {
                        alert('You are not allowed to add more rows.');
                        return false;
                }
                //onclick_add_row();
                var newrow=document.getElementById("tableid").insertRow(row.length);
                newrow.innerHTML=document.getElementById("addrow").innerHTML;
                var newid=newrow.cells[0].id="sno"+Number(row.length-2);
                document.getElementById(newid).innerHTML=row.length-1;
                document.getElementsByName('branch4[]')[row.length-2].disabled=false;
                var e=document.getElementsByName("exam4[]")[row.length-2].value='';
                var b=document.getElementsByName("branch4[]")[row.length-2].value='';
                var c=document.getElementsByName("clgname4[]")[row.length-2].value='';
                var g=document.getElementsByName("grade4[]")[row.length-2].value='';
        }
}

function education_validation()
{
        var n_row=document.getElementById("tableid").rows.length;
        var i=0;
        for(i=0;i<=n_row-2;i++)
        {
                var e=document.getElementsByName("exam4[]")[i].value;
                var b=document.getElementsByName("branch4[]")[i].value;
                var c=document.getElementsByName("clgname4[]")[i].value;
                var g=document.getElementsByName("grade4[]")[i].value;
                        
                if(e.trim()=="" || b.trim()=="" || c.trim()=="" || g.trim()=="" )
                {
                        alert('Sno '+(i+1)+': Please fill up all the fields !!');
                        return false;
                }
        }
        return true;
}

function button_for_add()
{
        if(document.getElementById('stu_type').value == 'ug')
        {
                document.getElementById('add').style.display='none';
        }
        else
        {
                document.getElementById('add').style.display='block';
        }
}

function preview_pic()
{
        var file=document.getElementById('photo').files[0];
        if(!file)
                alert("!! Select a file first !!");
        else
        {
                oFReader = new FileReader();
        oFReader.onload = function(oFREvent)
                {
                        var dataURI = oFREvent.target.result;
                        document.getElementById('view_photo').src = dataURI;
                };
                oFReader.readAsDataURL(file);
        }
}