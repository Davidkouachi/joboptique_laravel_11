@extends('pages.errors.app')

@section('titre', 'Page introuvable')

@section('content')

<div class="nk-content">
    <div class="nk-block nk-block-middle wide-xs mx-auto">
        <div class="nk-block-content nk-error-ld text-center">
            <h1 class="nk-error-head">403</h1>
            <h3 class="nk-error-title">Accès interdit</h3>
            <p class="nk-error-text">
                Désolé, vous n’avez pas les autorisations nécessaires pour accéder à cette page. 
                Veuillez contacter l’administrateur si vous pensez que c’est une erreur.
            </p>
            <a href="{{ route('tableau_bord') }}" class="btn btn-lg btn-primary mt-2">
                Retour au tableau de bord
            </a>
        </div>
    </div>
</div>

@endsection