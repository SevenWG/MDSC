$(document).ready(function () {
    $.post(
        "../../controlers/adminAction/MapCheckAction.php",
        {

        },

        function(data)
        {
            var html = "";
            for(var i = 0; i <data.length-1; i++)
            {
                html += "<tr>";
                html +=     "<td>" + data[i].domain + "</td>";
                html +=     "<td>" + data[i].odmId + "</td>";
                html +=     "<td>" + data[i].cdashVar + "</td>";
                html +=     "<td>" + data[i].sdtmVar + "</td>";
                html += "</tr>";
            }

            $("#J_TbData").html(html);

        },'json'
    );
});