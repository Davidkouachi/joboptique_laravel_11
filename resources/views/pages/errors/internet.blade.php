@extends('pages.errors.app')

@section('titre', 'Connexion internet')

@section('content')

<div class="nk-content ">
    <div class="nk-block nk-block-middle wide-md mx-auto">
        <div class="nk-block-content nk-error-ld text-center">
            <img style="margin-top: -200px; margin-bottom: -100px;" class="nk-error-gfx" src="{{ asset('assets/images/disconnect.avif') }}">
            <div class="wide-xs mx-auto mt-n5">
                <h3 class="nk-error-title">
                    📡 Pas de connexion Internet
                </h3>
                <p class="nk-error-text">
                    Il semble que votre connexion Internet soit interrompue. Veuillez vérifier votre connexion Internet ou revenez plus tard.
                </p>
                <a class="btn btn-lg btn-round btn-dim btn-outline-secondary mt-2" href="#">
                    <span>Réssayer</span>
                    <em class="icon ni ni-reload"></em>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection