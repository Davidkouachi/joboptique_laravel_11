@extends('app')

@section('titre', 'Préscription')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">

                    <div class="nk-block">
                        <div class="" style="background-color: transparent;">
                            <div class="card-inner">
                                <div class="card-title-group justify-content-center align-items-center">
                                    <div class="card-title d-flex justify-content-center align-items-center d-flex flex-column">
                                        <img class="rounded-circle border border-1 mb-2" height="130" width="130" src="{{ asset('assets/images/caisse.jpg') }}">
                                        <h5 class="fw-bold mb-2" id="solde" style="display: none;" ></h5>
                                        <a class="btn btn-danger mb-2" id="btn_fermer" style="display: none;">
                                            <span>Fermer la Caisse</span>
                                            <em class="icon ni ni-lock" ></em>
                                        </a>
                                        <a class="btn btn-success mb-2" id="btn_ouvert" style="display: none;">
                                            <span>Ouvrir la Caisse</span>
                                            <em class="icon ni ni-unlock" ></em>
                                        </a>
                                        <ul class="preview-list g-1 mb-2" id="chargement" style="display: none;">
                                            <li class="preview-item"> 
                                                <button class="btn btn-warning" type="button" disabled> 
                                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
                                                    <span>Vérification en cours ...</span> 
                                                </button> 
                                            </li>
                                        </ul>
                                        <h5 class="fw-bold mb-2 text-danger" id="message" style="display: none;" >
                                            Une erreur est survenue lors de l'operation'. veuillez actualiser la page s'il vous plaît
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block" id="div_operation" style="display: none;">
                        <div class="card">
                            <div class="card-inner" style="margin-top: -50px;">
                                <div id="formulaire_new_client" class="mt-5">
                                    <div class="card-inner">
                                        <ul class="nav nav-tabs nav-tabs-s2 mt-n3">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#new">
                                                    <em class="icon ni ni-file"></em>
                                                    <span>Nouvelle Opération</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#liste">
                                                    <em class="icon ni ni-list"></em>
                                                    <span>Liste des Opérations</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="new">
                                                <div class="card-title-group justify-content-center align-items-center mt-5">
                                                    <div class="card-title d-flex-column justify-content-center align-items-center text-center">
                                                        {{-- <img height="80px" width="80px" class="rounded-pill border border-1" src="{{ asset('assets/images/user8.png') }}" alt=""> --}}
                                                        <h4 class="title fw-normal">Nouvelle Opération</h4>
                                                    </div>
                                                </div>
                                                <form id="formulaire_operation" class="mt-5">
                                                    <div class="row g-gs">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Motif
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="motif" placeholder="Saisir Obligatoire">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Montant
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="input-group">
                                                                        <input type="tel" class="form-control" id="montant" value="0">
                                                                        <div class="input-group-prepend"> 
                                                                            <span class="input-group-text">
                                                                                Fcfa
                                                                            </span> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Type
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <select id="type" class="form-select js-select2" data-placeholder="Selectionnez">
                                                                        <option></option>
                                                                        <option value="entree">
                                                                            Entrer d'argent
                                                                        </option>
                                                                        <option value="sortie">
                                                                            Sortie d'argent
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Date de l'opération
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input type="datetime-local" class="form-control" id="dateop" max="{{ date('Y-m-d\TH:i') }}" value="{{ date('Y-m-d\TH:i') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group text-center">
                                                                <button type="submit" class="btn btn-lg btn-outline-success">
                                                                    <span>Validé</span>
                                                                    <em class="icon ni ni-check-circle"></em>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="liste">
                                                <div class="row g-gs mb-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Du
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input type="date" id="Date1"  class="form-control me-1" value="{{ date('Y-m-d', strtotime('-1 months')) }}" max="{{ date('Y-m-d') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                au
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input type="date" id="Date2" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Magasin
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <select id="magasin_id" class="form-select js-select2">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <div class="form-group text-center">
                                                            <a class="btn btn-md btn-outline-success" id="btn_search">
                                                                <em class="icon ni ni-search"></em>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-gs justify-content-center align-items-center text-center" id="donnee">
                                                    <div class="col-md-4">
                                                        <span class="badge badge-md bg-warning" id="total"></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span class="badge badge-md bg-success" id="entrer"></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span class="badge badge-md bg-danger" id="sortie"></span>
                                                    </div>
                                                </div>
                                                <div class="card-bordered card-preview mt-5">
                                                    <div class="card-inner">
                                                        <table class="datatable-init table table_operation" data-auto-responsive="true" style="overflow-x: auto; font-size: 12px;" >
                                                            <thead>
                                                                <tr class="nk-tb-item nk-tb-head">
                                                                    <th class="nk-tb-col" >
                                                                        <span class="sub-text"></span>
                                                                    </th>
                                                                    <th class="nk-tb-col" >
                                                                        <span class="sub-text">Type</span>
                                                                    </th>
                                                                    <th class="nk-tb-col" >
                                                                        <span class="sub-text">Montant</span>
                                                                    </th>
                                                                    <th class="nk-tb-col" >
                                                                        <span class="sub-text">Créer par</span>
                                                                    </th>
                                                                    <th class="nk-tb-col" >
                                                                        <span class="sub-text">Agence</span>
                                                                    </th>
                                                                    <th class="nk-tb-col" >
                                                                        <span class="sub-text">Date opération</span>
                                                                    </th>
                                                                    <th class="nk-tb-col" >
                                                                        <span class="sub-text">Date création</span>
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
</div>

<div class="modal fade" tabindex="-1" id="modalLarge">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            {{-- <div class="modal-body"> --}}
                <div class="card">
                    <div class="card-inner">
                        <div class="team">
                            <div class="user-card user-card-s2">
                                <div class="user-avatar lg">
                                    <img height="80px" width="80px" class="rounded-pill border border-1" src="{{ asset('assets/images/factures.jpg') }}" alt="">
                                </div>
                                <div class="user-info">
                                    <h6 id="d_creer_par" ></h6> 
                                    <span class="sub-text" id="d_datecreat"></span>
                                </div>
                            </div>
                            <div class="p-2" style="max-height: 400px;" data-simplebar >
                                <ul class="team-info">
                                    <li><span>Numéro d'opération</span><span id="d_num" ></span></li>
                                    <li><span>Type</span><span id="d_type" ></span></li>
                                    <li><span>Motif</span><span id="d_motif"></span></li>
                                    <li><span>Montant</span><span id="d_montant" ></span></li>
                                    <li><span>Magasin</span><span id="d_magasin" ></span></li>
                                    <li><span>Date d'opération</span><span id="d_dateop" ></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>

<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{asset('assets/app/js/select.js')}}"></script>
<script src="{{asset('assets/app/js/operation.js')}}"></script>
<script src="{{asset('assets/app/js/insert/operation.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_operation_all.js')}}"></script>

@endsection