<!DOCTYPE html>
<html lang="fr" class="js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('titre') | JOBOPTIQUE
    </title>
    <script src="{{asset('jquery.min.js')}}"></script>
    <script src="{{asset('assets/app/js/format.js')}}"></script>
    <script src="{{asset('assets/app/js/urlHis.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/dashlitee1e3.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/themee1e3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/app/css/style.css') }}">
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">  
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="#" class="logo-link nk-sidebar-logo">
                            <img class="logo-dark logo-img" src="{{ asset('assets/images/logo.jpg') }}" srcset="{{ asset('assets/images/logo.jpg') }}" >
                            <img class="logo-img logo-img-small" src="{{ asset('assets/images/logo.jpg') }}" srcset="{{ asset('assets/images/logo.jpg') }} 2x" style="height: 15px; width:30px;">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                            <em class="icon ni ni-arrow-left"></em>
                        </a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu">
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
                                            <em class="icon ni ni-bag"></em>
                                        </span>
                                        <span class="nk-menu-text">Tableau de Bord</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-tile-thumb-fill"></em>
                                        </span>
                                        <span class="nk-menu-text">Clients & Prospects</span>
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
                                    </ul>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-bag"></em>
                                        </span>
                                        <span class="nk-menu-text">Préscription</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-tile-thumb-fill"></em>
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
                                            <a href="#" class="nk-menu-link">
                                                <span class="nk-menu-text">Ventes</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-tile-thumb-fill"></em>
                                        </span>
                                        <span class="nk-menu-text">Comptablités</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link">
                                                <span class="nk-menu-text">Encaissements</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link">
                                                <span class="nk-menu-text">Opérations de Caisse</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link">
                                                <span class="nk-menu-text">Point Journalier</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link">
                                                <span class="nk-menu-text">Facturations</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link">
                                                <span class="nk-menu-text">Bilan Assurance</span>
                                            </a>
                                        </li>
                                    </ul>
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
                                    <img class="logo-dark logo-img" src="{{ asset('assets/images/logo.jpg') }}" srcset="{{ asset('assets/images/logo.jpg') }} 2x">
                                </a>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown chats-dropdown">
                                        <span class="badge rounded-pill bg-info p-1">
                                            {{session('user_magasin')}}
                                        </span>
                                    </li>
                                    <li class="dropdown chats-dropdown">
                                        <a href="#" class="nk-quick-nav-icon">
                                            <div class="icon-status icon-status-info">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown user-dropdown"><a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm"><em class="icon ni ni-user-alt"></em></div>
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
                            <div class="nk-footer-copyright"> &copy; 2024 JOBOPTIQUE.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/app/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/bundlee1e3.js') }}"></script>
    <script src="{{ asset('assets/js/scriptse1e3.js') }}"></script>
    <script src="{{ asset('assets/js/demo-settingse1e3.js') }}"></script>
    <script src="{{ asset('assets/js/libs/datatable-btnse1e3.js') }}"></script>
    <script>$(document).ready(function () {urlHistorique(@json(Auth::user()->login));});</script>

</body>

</html>