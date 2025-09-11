<!DOCTYPE html>
<html lang="fr" class="js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}" id="url">
    <title>
        @yield('titre') | JOBOPTIQUE
    </title>
    <script src="{{asset('jquery.min.js')}}"></script>
    <script src="{{ asset('assets/app/apexcharts/dist/apexcharts.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    <script src="{{ asset('assets/app/js/messageLoader.js') }}"></script>
    <script src="{{asset('assets/app/js/alert.js')}}"></script>
    <script src="{{asset('assets/app/js/format.js')}}"></script>
    <script src="{{asset('assets/app/js/urlHis.js')}}"></script>
    <script src="{{ asset('assets/app/js/select.js') }}"></script>
    <script src="{{ asset('assets/app/js/script.js') }}"></script>
    <script src="{{ asset('assets/app/js/cookies.js') }}"></script>
    <script src="{{ asset('assets/app/js/password.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('assets/css/dashlitee1e3.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/themee1e3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/app/css/style.css') }}">
    
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">

    <input type="hidden" id="login" value="{{ Auth::user()->login }}">
    <input type="hidden" id="agence" value="{{ session('user_magasin') }}">
    <input type="hidden" id="agence_id" value="{{ session('user_magasin_id') }}">
    <input type="hidden" id="id_agence" value="{{ Auth::user()->magasin_id }}">
    <input type="hidden" id="API_SMS_USERNANME" value="{{ env('API_SMS_USERNANME') }}">
    <input type="hidden" id="API_SMS_PASSWORD" value="{{ env('API_SMS_PASSWORD') }}">
    <input type="hidden" id="API_SMS_SERVICEID" value="{{ env('API_SMS_SERVICEID') }}">
    <input type="hidden" id="API_SMS_SENDER" value="{{ env('API_SMS_SENDER') }}">

    <div class="js-preloader">
        <div class="loading-animation">
            <img class="mt-0" src="{{ asset('assets/images/logo.png') }}">
            <div class="loading-animation tri-ring mt-5" style="margin-left: -30px; font-size: 10px;"></div>
        </div>
    </div>
    {{-- <div class="js-preloader">
        <div class="loading-animation tri-ring"></div>
    </div>
    <div class="js-preloader">
        <div class="loading-animation duo-pulse"></div>
    </div> --}}
    <div class="nk-app-root">
        <div class="nk-main ">
            <div id="div_menu" class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="#" class="logo-link nk-sidebar-logo">
                            <img class="logo-dark logo-img" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo.png') }}" >
                            <img class="logo-img logo-img-small" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo.png') }} 2x" style="height: 15px; width:30px;">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                            <em class="icon ni ni-arrow-left"></em>
                        </a>
                        <a href="#" id="btn_menu" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu">
                            <em class="icon ni ni-menu"></em>
                        </a>
                    </div>
                </div>
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item">
                                    <a href="{{ route('tableau_bord') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-chart-down"></em>
                                        </span>
                                        <span class="nk-menu-text">Tableau de Bord</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-users"></em>
                                        </span>
                                        <span class="nk-menu-text">Acteurs</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ route('client') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Clients</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('prospect') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Prospects</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('assurance') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Assurances</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('societe') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Sociétés</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('prescription') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-file-docs"></em>
                                        </span>
                                        <span class="nk-menu-text">Préscription</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-article"></em>
                                        </span>
                                        <span class="nk-menu-text">Factures</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ route('proforma') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Proforma</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('vente') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Ventes</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('his_facture') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Historique des factures</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-coins"></em>
                                        </span>
                                        <span class="nk-menu-text">Comptablités</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @if (session('user_magasin_id') === '1')
                                            <li class="nk-menu-item">
                                                <a href="{{ route('bilan_generale_comptable') }}" class="nk-menu-link">
                                                    <span class="nk-menu-text">Bilan Générale</span>
                                                </a>
                                            </li>
                                        @endif
                                        <li class="nk-menu-item">
                                            <a href="{{ route('bilan_comptable') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Rapport Magasin</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('encaissement') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Encaissements</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('operation') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Opérations de Caisse</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('facturation_assurance') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-file-pdf"></em>
                                        </span>
                                        <span class="nk-menu-text">Facturation</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('recherche_facture') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-search"></em>
                                        </span>
                                        <span class="nk-menu-text">Recherche</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('notification') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-chat"></em>
                                        </span>
                                        <span class="nk-menu-text">Envoi d'sms</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu">
                                    <em class="icon ni ni-menu"></em>
                                </a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="#" class="logo-link">
                                    <img class="logo-dark logo-img" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo.png') }} 2x">
                                </a>
                            </div>
                            <marquee class="d-none d-xl-block" >
                                <span class="fw-bold text-info" style="font-size: 20px;" >JOB</span>
                                <span class="fw-bold text-orange" style="font-size: 20px;" >OPTIQUE</span>
                            </marquee>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown chats-dropdown">
                                        <span class="badge rounded-pill bg-azure p-1">
                                            {{session('user_magasin')}}
                                        </span>
                                    </li>
                                    {{-- <li class="dropdown chats-dropdown">
                                        <a href="#" class="nk-quick-nav-icon" data-bs-toggle="modal" data-bs-target="#modalLargeWidth" id="show_modal_rech" >
                                            <div class="icon-status icon-status-info">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                        </a>
                                    </li> --}}
                                    <li class="dropdown user-dropdown"><a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm bg-azure">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-xl-block">
                                                    <div class="user-status user-status-unverified">
                                                        {{session('user_service')}}
                                                    </div>
                                                    <div class="user-name dropdown-indicator">
                                                        {{ Auth::user()->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <em class="icon ni ni-user"></em>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ Auth::user()->name }}</span>
                                                        <span class="sub-text">{{session('user_service')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    {{-- <li>
                                                        <a href="{{ route('profil') }}">
                                                            <em class="icon ni ni-user-alt"></em>
                                                            <span>Profil</span>
                                                        </a>
                                                    </li> --}}
                                                    <li>
                                                        <a href="#" id="UpdatePassword">
                                                            <em class="icon ni ni-setting"></em>
                                                            <span>Sécurité</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('deconnecter') }}">
                                                            <em class="icon ni ni-signout"></em>
                                                            <span>se déconnecté</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')

                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap text-center">
                            <div class="nk-footer-copyright"> Copyright &copy; JOBOPTIQUE 2024 – Tous droits réservés. Développé par David Kouachi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!request()->routeIs('operation','bilan_comptable','encaissement','bilan_generale_comptable') )
    <ul class="nk-sticky-toolbar me-3">
        <li class="demo-thumb bg-transparent" id="cadre_ouverture_caisse" style="display: none;">
            <a class="tipinfo bg-success text-white rounded-circle" id="btn_ouverture_caisse" title="Ouverture de caisse">
                <em class="icon ni ni-unlock"></em>
            </a>
        </li>
        <li class="demo-purchase bg-transparent" id="cadre_fermeture_caisse" style="display: none;">
            <a class="tipinfo bg-danger text-white rounded-circle" id="btn_fermeture_caisse" title="Fermeture de Caisse">
                <em class="icon ni ni-lock"></em>
            </a>
        </li>
    </ul>
    @endif

    {{-- <div class="pmo-lv pmo-dark active p-3 bg-success" style="width: 200px;">
        <a class="">
            <div class="pmo-text text-white">
                Ouverture de Caisse
            </div>
            <p class="pmo-close">
                <em class="ni ni-arrow-long-right"></em>
            </p>
        </a>
    </div> --}}

    {{-- <div class="pmo-lv pmo-dark active p-3 bg-danger" style="width: 200px;">
        <a class="">
            <div class="pmo-text text-white">
                Fermeture de Caisse
            </div>
            <p class="pmo-close">
                <em class="ni ni-arrow-long-right"></em>
            </p>
        </a>
    </div> --}}
    
    <script src="{{ asset('assets/js/bundlee1e3.js') }}"></script>
    <script src="{{ asset('assets/js/scriptse1e3.js') }}"></script>
    <script src="{{ asset('assets/js/demo-settingse1e3.js') }}"></script>
    <script src="{{ asset('assets/js/libs/datatable-btnse1e3.js') }}"></script>

</body>

</html>