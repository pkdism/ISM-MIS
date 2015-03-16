$(document).ready(function(){
	function insert_department_options(){
		$.ajax({
			url : site_url('publication/publication/json_get_all_departments'),
			dataType:'json',
			type:'post'
		}).done(function(data){
			base_str = '<option value="all" selected="selected">All Departments</option>';
			for($row in data){
				base_str +="<option value='"+data[$row].id+"'>"+data[$row].name+"</option>";
			}
			//console.log(base_str);
			//return base_str;
			$('#search_department').append(base_str);
		});
	}
	function get_emp(callback){
		val = $('select#search_department').find(':selected').val();
		$.ajax({
			url : site_url('publication/publication/json_get_emp_by_dept/'+val+'/'),
			dataType:'json',
			type:'post'
		}).done(function(data){
			base_str = '<tr class="search_faculty_wrapper"><td>Faculty</td><td><select name="emp_id" id="search_faculty"><option value="all" selected="selected">All Faculties</option>';
			for($row=0;$row<data.length;$row++){
				base_str +="<option value='"+data[$row].id+"'>"+data[$row].name+"</option>";
			}
			base_str +='</select></td></tr>';
			callback(base_str);
			//$('#search_faculty').html(base_str);
		});
	}
	insert_department_options();
	//$('#search_faculty_wrapper').hide();
	$('#search_department').on('change',function(){
		if($('#search_department').find(':selected').val() === 'all'){
			$('.search_faculty_wrapper').remove();
			//$("#search_table tr:nth-child(1)").after();
		}
		else{
			$('.search_faculty_wrapper').remove();
			get_emp(function(data){
				$("#search_table tr:nth-child(1)").after(data);
			});
		}
	});

});