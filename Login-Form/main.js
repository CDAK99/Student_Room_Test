$(document).ready(function () {
    //when login button is clicked submit form details
    $('#loginBtn').on('click', function(){
        //store entered username & password in variables
        str_username = $('#strUsername').val();
        str_password = $('#strPassword').val();

        //remove any error messages being displayed
        $('#messageDiv').empty();

        //check if the username or password are empty. if they are return false and display error
        if(str_username == ""){
            $('#strUsername').addClass('field-error');
            $('#messageDiv').append('Please enter a username!');
            return false;
        }

        if(str_password == ""){
            $('#strPassword').addClass('field-error');
            $('#messageDiv').append('Please enter a password!');
            return false;
        }

        //submit form details to php function using ajax
        $.ajax({
            url:"process_form.php", type: 'post',
            data:{f: 'process_login', strUsername: str_username, strPassword: str_password},
            success:function(data){
                //if login is successful reload the page
                if(data['success'] == 1){
                    location.reload();
                } else {
                    // login is unsuccessful so display error message
                    $('#messageDiv').append(data['message']);
                    $('#messageDiv').addClass('error');
                    $('#strUsername').addClass('field-error');
                    $('#strPassword').addClass('field-error');
                }
            },
            dataType:'json'
        }).done(function(data){
        });
    });

    //when logout button is clicked run out logout function in php
    $('#logoutBtn').on('click', function(){
        //submit function call using ajax
        $.ajax({
            url:"process_form.php", type: 'post',
            data:{f: 'logout_user'},
            success:function(data){
                //reload page after user is logged out
                location.reload();
            },
            dataType:'json'
        }).done(function(data){
        });

    });

    $("#loginForm").submit(function(e){
        //prevent form being submitted by html
        e.preventDefault();
    });
});
