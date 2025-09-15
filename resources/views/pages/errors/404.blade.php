@extends('pages.errors.app')

@section('titre', 'Page introuvable')

@section('content')

<div class="nk-content">
    <div class="nk-block nk-block-middle wide-xs mx-auto">
        <div class="nk-block-content nk-error-ld text-center">
            <h1 class="nk-error-head">404</h1>
            <h3 class="nk-error-title">Oups ! Page introuvable</h3>
            <p class="nk-error-text">
                Désolé pour le dérangement. Il semble que la page que vous cherchez a été supprimée ou n’a jamais existé.
            </p>
            <a href="{{ route('tableau_bord') }}" class="btn btn-lg btn-primary mt-2">
                Retour à l’accueil
            </a>
        </div>
    </div>
</div>

@endsection