function onclick_add()
{
        var e=document.getElementsByName("exam4")[0].value;
        var b=document.getElementsByName("branch4")[0].value;
        var c=document.getElementsByName("clgname4")[0].value;
        var y=document.getElementsByName("year4")[0].value;
        var g=document.getElementsByName("grade4")[0].value;
        var d=document.getElementsByName("div4")[0].value;

        if(e=="" || b=="" || c=="" || y=="" || g=="" || d=="" )
                alert('Please fill up all the fields !!');
        else return true;
        return false;
}

function examination_handler()
{
        var exam=document.getElementsByName("exam4")[0].value;
        if(exam=="non-matric")
        {
                document.getElementsByName("branch4")[0].value="n/a";
                document.getElementsByName("clgname4")[0].value="n/a";
                document.getElementsByName("year4")[0].value="n/a";
                document.getElementsByName("grade4")[0].value="n/a";
                document.getElementsByName("div4")[0].value="n/a";
        }
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

        $("select[name=exam4]").change(examination_handler);

        //if tbl4 is present show next btn otherwise hide it, as it is a compulsory page.
        if($("#tbl4").length)
                $("#next_btn").show();
        else
                $("#next_btn").hide();

});