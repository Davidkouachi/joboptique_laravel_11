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
                            <div class="card-inner">
                                <div class="card-title-group justify-content-center align-items-center">
                                    <div class="card-title d-flex justify-content-center align-items-center text-center">
                                        <em class="icon ni ni-money h3 me-2"></em>
                                        <h4 class="title fw-normal">Encaissement</h4>
                                    </div>
                                </div>
                                <div class="row g-gs mb-5">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Client
                                            </label>
                                            <div class="form-control-wrap">
                                                <select id="client" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez un client">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-gs justify-content-center align-items-center text-center" id="donnee">
                                    <div class="col-md-4">
                                        <span class="badge badge-md bg-warning" id="total"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="badge badge-md bg-success" id="payer"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="badge badge-md bg-danger" id="non_payer"></span>
                                    </div>
                                </div>
                                <div class="card-preview mt-5">
                                    <div class="card-inner">
                                        <table class="datatable-init table table_facture_client" data-auto-responsive="true" style="overflow-x: auto; font-size: 12px;" >
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text"></span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Code</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Statut</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Total</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Part Assurance</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Part Client</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Taux réduction</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Reste à payer</span>
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

<div class="modal fade" tabindex="-1" id="modalLarge">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-inner">
                    <div class="team">
                        <div class="user-card user-card-s2">
                            <div class="user-avatar lg">
                                <img height="80px" width="80px" class="rounded-pill border border-1" src="{{ asset('assets/images/depot_fac.jpg') }}" alt="">
                            </div>
                            <div class="user-info">
                                <h6>Historique des Versements</h6>
                            </div>
                        </div>
                        <div class="p-2" style="max-height: 400px;" data-simplebar >
                            <ul class="text-center" id="contenu_versement">
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="Versement">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-inner">
                    <div class="team">
                        <div class="justify-content-center align-items-center text-center d-flex flex-column mb-5">
                            <img height="100px" width="100px" class="mb-3" src="{{ asset('assets/images/list_facture.jpg') }}" alt="">
                            <h6 class="title" >Versement</h6>
                        </div>
                        <input type="hidden" id="input_code">
                        <input type="hidden" id="input_matricule">
                        <div class="p-1">
                            <div class="row g-gs">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label class="form-label">
                                        Montant à payer
                                    </label>
                                    <div class="input-group">
                                        <div class="form-control-wrap">
                                            <input id="montant_payer" readonly type="tel" class="form-control">
                                            <div class="form-icon form-icon-right">
                                                <span>Fcfa</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label class="form-label">
                                        Montant Verser
                                    </label>
                                    <div class="input-group">
                                        <div class="form-control-wrap">
                                            <input id="montant_verser" type="tel" class="form-control" value="0">
                                            <div class="form-icon form-icon-right">
                                                <span>Fcfa</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label class="form-label">
                                        Montant restant
                                    </label>
                                    <div class="input-group">
                                        <div class="form-control-wrap">
                                            <input id="montant_restant" readonly type="tel" class="form-control" value="0">
                                            <div class="form-icon form-icon-right">
                                                <span>Fcfa</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label class="form-label">
                                        Observation
                                    </label>
                                    <div class="input-group">
                                        <div class="form-control-wrap">
                                            <input id="obs" type="text" class="form-control" placeholder="Facultatif">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label class="form-label">
                                        Encaisser par 
                                    </label>
                                    <div class="input-group">
                                        <div class="form-control-wrap">
                                            <input readonly type="text" class="form-control" value="{{ Auth::user()->login }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label class="form-label">
                                        Date livraison
                                    </label>
                                    <div class="input-group">
                                        <div class="form-control-wrap">
                                            <input id="date_livraison" type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" id="div_btn">
                                    <div class="form-group text-center">
                                        <button id="btn_vers" class="btn btn-lg btn-outline-success">
                                            <span>Valider</span>
                                            <em class="icon ni ni-check-circle"></em>
                                        </button>
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

<script src="{{asset('assets/app/jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('assets/app/jsPDF-AutoTable/dist/jspdf.plugin.autotable.min.js')}}"></script>
<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{asset('assets/app/js/select.js')}}"></script>
<script src="{{asset('assets/app/js/pdf/facture_vente.js')}}"></script>
<script src="{{asset('assets/app/js/pdf/recu_paiement.js')}}"></script>
<script src="{{asset('assets/app/js/operation.js')}}"></script>
<script src="{{asset('assets/app/js/enciassement.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_facture_client.js')}}"></script>

@endsection