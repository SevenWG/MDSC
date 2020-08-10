$(document).ready(function () {
    $.post(
        "../../controlers/adminAction/displayAllSdtmFiles.php",
        {

        },

        function(data)
        {
            var html = "";
            for(var i = 0; i <data.length; i++)
            {
                html += "<tr>";
                html +=     "<td>" + data[i].fileid + "</td>";
                html +=     "<td>" + data[i].filename + "</td>";
                html +=     "<td>" + data[i].uaccount + "</td>";
                html +=     "<td>" + data[i].inputtime + "</td>";
                html +=     "<td>";
                html +=         "<button type='button' class='btn btn-success download'  id='"+data[i].fileid+"'>下载</button>";
                html +=     "</td>";
                html +=     "<td>";
                html +=         "<button type='button' class='btn btn-danger delete'  id='"+data[i].fileid+"'>删除</button>";
                html +=     "</td>";
                html += "</tr>";
            }

            $("#J_TbData").html(html);

            $(".delete").click(function()
            {
                var fileid = $(this).attr("id");

                $.post('../../controlers/adminAction/deleteFileAction.php',
                    {
                        fileid:fileid
                    },
                    function(data)
                    {
                        if(data == 1){
                            alert("删除成功");
                            self.location='../../views/admin/CDASHFileAdmin.php'
                        }
                        else{
                            alert("删除失败");
                        }
                    }
                );
            });

        },'json'
    );
});