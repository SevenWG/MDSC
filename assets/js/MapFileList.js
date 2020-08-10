$(document).ready(function () {
    $.post(
        "../../controlers/adminAction/displayMapFileList.php",
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
                html +=     "<td>" + data[i].inputtime + "</td>";
                html +=     "<td>";
                html +=         "<button type='button' class='btn btn-success download'  name='"+data[i].filename+"' id='"+data[i].fileid+"'>下载</button>";
                html +=     "</td>";
                html +=     "<td>";
                html +=         "<button type='button' class='btn btn-info check'  name='"+data[i].filename+"' id='"+data[i].fileid+"'>查看详情</button>";
                html +=     "</td>";
                html +=     "<td>";
                html +=         "<button type='button' class='btn btn-danger delete'  name='"+data[i].filename+"' id='"+data[i].fileid+"'>删除</button>";
                html +=     "</td>";
                html += "</tr>";
            }

            $("#J_TbData").html(html);

            $(".download").click(function()
            {
                var filename = $(this).attr("name");
                location.href = '../../controlers/adminAction/downloadMapFile.php?filename='+filename;

            });

            $(".check").click(function()
            {
                var fileid = $(this).attr("id");
                var filename = $(this).attr("name");

                $.post('../../controlers/adminAction/setMapSession.php',
                    {
                        fileid:fileid,
                        filename:filename
                    },
                    function(data)
                    {
                        if(data == 1){
                            self.location='../../views/admin/MapCheck.php';
                        }
                        else{
                            alert("出错啦!");
                            self.location='../../views/admin/MapFileList.php';
                        }
                    }
                );
            });

            $(".delete").click(function()
            {
                var fileid = $(this).attr("id");
                var filename = $(this).attr("name");
                $.post('../../controlers/adminAction/deleteMapFile.php',
                    {
                        fileid:fileid,
                        filename:filename
                    },
                    function(data)
                    {
                        if(data == 1){
                            alert("删除成功");
                            self.location='../../views/admin/MapFileList.php'
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