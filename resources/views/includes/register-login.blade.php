<!-- log in -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Log In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('login')}}" id="login_form" method="post">

                    <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input type="text" class="form-control" name="email" required id="login_email" value="{{old('email')}}">

                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input type="password" class="form-control" name="password" required id="login_password">

                    </div>
                    <div class="right-w3l">
                        <input type="submit" name="submit" id="login" value="Login" class="form-control">

                    </div>
                    <div class="sub-w3l">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="remember_checked" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember_checked" >Remember me?</label>
                        </div>
                    </div>
                    <p class="text-center dont-do mt-3">Don't have an account?
                        <a href="#" data-toggle="modal" data-target="#registerModal">
                            Register Now</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- register -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('register')}}" method="post" id="register_form">
                    @csrf
                    <div id="register_form_output"></div>
                    <div class="form-group">
                        <label class="col-form-label">Your Name</label>
                        <input type="text" class="form-control" placeholder=" " id="register_name" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input type="email" class="form-control" placeholder=" " id="register_email" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Password (minimum 6 characters)</label>
                        <input type="password" class="form-control" placeholder=" " id="register_password" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Confirm Password</label>
                        <input type="password" class="form-control" placeholder=" " id="register_confirm" required="">
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" value="Register" id="register">
                    </div>
                    <div class="sub-w3l">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="register_checked">
                            <label class="custom-control-label" for="register_checked">I Accept the Terms & Conditions</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>