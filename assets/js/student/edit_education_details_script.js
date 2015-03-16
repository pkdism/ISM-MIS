$(document).ready(function() {
	if(document.getElementById('student_type').value == 'ug')
		document.getElementById('add').style.display='none';
	else if(document.getElementById("tableid").rows.length > 6)
		document.getElementById('add_new').style.display='none';

	document.getElementById("add").onclick = function() {onclick_add();};

	$('#form_submit').on('submit', function(e) {
		if(!education_validation())
			e.preventDefault();
	});
});

function onclick_add()
{
	var row=document.getElementById("tableid").rows;
	var e=document.getElementsByName("exam4[]")[row.length-2].value;
	var b=document.getElementsByName("branch4[]")[row.length-2].value;
	var c=document.getElementsByName("clgname4[]")[row.length-2].value;
	var g=document.getElementsByName("grade4[]")[row.length-2].value;

	if(e.trim()=="" || b.trim()=="" || c.trim()=="" || g.trim()=="" )
		alert('Sno '+(row.length-1)+' : Please fill up all the fields !!');
	else
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