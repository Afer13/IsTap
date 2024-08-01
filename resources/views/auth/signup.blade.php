<!DOCTYPE html>
<html lang="en">
<head>
	<title>Giriş Et</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('ishtap/login/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('ishtap/login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('ishtap/login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				@if($errors)
                        @foreach ($errors->all() as $error)
                            @if (strtok($error, " ")=="Bu")
                                <p style="padding: 10px;border-radius:5px;background-color:rgba(233, 5, 5, 0.881);color:aliceblue;font-size:80%">{{ $error }}</p>
                            @endif
                        @endforeach
                    @endif
				<form autocomplete="off" class="login100-form validate-form" action="{{ route('signup.signup') }}" method="POST" >
					@csrf
                    <input autocomplete="false" name="hidden" type="text" style="display:none;">
					<span class="login100-form-title p-b-26">
						<img style="width: 200px" src="{{ asset('ishtap/img/logo/logo_qara.png') }}" alt="">
					</span>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="name" >
						<span class="focus-input100" data-placeholder="Ad Soyad"></span>
					</div>
                    @if($errors)
                        @foreach ($errors->all() as $error)
                            @if (strtok($error, " ")=="Ad")
                                <p style="color: red">{{ $error }}</p><br>
                            @endif
                        @endforeach
                    @endif
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="e_mail" >
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>
					@if($errors)
                        @foreach ($errors->all() as $error)
                            @if (strtok($error, " ")=="Email")
                                <p style="color: red">{{ $error }}</p><br>
                            @endif
                        @endforeach
                    @endif
					<div class="wrap-input100 validate-input" data-validate="Şifrə">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" >
						<span class="focus-input100" data-placeholder="Şifrə"></span>
					</div>
					@if($errors)
                        @foreach ($errors->all() as $error)
                            @if (strtok($error, " ")=="Şifrə")
                                <p style="color: red">{{ $error }}</p><br>
                            @endif
                        @endforeach
                    @endif
                    <div class="wrap-input100 validate-input" data-validate="Təkrar şifrə">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password_confirmation" >
						<span class="focus-input100" data-placeholder="Təkrar şifrə"></span>
					</div>
                    @if($errors)
                        @foreach ($errors->all() as $error)
                            @if (strtok($error, " ")=="Təkrar")
                                <p style="color: red">{{ $error }}</p><br>
                            @endif
                        @endforeach
                    @endif
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Qeydiyyatdan Keç
							</button>
						</div>
					</div>
					<div class="text-center p-t-70">
						<span class="txt1">
							Hesabınız mövcuddur?
						</span>

						<a class="txt2" href="{{ route('login.index') }}">
							<b>Giriş Et</b> 
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="{{ asset('ishtap/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('ishtap/login/js/main.js')}}"></script>
<script>
    $( document ).ready(function() {
    $('input').attr('autocomplete','off');
});
</script>
</body>
</html>