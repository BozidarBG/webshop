@extends('layouts.layout')

@section('title')
    Contact Us
@endsection

@section('content')
    <div class="contact py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3" >
                <span>C</span>ontact
                <span>U</span>s
            </h3>
            <!-- //tittle heading -->
            <div class="row contact-grids agile-1 mb-5">

                <div class="col-sm-4 contact-grid agileinfo-6 mt-sm-0 mt-2">
                    <div class="contact-grid1 text-center">
                        <div class="con-ic">
                            <i class="fas fa-map-marker-alt rounded-circle"></i>
                        </div>
                        <h4 class="font-weight-bold mt-sm-4 mt-3 mb-3">Address</h4>
                        <p>{{setting('site.address')}}
                            <label>{{setting('site.city')}}</label>
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 contact-grid agileinfo-6 my-sm-0 my-4">
                    <div class="contact-grid1 text-center">
                        <div class="con-ic">
                            <i class="fas fa-phone rounded-circle"></i>
                        </div>
                        <h4 class="font-weight-bold mt-sm-4 mt-3 mb-3">Call Us</h4>
                        <p>{{setting('site.phone1')}}
                            <label>{{setting('site.phone2')}}</label>
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 contact-grid agileinfo-6">
                    <div class="contact-grid1 text-center">
                        <div class="con-ic">
                            <i class="fas fa-envelope-open rounded-circle"></i>
                        </div>
                        <h4 class="font-weight-bold mt-sm-4 mt-3 mb-3">Email</h4>
                        <p>
                            <a href="mailto:{{setting('site.email')}}">{{setting('site.email')}}</a>

                        </p>
                    </div>
                </div>
            </div>

            <div id="title"></div>
            <!-- form -->
            <form action="#" method="post" id="contact_form">
                @csrf
                <div class="contact-grids1 w3agile-6">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 contact-form1 form-group">
                            <label class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="col-md-6 col-sm-6 contact-form1 form-group">
                            <label class="col-form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                    </div>
                    <div class="contact-me animated wow slideInUp form-group">
                        <label class="col-form-label">Message</label>
                        <textarea id="body" class="form-control" required> </textarea>
                    </div>
                    <div class="contact-form">
                        <input type="submit" value="Submit">
                    </div>
                </div>
            </form>
            <!-- //form -->
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            //sending contact
            $('#contact_form').on('submit', function(event) {
                event.preventDefault();
                let name = $.trim($('#name').val());
                let isName=name.length > 3;
                let email = $.trim($('#email').val());
                let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                let isAnEmail = re.test(email.toLowerCase());
                let body= $.trim($('#body').val());
                let bodyLength = body.length >= 10;
                console.log(name, email, body, isName, isAnEmail, bodyLength)
                if(isName && isAnEmail && bodyLength) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    let form_data = {};
                    form_data.name=name;
                    form_data.email=email;
                    form_data.body=body;


                    //console.log(form_data)
                    //return
                    //send ajax request
                    $.ajax({
                        url: "/contact",

                        method: 'POST',
                        data: form_data,
                        dataType: 'json',
                        success: function (data) {

                            if (data == "error") {
                                //we have errors
                                let msg= "<div class='alert alert-danger'>Oops, there was some error on the server. Please, try later!</div>";
                                $('#title').html(msg);

                            } else if (data == "success") {
                                let msg= "<div class='alert alert-success'>Thank you for your inquiry. Our administrator will contact you within 24 hrs!</div>";
                                $('#title').html(msg);
                                $('#contact_form').hide();

                            }
                        }

                    });//end .ajax
                }else{
                    $('#title').html('')
                    //some inputs are not correct
                    if(!isName){
                        let row="<div class='alert alert-danger'>Your name is not minimum 3 characters long</div>";
                        $('#title').append(row);
                    }
                    if(!isAnEmail){
                        let row="<div class='alert alert-danger'>Email is not in correct format</div>";
                        $('#title').append(row);
                    }
                    if(!bodyLength){
                        let row="<div class='alert alert-danger'>Your message must be at least 10 characters long</div>";
                        $('#title').append(row);
                    }

                }
            });//end send register form


        });//end document ready




    </script>
    @endsection