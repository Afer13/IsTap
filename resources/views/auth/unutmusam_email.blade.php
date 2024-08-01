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
                @if (Session('sendEmailOk'))
                    <h2>{{ Session('sendEmailOk') }}</h2>
                @else
                    <form class="login100-form validate-form" action="{{ route('unutmusam.linkGonder') }}" method="POST">
                        @csrf
                        <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                            <input class="input100" type="text" name="email">
                            <span class="focus-input100" data-placeholder="Email"></span>
                        </div>
                        @if ($errors)
                            @foreach ($errors->all() as $error)
                                <p style="color: red">{{ $error }}</p><br>
                            @endforeach
                        @endif
                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn">
                                        Link göndər
                                </button>

                            </div>
                        </div>

                        <div class="text-center p-t-20">
                            <a class="txt2" href="{{ route('login.index') }}">
                                <b>Giriş Et</b> 
                            </a>
                        </div>
                    </form>
                @endif
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