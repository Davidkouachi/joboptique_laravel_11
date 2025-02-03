<!DOCTYPE html>
<html lang="fr" class="js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}">
    <title>Login | JobOptique</title>
    <script src="{{asset('jquery.min.js')}}"></script>
    <script src="{{asset('assets/app/js/alert.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/dashlitee1e3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/app/css/style_login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/app/css/style.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/themee1e3.css') }}">
</head>

<body class="nk-body bg-white npc-default pg-auth"> 
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body" style="max-width: 30%;">
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                            	<div class="brand-logo pb-4 text-center mb-3">
		                        	<a class="logo-link">
		                        		<img style="height: 600px; width: 200px; " class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/images/logo.jpg') }}" srcset="{{ asset('assets/images/logo.jpg') }} 2x">
		                        	</a>
		                        </div>
                                <div class="nk-block-head mb-3">
                                    <div class="nk-block-head-content text-center">
                                        <h4 class="nk-block-title">Bienvenue ! 👋</h4>
                                        <div class="nk-block-des">
                                            <p>Plateforme de gestion</p>
                                        </div>
                                    </div>
                                </div>
                                <form id="formulaire_login" class="mb-3">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                        	<label class="form-label">Login</label>
                                        </div>
                                        <div class="form-control-wrap">
                                        	<input id="login" type="text" class="form-control form-control-md" placeholder="Entrer votre Login">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                        	<label class="form-label">Mot de passe</label>
                                        	{{-- <a class="link link-primary link-sm" href="">Mot de passe oublié?</a> --}}
                                        </div>
                                        <div class="form-control-wrap">
                                        	<a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                        		<em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        		<em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        	</a>
                                        	<input type="password" class="form-control form-control-md" id="password" placeholder="Entrer votre mot de passe">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    	<button type="submit" class="btn btn-md btn-outline-success btn-block">Se connecter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bundlee1e3.js') }}"></script>
    <script src="{{ asset('assets/js/scriptse1e3.js') }}"></script>
    <script src="{{ asset('assets/js/demo-settingse1e3.js') }}"></script>
    <script src="{{ asset('assets/app/js/scriptvrflogin.js') }}"></script>

</html>