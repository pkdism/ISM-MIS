	$(document).ready(function() {
		if(document.getElementById('extra_activity').value == 'na')
			document.getElementById('extra_activity').value = '';
		if(document.getElementById('any_other_information').value == 'na')
			document.getElementById('any_other_information').value = '';
		if(document.getElementById('alternate_email_id').value == 'na')
			document.getElementById('alternate_email_id').value = '';
		if(document.getElementById('hobbies').value == 'na')
			document.getElementById('hobbies').value = '';
		if(document.getElementById('favpast').value == 'na')
			document.getElementById('favpast').value = '';
		if(document.getElementById('alternate_mobile').value == '0')
			document.getElementById('alternate_mobile').value = '';

		$('#form_submit').on('submit', function(e) {
			if(!form_validation())
				e.preventDefault();
		});
	});

	function form_validation()
	{
		if(!all_number_validation())
			return false;
		if(!mobile_number_size_validation())
			return false;
		push_na_in_empty();
		return true;
	}

	function all_number_validation()
	{
		if(isNaN(document.getElementById('mobile').value))
		{
			alert("Mobile No. can contain only digits.");
			return false;
		}
		if(isNaN(document.getElementById('alternate_mobile').value))
		{
			alert("Alternate Mobile No. can contain only digits.");
			return false;
		}
		return true;
	}

	function mobile_number_size_validation()
	{
		var mobile_no = document.getElementById('mobile').value;
		var alternate_mobile_no = document.getElementById('alternate_mobile').value;
		if(mobile_no >= 10000000000 || mobile_no < 1000000000)
		{
			alert("Your mobile number not in range");
			return false;
		}
		else if(alternate_mobile_no != '' && (alternate_mobile_no >= 10000000000 || alternate_mobile_no < 1000000000))
		{
			alert("Your alternate mobile number not in range");
			return false;
		}
		return true;
	}

	function push_na_in_empty()
	{
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
