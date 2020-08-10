$(document).ready(function () {
    $.post(
        "../../controlers/userAction/getMyShareSdtmList.php",
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
                html +=         "<button type='button' class='btn btn-danger delete'  id='"+data[i].fileid+"'>取消分享</button>";
                html +=     "</td>";
                html += "</tr>";
            }

            $("#J_TbData").html(html);


            $(".download").click(function()
            {
                var filename = $(this).attr("name");
                location.href = '../../controlers/userAction/realSDTMDownload.php?filename='+filename;

            });

            $(".delete").click(function()
            {
                var fileid = $(this).attr("id");

                $.post('../../controlers/userAction/removeShareSDTMFile.php',
                    {
                        fileid:fileid
                    },
                    function(data)
                    {
                        if(data == 1){
                            alert("删除成功");
                            self.location='../../views/user/myShareSDTMList.php'
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