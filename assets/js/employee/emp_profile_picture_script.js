
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
