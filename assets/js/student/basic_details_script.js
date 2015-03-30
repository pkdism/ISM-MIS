	$(document).ready(function() {
		document.getElementById('corr_addr_visibility').style.display = 'none';

		document.getElementById("add").onclick = function() {onclick_add();};

		$('[name="depends_on"]').on('ifChanged', function() {
    		depends_on_whom();
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
			options_of_branches();
		});

		$('#id_admn_based_on').on('change', function() {
			select_exam_scores();
		});

		$('#correspondence_addr').on('ifChanged', function() {
			corrAddr();
		});

		$('#form_submit').on('submit', function(e) {
			if(!form_validation())
				e.preventDefault();
		});

		add_row_on_page_load();

	});

	function add_row_on_page_load()
	{
		onclick_add_row();
		var student_type = document.getElementById('stu_type').value;
		if(student_type == 'ug')
			document.getElementById('add').style.display='none';
		var row=document.getElementById("tableid").rows;
		var branch1 = document.getElementsByName('branch4[]')[row.length-3];
		var branch2 = document.getElementsByName('branch4[]')[row.length-2];
		document.getElementsByName('branch4[]')[row.length-3].value = '10';
		document.getElementsByName('branch4[]')[row.length-3].disabled = true;
		document.getElementsByName('branch4[]')[row.length-2].value = '12';
		document.getElementsByName('branch4[]')[row.length-2].disabled = true;
	}

	function preview_pic()
	{
		var file=document.getElementById('photo').files[0];
		if(!file)
			document.getElementById('view_photo').src =  js_base_url()+"assets/images/student/noProfileImage.png";
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

	function check_if_student_type_others()
    {
    	var student_type = document.getElementById('stu_type').value;
    	var student_other_type = document.getElementById('student_other_type');
    	if(student_type == 'others')
    		student_other_type.disabled = false;
    	else
    		student_other_type.disabled = true;
    }

	function form_validation()
	{
		/*var pgv = parent_gaurdian_validation();
		var abov = admission_based_on_validation();
		var cb = course_branch_validation();
		var cav = correspondence_addr_validation();
		var stv = student_type_validation();
		var anv = all_number_validation();
		var iv = image_validation();
		return pgv && abov && cb && cav && stv && iv;*/
		if(!password_validation())
			return false;
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
		if(!image_validation())
			return false;
		//push_na_in_empty();
		return true;
	}

	function password_validation()
	{
		var pass = document.getElementById('password').value;
		var c_pass = document.getElementById('confirm_password').value;
		if(pass == '')
		{
			alert("Please enter the password.");
			$('#password').focus();
			return false;
		}
		if(c_pass == '')
		{
			alert("Please enter the Confirm Password field.");
			$('#confirm_password').focus();
			return false;
		}
		var pass_pattern = /^\S+$/;//([a-z]|[A-Z]|[0-9]|@|.|*|$);
		if(!pass_pattern.test(pass))
		{
			alert("Password must contain only alphabets, digits and special characters.");
			$('#password').focus();
			return false;
		}
		if(!pass_pattern.test(c_pass))
		{
			alert("Confirm Password must contain only alphabets, digits and special characters.");
			$('#confirm_password').focus();
			return false;
		}
		if(c_pass != pass)
		{
			alert("Password and Confirm Password must be same.");
			$('#password').focus();
			return false;
		}
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
				$('#line13').focus();
				return false;
			}
			else if(isNaN(pincode))
			{
				alert("Pincode can contain only numbers.");
				$('#pincode3').focus();
				return false;
			}
			if(isNaN(contact))
			{
				alert("Correspondance Contact can contain only numbers.");
				$('#contact3').focus();
				return false;
			}
			else if(contact >= 10000000000 || contact < 1000000000)
			{
				alert("Correspondence mobile number not in range.");
				$('#contact3').focus();
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
				alert("Branch or Course not selected or exists.");
				$('#course_id').focus();
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
				alert("Please fill all details of parents.");
				$('#father_name').focus();
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
				alert("Please fill all details of guardian.");
				$('#guardian_name').focus();
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
				alert("Please fill the IIT-JEE rank or the category rank.");
				$('#iitjee_rank').focus();
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
				alert("Please fill the gate score.");
				$('#gate_score').focus();
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
				alert("Please fill the cat score.");
				$('#cat_score').focus();
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
				alert("Please fill the other mode of admission.");
				$('#other_mode_of_admission').focus();
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
				$('#student_other_type').focus();
				return false;
			}
			else
				return true;
		}
		return true;
	}

	function image_validation()
	{
		var file=document.getElementById('photo').files[0];
		var ext=file.name.substring(file.name.lastIndexOf('.') + 1);
		if(ext == "bmp" || ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg" )
		{
			if(file.size>204800)
			{
				alert('The file size must be less than 200KB');
				$('#photo').focus();
				return false;
			}
			else
				return true;
		}
		else
		{
			alert('The image should be in bmp, gif, png, jpg or jpeg format.');
			$('#photo').focus();
			return false;
		}
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

	function depends_on_whom()
	{
		var dpe = document.getElementById("depends_on").checked;
//var dpe_relation = document.getElementById("depends_on_relation").checked;

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
    	//alert("hi");
        var tr=document.getElementById('branch_id');
        var course=document.getElementById('course_id').value;
//        var tr=document.getElementById('branch_div');
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
            	//alert ("success");
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
        //set_id_of_branch();
        //alert('reached course');
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
            	//alert('success');
                tr.innerHTML=xmlhttp.responseText;
                options_of_branches();
            }
        }
        //alert(branch);
        xmlhttp.open("POST",site_url("student/student_ajax/update_courses/"+dept),true);
        xmlhttp.send();
        tr.innerHTML="<option selected=\"selected\">Loading...</option>";
    }

    function all_number_validation()
	{
		if(isNaN(document.getElementById('father_gross_income').value))
		{
			alert("Father's Gross Income can only contain digits.");
			$('#father_gross_income').focus();
			return false;
		}
		if(isNaN(document.getElementById('mother_gross_income').value))
		{
			alert("Mother's Gross Income can only contain digits.");
			$('#mother_gross_income').focus();
			return false;
		}
		if(isNaN(document.getElementById('parent_mobile').value))
		{
			alert("Parent Mobile number can contain only digits.");
			$('#parent_mobile').focus();
			return false;
		}
		if(isNaN(document.getElementById('parent_landline').value))
		{
			alert("Paerent Landline number can only contain digits.");
			$('#parent_landline').focus();
			return false;
		}
		if(isNaN(document.getElementById('pincode1').value))
		{
			alert("Pincode of present address can only contain digits.");
			$('#pincode1').focus();
			return false;
		}
		if(isNaN(document.getElementById('pincode2').value))
		{
			alert("Pincode of premanent address can only contain digits.");
			$('#pincode2').focus();
			return false;
		}
		if(isNaN(document.getElementById('contact1').value))
		{
			alert("Contact of present address can contain only digits.");
			$('#contact1').focus();
			return false;
		}
		if(isNaN(document.getElementById('contact2').value))
		{
			alert("Contact of permanent address can contain only digits.");
			$('#contact2').focus();
			return false;
		}
		if(isNaN(document.getElementById('mobile').value))
		{
			alert("Your mobile number can contain only digits.");
			$('#mobile').focus();
			return false;
		}
		if(isNaN(document.getElementById('fee_paid_amount').value))
		{
			alert("Fee Paid Amount field can contain only digits.");
			$('#fee_paid_amount').focus();
			return false;
		}
		if(document.getElementById('alternate_mobile').value != '' && isNaN(document.getElementById('alternate_mobile').value))
		{
			alert("Alternate Mobile number can contain only digits.");
			$('#alternate_mobile').focus();
			return false;
		}
		if(isNaN(document.getElementById('iitjee_cat_rank').value) || isNaN(document.getElementById('iitjee_rank').value))
		{
			alert("IIT JEE Rank can only contain digits.");
			$('#iitjee_rank').focus();
			return false;
		}
		return true;
	}

	function mobile_number_size_validation()
	{
		var parent_mobile_no = document.getElementById('parent_mobile').value;
		var present_contact_no = document.getElementById('contact1').value;
		var permanent_contact_no = document.getElementById('contact2').value;
		var mobile_no = document.getElementById('mobile').value;
		var alternate_mobile_no = document.getElementById('alternate_mobile').value;
		if(parent_mobile_no >= 10000000000 || parent_mobile_no < 1000000000)
		{
			alert("Parent mobile number not in range");
			$('#parent_mobile').focus();
			return false;
		}
		else if(present_contact_no >= 10000000000 || present_contact_no < 1000000000)
		{
			alert("Present address mobile number not in range");
			$('#contact1').focus();
			return false;
		}
		else if(permanent_contact_no >= 10000000000 || permanent_contact_no < 1000000000)
		{
			alert("Permanent address mobile number not in range");
			$('#contact2').focus();
			return false;
		}
		else if(mobile_no >= 10000000000 || mobile_no < 1000000000)
		{
			alert("Your mobile number not in range");
			$('#mobile').focus();
			return false;
		}
		else if(alternate_mobile_no != '' && (alternate_mobile_no >= 10000000000 || alternate_mobile_no < 1000000000))
		{
			alert("Your alternate mobile number not in range");
			$('#alternate_mobile').focus();
			return false;
		}
		return true;
	}

	function push_na_in_empty()
	{
		/*if( document.getElementById('middlename').value.trim() == '')
			document.getElementById('middlename').value = 'na';
		if( document.getElementById('lastname').value.trim() == '')
			document.getElementById('lastname').value = 'na';*/
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
		if( document.getElementById('alternate_email_id').value.trim() == '')
			document.getElementById('alternate_email_id').value = 'na';
		if( document.getElementById('alternate_mobile').value == '')
			document.getElementById('alternate_mobile').value = 0;
		if( document.getElementById('hobbies').value.trim() == '')
			document.getElementById('hobbies').value = 'na';
		if( document.getElementById('favpast').value.trim() == '')
			document.getElementById('favpast').value = 'na';
		if(document.getElementById('any_other_information').value.trim() == '')
			document.getElementById('any_other_information').value = 'na';
		if(document.getElementById('extra_activity').value.trim() == '')
			document.getElementById('extra_activity').value = 'na';
	}

	function onclick_add_row()
	{
		var row=document.getElementById("tableid").rows;
		var newrow=document.getElementById("tableid").insertRow(row.length);
		newrow.innerHTML=document.getElementById("addrow").innerHTML;
		var newid=newrow.cells[0].id="sno"+Number(row.length-2);
		document.getElementById(newid).innerHTML=row.length-1;
		//document.getElementsByName('branch4[]')[row.length-1].disabled=false;
	}

	function onclick_add()
	{	
		var row=document.getElementById("tableid").rows;
		/*var e=document.getElementsByName("exam4[]")[row.length-2].value;
		var b=document.getElementsByName("branch4[]")[row.length-2].value;
		var c=document.getElementsByName("clgname4[]")[row.length-2].value;
		var g=document.getElementsByName("grade4[]")[row.length-2].value;

		if(e.trim()=="" || b.trim()=="" || c.trim()=="" || g.trim()=="" )
		{
			alert('Education details Sno '+(row.length-1)+' : Please fill up all the fields !!');
			$('#tableid').focus();
		}
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
				alert('Educational details Sno '+(i+1)+': Please fill up all the fields !!');
				$('#tableid').focus();
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

    /*function set_id_of_branch()
    {
        var branch_id=document.getElementById('branch_id').value;
        document.getElementById('id_of_branch').value=branch_id;
        return 0;
    }

    function set_id_of_course()
    {
        var course_id=document.getElementById('course_id').value;
        document.getElementById('id_of_course').value=course_id;
    }*/
