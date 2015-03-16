function onclick_add()
{
    var f=document.getElementsByName("from5")[0].value;
    var t=document.getElementsByName("to5")[0].value;
    var a=document.getElementsByName("addr5")[0].value;
    var d=document.getElementsByName("dist5")[0].value;

    if(f=="" || t=="" || a=="" || d=="" )
            alert('Please fill up all the fields !!');
    else if((new Date(f).getTime()) > (new Date(t).getTime()))
            alert('Error : Fill the period of entering and leaving correctly !!');
    else
        return true;
    return false;
}

$(document).ready(function() {
        $("#next_btn").click(function(e) {
                if(!confirm('Are you sure not to add more details ?'))
                        e.preventDefault();
        });
        $("#add_btn").click(function(e) {
                if(!onclick_add())
                        e.preventDefault();
        });

        $("input[name=from5]").datepicker("setStartDate", moment($("input[name=from5]").attr('min'), "DD-MM-YYYY").toDate());
        $("input[name=from5]").datepicker("setEndDate", moment($("input[name=from5]").attr('max'), "DD-MM-YYYY").toDate());
        $("input[name=to5]").datepicker("setStartDate", moment($("input[name=to5]").attr('min'), "DD-MM-YYYY").toDate());
        $("input[name=to5]").datepicker("setEndDate", moment($("input[name=to5]").attr('max'), "DD-MM-YYYY").toDate());
});