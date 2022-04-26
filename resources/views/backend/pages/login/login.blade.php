@extends('backend.layout.login_layout')

@section('section')
@php

if(file_exists( public_path().'/upload/systemsetting/'.get_system_setting_detail()->website_logo) && get_system_setting_detail()->website_logo != null){
    $login_image = url("public/upload/systemsetting/".get_system_setting_detail()->website_logo);
}else{
    $login_image = url("public/upload/systemsetting/default.jpg");
}
@endphp


<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login" >
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url({{ $login_image }})">
            <div class="login-form   p-7 position-relative overflow-hidden" style="background: white !important; color: black">
             
                <!--end::Login Header-->
                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-10 text-center">
                        <h1 style="font-size: 3rem !important">{{ get_system_setting_detail()->system_name }}</h1>
                        
                        <p class="">Enter your details to login to your account:</p>                        
                    </div>
                    <form class="form"  id="login-form" method="POST" enctype="multipart/form-data" action="{{ route('check-login') }}">@csrf
                        <div class="form-group">
                            <input class="form-control form-control-solid  py-7 px-6" type="text" name="email" placeholder="Please enter your register email" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-solid  py-7 px-6" type="password" name="password" placeholder="Please enter your password"  autocomplete="off" />
                        </div>
                       <hr>
                        <div class="form-group text-center mt-10">
                            <button id="kt_login_signin_submit" class="btn btn-primary btn-outline-primary btn-block">Sign In</button>
                        </div>
                    </form>
                    
                </div>
                <!--end::Login Sign in form-->
               
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->

@endsection
