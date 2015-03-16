function onclick_add()
{
        var d=document.getElementsByName("designation2")[0].value;
        var f=document.getElementsByName("from2")[0].value;
        var t=document.getElementsByName("to2")[0].value;
        var a=document.getElementsByName("addr2")[0].value;
        var r=document.getElementsByName("payscale2")[0].value;


        if(d=="" || f=="" || t=="" || a=="" || r=="")
        {
                alert('Please fill up all the fields !!');
                return false;
        }
        else if((new Date(f).getTime()) > (new Date(t).getTime()))
        {
                alert('Fill the period correctly !!');
                return false;
        }
        else
                return true;
}

$(document).ready(function() {
        $("#next_btn").click(function(e) {
                if(!confirm('Are you sure not to add more details and go to next step ?'))
                        e.preventDefault();
        });
        $("#add_btn").click(function(e) {
                if(!onclick_add())
                        e.preventDefault();
        });

        $("input[name=from2]").datepicker("setEndDate", moment($("input[name=from2]").attr('max'), "DD-MM-YYYY").toDate());
        $("input[name=to2]").datepicker("setEndDate", moment($("input[name=to2]").attr('max'), "DD-MM-YYYY").toDate());

});