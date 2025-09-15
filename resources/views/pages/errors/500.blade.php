@extends('pages.errors.app')

@section('titre', 'Page introuvable')

@section('content')

<div class="nk-content">
    <div class="nk-block nk-block-middle wide-xs mx-auto">
        <div class="nk-block-content nk-error-ld text-center">
            <h1 class="nk-error-head">500</h1>
            <h3 class="nk-error-title">Erreur interne du serveur</h3>
            <p class="nk-error-text">
                Oups ! Quelque chose s’est mal passé sur le serveur. 
                Nous travaillons à résoudre le problème. Veuillez réessayer plus tard.
            </p>
            <a href="{{ route('tableau_bord') }}" class="btn btn-lg btn-primary mt-2">
                Retour au tableau de bord
            </a>
        </div>
    </div>
</div>


@endsection