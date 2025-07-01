@extends('app')

@section('titre', 'Clients')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner" style="margin-top: -50px;">
                                <div id="formulaire_new_client" class="mt-5">
                                    <div class="card-inner">
                                        <ul class="nav nav-tabs nav-tabs-s2 mt-n3">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#liste">
                                                    <em class="icon ni ni-list"></em>
                                                    <span>Liste des clients</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#new">
                                                    <em class="icon ni ni-user"></em>
                                                    <span>Nouveau Client</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="new">
                                                <div class="card-title-group justify-content-center align-items-center mt-5">
                                                    <div class="card-title d-flex-column justify-content-center align-items-center text-center">
                                                        {{-- <img height="80px" width="80px" class="rounded-pill border border-1" src="{{ asset('assets/images/user8.png') }}" alt=""> --}}
                                                        <h4 class="title fw-normal">Nouveau Client</h4>
                                                    </div>
                                                </div>
                                                <form id="formulaire_new_client" class="mt-5">
                                                    <div class="row g-gs">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Nom
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-user"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="nom" placeholder="Saisie Obligatoire">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Prénoms
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-user"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="prenoms" placeholder="Saisie Obligatoire">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Né(e) le
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input type="date" class="form-control" id="datenais" placeholder="Saisie Obligatoire">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    sexe
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <select id="sexe" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
                                                                        <option value=""></option>
                                                                        <option value="M">
                                                                            Masculin
                                                                        </option>
                                                                        <option value="F">
                                                                            Féminin
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Profession
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-article"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="profession" placeholder="Facultatif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Résidence
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-home"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="residence" placeholder="Facultatif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Contact
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-call"></em>
                                                                    </div>
                                                                    <input type="tel" class="form-control" id="tel1" placeholder="Saisie Obligatoire">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Contact 2
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-call"></em>
                                                                    </div>
                                                                    <input type="tel" class="form-control" id="tel2" placeholder="Facultatif">
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Email
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-mail"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="email" placeholder="Facultatif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Sondage
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <select id="sondage" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
                                                                        <option value=""></option>
                                                                        <option value="Ancien Client">
                                                                            Ancien Client
                                                                        </option>
                                                                        <option value="Nouveau Client">
                                                                            Nouveau Client
                                                                        </option>
                                                                        <option value="Bouche à oreille">
                                                                            Bouche à oreille
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Réseaux Sociaux
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-globe"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="reseau_sociaux" placeholder="Facultatif">
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Commercial
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <select id="commercial" class="form-select js-select2" data-search="on">
                                                                        <option selected value="0">
                                                                            Attribuer le prospect à un commercial
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Assurer ?
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <select id="assurer" class="form-select js-select2" data-placeholder="Selectionnez">
                                                                        <option selected value="0">Non</option>
                                                                        <option value="1">Oui</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-gs mt-1" id="div_assurer" style="display: none;">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Assurance
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <select id="assurance_id" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Société
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <select id="societe_id" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Taux
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <select id="taux_id" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Matricule Assurance
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-scan"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="matricule" placeholder="Facultatif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-gs mt-1">
                                                        <div class="col-md-12">
                                                            <div class="form-group text-center">
                                                                <button type="submit" class="btn btn-md btn-outline-success">
                                                                    <span>Validé</span>
                                                                    <em class="icon ni ni-check"></em>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane active" id="liste">
                                                <div class="card-title-group justify-content-center align-items-center mt-5">
                                                    <div class="card-title d-flex-column justify-content-center align-items-center text-center">
                                                        {{-- <img height="50px" width="50px" class="rounded-0 border border-0" src="{{ asset('assets/images/info_user.png') }}" alt=""> --}}
                                                        <h4 class="title fw-normal">Liste des Clients</h4>
                                                    </div>
                                                </div>
                                                <div class="table-responsive datatable-wrap p-2 mt-5">
                                                    <table class="datatable-init table_client" data-auto-responsive="false" style="font-size:12px;" >
                                                        <thead>
                                                            <tr class="nk-tb-item nk-tb-head">
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text"></span>
                                                                </th>
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text">Client</span>
                                                                </th>
                                                                {{-- <th class="nk-tb-col" >
                                                                    <span class="sub-text">Matricule</span>
                                                                </th>
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text">Nom et Prénoms</span>
                                                                </th> --}}
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text">Contact</span>
                                                                </th>
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text">Assurer ?</span>
                                                                </th>
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text">Date de création</span>
                                                                </th>
                                                                <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        </tbody>
                                                    </table>
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
    </div>
</div>

<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_user_all.js')}}"></script>
<script src="{{asset('assets/app/js/select.js')}}"></script>
<script src="{{asset('assets/app/js/insert/client.js')}}"></script>

@endsection