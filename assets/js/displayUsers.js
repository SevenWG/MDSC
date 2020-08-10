$(document).ready(function () {
    $.post(
        "../../controlers/adminAction/displayAllUsers.php",
        {

        },

        function(data)
        {
            var html = "";
            for(var i = 0; i <data.length; i++)
            {
                html += "<tr>";
                html +=     "<td>" + data[i].userid + "</td>";
                html +=     "<td>" + data[i].uaccount + "</td>";
                html +=     "<td>" + data[i].upwd + "</td>";
                html +=     "<td>";
                html +=         "<button type='button' class='btn btn-danger delete'  id='"+data[i].userid+"'>删除</button>";
                html +=     "</td>";
                html += "</tr>";
            }

            $("#J_TbData").html(html);

            $(".delete").click(function()
            {
                var userid = $(this).attr("id");
                $.post('../../controlers/adminAction/deleteUserAction.php',
                    {
                        userid:userid
                    },
                    function(data)
                    {
                        if(data == 1){
                            alert("删除成功");
                            self.location='../../views/admin/adminIndex.php'
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