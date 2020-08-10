$(document).ready(function () {
    $.post(
        "../../controlers/userAction/shareCDASHFileList.php",
        {

        },

        function(data)
        {
            var html = "";
            for(var i = 0; i <data.length; i++)
            {
                html += "<tr>";
                html +=     "<td>" + data[i].filename + "</td>";
                html +=     "<td>" + data[i].uaccount + "</td>";
                html +=     "<td>" + data[i].inputtime + "</td>";
                html +=     "<td>";
                html +=         "<button type='button' class='btn btn-success download'  name='"+data[i].filename+"' id='"+data[i].fileid+"'>下载</button>";
                html +=     "</td>";
                html += "</tr>";
            }

            $("#J_TbData").html(html);


            $(".download").click(function()
            {
                var filename = $(this).attr("name");
                location.href = '../../controlers/userAction/realDownload.php?filename='+filename;

            });


        },'json'
    );
});