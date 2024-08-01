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
				<form class="login100-form validate-form" action="{{ route('unutmusam.resetPassword') }}" method="POST">
                    @csrf
					<span class="login100-form-title p-b-26">
						<img style="width: 200px" src="{{ asset('ishtap/img/logo/logo_qara.png') }}" alt="">
					</span>
                    <h1>Şifrəni Yenilə</h1>

                    <input type="hidden" name="token" value="{{ $token }}">
                    @if (Session('email_no'))
                        <p style="color: red">{{ Session('email_no') }}</p>
                    @endif
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>
                    @if($errors)
                        @foreach ($errors->all() as $error)
                            @if (strtok($error, " ")=="Email")
                                <p style="color: red">{{ $error }}</p><br>
                            @endif
                        @endforeach
                    @endif
					<div class="wrap-input100 validate-input" data-validate="Yeni şifrə">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Yeni şifrə"></span>
					</div>

                    @if($errors)
                        @foreach ($errors->all() as $error)
                            @if (strtok($error, " ")=="Şifrə")
                                <p style="color: red">{{ $error }}</p><br>
                            @endif
                        @endforeach
                    @endif
					<div class="wrap-input100 validate-input" data-validate="Şifrənin təkrarı">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password_confirmation">
						<span class="focus-input100" data-placeholder="Şifrənin təkrarı"></span>
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
								Şifrəni Sıfırla
							</button>
						</div>
					</div>
                </form>
                    <div class="text-center p-t-20">
                        <a class="txt2" href="{{ route('login.index') }}">
                            <b>Giriş Et-ə qayıt</b> 
                        </a>
                    </div>
				
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="{{ asset('ishtap/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('ishtap/login/js/main.js')}}"></script>

</body>
</html>