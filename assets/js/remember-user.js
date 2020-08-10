
    $(document).ready(function(){

        var strName = localStorage.getItem('keyName');
        var strPass = localStorage.getItem('keyPass');
        if(strName){
            $('#uaccount').val(strName);
        }if(strPass){
            $('#upwd').val(strPass);
        }

        $('#remember-user').click(function(){
            var strName = $('#uaccount').val();
            var strPass = $('#upwd').val();
            localStorage.setItem('keyName',strName);
            if($('#remember-user').is(':checked')){
                localStorage.setItem('keyPass',strPass);
            }else{
                localStorage.removeItem('keyPass');
            }
        });
    });
