$(document).ready(function () {
    $.post(
        "../../controlers/userAction/displaySDTMFileList.php",
        {

        },

        function(data)
        {
            var html = "";
            for(var i = 0; i <data.length; i++)
            {
                html += "<tr>";
                html +=     "<td>" + data[i].filename + "</td>";
                html +=     "<td>" + data[i].inputtime + "</td>";
                html +=     "<td>";
                html +=         "<button type='button' class='btn btn-success download'  name='"+data[i].filename+"' id='"+data[i].fileid+"'>下载</button>";
                html +=     "</td>";
                html +=     "<td>";
                html +=         "<button type='button' class='btn btn-info share'  id='"+data[i].fileid+"'>分享</button>";
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
                location.href = '../../controlers/userAction/realSDTMDownload.php?filename='+filename;

            });

            $(".share").click(function()
            {
                var fileid = $(this).attr("id");

                $.post('../../controlers/userAction/shareSDTMFileAction.php',
                    {
                        fileid:fileid
                    },
                    function(data)
                    {
                        if(data == 1){
                            alert("分享成功");
                            self.location='../../views/user/SDTMFileList.php'
                        }
                        else{
                            alert("分享失败");
                        }
                    }
                );
            });


            $(".delete").click(function()
            {
                var fileid = $(this).attr("id");
                var filename = $(this).attr("name");

                $.post('../../controlers/userAction/deleteSDTMFileAction.php',
                    {
                        fileid:fileid,
                        filename:filename
                    },
                    function(data)
                    {
                        if(data == 1){
                            alert("删除成功");
                            self.location='../../views/user/SDTMFileList.php';
                        }
                        else{
                            alert("删除失败");
                            self.location='../../views/user/SDTMFileList.php';
                        }
                    }
                );
            });

        },'json'
    );
});