@extends('app')

@section('titre', 'Profil')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card mb-3" style="background: linear-gradient(to right, #00008B, #1565C0);">
                        <div class="card-inner">
                            <div class="team">
                                <div class="user-card user-card-s2">
                                    <div class="user-avatar md border border-white border-3" style="background: transparent;">
                                        <em class="ni ni-user" ></em>
                                        <div class="status dot dot-lg dot-success"></div>
                                    </div>
                                    <div class="user-info">
                                        <h6 class="text-white" >{{ Auth::user()->name }}</h6> 
                                        <span class="sub-text text-white">{{ Auth::user()->login }}</span>
                                    </div>
                                </div>
                                <ul class="team-statistics">
                                    <li>
                                        <span class="text-white" >Agence</span>
                                        <span class="text-white" >{{session('user_magasin')}}</span>
                                    </li>
                                    <li>
                                        <span class="text-white" >Département</span>
                                        <span class="text-white" >{{session('user_service')}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head nk-block-head-lg">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">
                                                Informations Personnels
                                            </h4>
                                            <div class="nk-block-des">
                                                <p>
                                                    Informations de base, comme votre Nom et votre Login
                                                </p>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content align-self-start d-lg-none">
                                            <a class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside" href="#">
                                                <em class="icon ni ni-menu-alt-r">
                                                </em>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block">
                                    <div class="nk-data data-list">
                                        <div class="data-head">
                                            <h6 class="overline-title">
                                                Basics
                                            </h6>
                                        </div>
                                        <div class="data-item" data-bs-target="#profile-edit" data-bs-toggle="modal">
                                            <div class="data-col">
                                                <span class="data-label">
                                                    Nom
                                                </span>
                                                <span class="data-value">
                                                    {{ Auth::user()->name }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="data-item" data-bs-target="#profile-edit" data-bs-toggle="modal">
                                            <div class="data-col">
                                                <span class="data-label">
                                                    Login
                                                </span>
                                                <span class="data-value">
                                                    {{ Auth::user()->login }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="data-item" data-bs-target="#profile-edit" data-bs-toggle="modal">
                                            <div class="data-col">
                                                <span class="data-label">
                                                    Contact
                                                </span>
                                                <span class="data-value">
                                                    @if(Auth::user()->tel)
                                                        {{Auth::user()->tel}}
                                                    @else
                                                        Aucun
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="data-item" data-bs-target="#profile-edit" data-bs-toggle="modal">
                                            <div class="data-col">
                                                <span class="data-label">
                                                    Agence
                                                </span>
                                                <span class="data-value">
                                                    {{session('user_magasin')}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="data-item" data-bs-target="#profile-edit" data-bs-toggle="modal" data-tab-target="#address">
                                            <div class="data-col">
                                                <span class="data-label">
                                                    Département
                                                </span>
                                                <span class="data-value">
                                                    {{session('user_service')}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">
                                                    Statut
                                                </span>
                                                @if(session('user_actif') == 1)
                                                    <span class="data-value text-success">Actif</span>
                                                @else
                                                    <span class="data-value text-danger">Inactif</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-data data-list">
                                        <div class="data-head">
                                            <h6 class="overline-title">
                                                Paramètrage
                                            </h6>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">
                                                    Language
                                                </span>
                                                <span class="data-value">
                                                    {{ config('app.language') }}
                                                </span>
                                            </div>
                                            {{-- <div class="data-col data-col-end">
                                                <a class="link link-primary" href="#">
                                                    Change Language
                                                </a>
                                            </div> --}}
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">
                                                    Date Format
                                                </span>
                                                <span class="data-value">
                                                    {{ config('app.FormatDate') }}
                                                </span>
                                            </div>
                                            {{-- <div class="data-col data-col-end">
                                                <a class="link link-primary" href="#">
                                                    Change
                                                </a>
                                            </div> --}}
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">
                                                    Timezone
                                                </span>
                                                <span class="data-value">
                                                    {{ config('app.timezone') }}
                                                </span>
                                            </div>
                                            {{-- <div class="data-col data-col-end">
                                                <a class="link link-primary" href="#">
                                                    Change
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection