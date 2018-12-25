$(document).ready(function(){


    //open register modal
    $('.start-register-modal').click(function(){
        //click register button to show register modal
        $('#registerModal').modal('show');
        //reset all fields in the form
        //$('#register_form')[0].reset();
        //delete all errors
        $('#register_form_output').html('');
    });//end open modal


    //sending register
    $('#register_form').on('submit', function(event) {
        event.preventDefault();
        let name = $('#register_name').val();
        let isName=name.length > 2;
        let email = $('#register_email').val();
        let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let isAnEmail = re.test(email.toLowerCase());
        let password=$('#register_password').val();
        let passwordConfirmation=$('#register_confirm').val()
        let passwordLength = password.length >= 6;
        let passwordConfirm = password == passwordConfirmation;
        let checked=$('#register_checked').prop('checked');
        let url=$('#register_form').attr('action');

        if(isName && isAnEmail && passwordLength && passwordConfirm && checked) {
            //converts data to string
            //var form_data = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let form_data = {};
            form_data.name=name;
            form_data.email=email;
            form_data.password=password;
            form_data.password_confirmation=passwordConfirmation;

            //console.log(form_data)
            //return
            //send ajax request
            $.ajax({
                url: url,

                method: 'POST',
                data: form_data,
                dataType: 'json',
                success: function (data) {

                    if (data[0] == "error") {
                        //we have errors
                        let rows = "";
                        $.each(data[1], function (index, message) {
                            rows += "<div class='alert alert-danger'>" + message + "</div>";
                        })

                        $('#register_form_output').append(rows);
                    } else if (data == "success") {
                        $('#register_form')[0].reset();
                        $('#registerModal').modal('hide');
                        location.reload();
                    }
                }

            });//end .ajax
        }else{
            $('#register_form_output').html('')
            //some inputs are not correct
            if(!name){
                let row="<div class='alert alert-danger'>Your name is not minimum 3 characters long</div>";
                $('#register_form_output').append(row);
            }
            if(!isAnEmail){
                let row="<div class='alert alert-danger'>Email is not in correct format</div>";
                $('#register_form_output').append(row);
            }
            if(!passwordLength){
                let row="<div class='alert alert-danger'>Password must be at least 6 characters long</div>";
                $('#register_form_output').append(row);
            }
            if(!passwordConfirm){
                let row="<div class='alert alert-danger'>Your password and retyped password don't match</div>";
                $('#register_form_output').append(row);
            }
            if(!checked){
                let row="<div class='alert alert-danger'>You need to agree with our terms of service. Please click the checkbox</div>";
                $('#register_form_output').append(row);
            }
        }
    });//end send register form

    //open login modal
    $('.start-login-modal').click(function(){
        //when we click Login button, modal shows up
        $('#loginModal').modal('show');
        //reset all values in modal
        //$('#login_form')[0].reset();
        //delete spans (if any)
        $('#login_form_output').html('');

    });//end open login modal


    //sending login
    $('#login_form').on('submit', function(event){
        event.preventDefault();
        //convert data to string and sends to server
        let email=$('#login_email').val();
        let password=$('#login_password').val();
        let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let isAnEmail = re.test(email.toLowerCase());
        let passwordLength=password.length >=6;
        let remember=$('#remember_checked').prop('checked');
        console.log(remember, password, email, 'da li je mail', isAnEmail, passwordLength)
        if(isAnEmail && passwordLength){
            //let form_data=$(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let form_data = {};
            form_data.password=password;
            form_data.email=email;
            form_data.remember=remember;
console.log(form_data)
            let url=$('#login_form').attr('action');
            $.ajax({
                url:url,
                method: 'POST',
                data: form_data,
                dataType:'json',

                success: function(data){
                    if(data=="success"){
                        $('#loginModal').modal('hide');
                        location.reload();
                    }else{
                        let row="<div class='alert alert-danger'>There was an error with your credentials</div>";
                        $('#login_form_output').append(row);
                    }

                }
            });
        }else{
            $('#login_form_output').html('')
            //password and/or email are not correct
            if(!isAnEmail){
                let row="<div class='alert alert-danger'>Email is not in correct format</div>";
                $('#login_form_output').append(row);
            }
            if(!passwordLength){
                let row="<div class='alert alert-danger'>Password must be at least 6 characters long</div>";
                $('#login_form_output').append(row);
            }
        }

    });//end send ajax login

    $('#search_form').submit(function(){
        event.preventDefault();
        let title=$('#search_field').val().trim();

        if(title !=""){
            $(this).unbind('submit').submit()
        }
    });

});//end document ready



