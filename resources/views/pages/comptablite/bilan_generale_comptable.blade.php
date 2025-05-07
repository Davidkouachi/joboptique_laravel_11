@extends('app')

@section('titre', 'Bilan Comptable')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                {{-- <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between d-flex flex-column mb-3 justify-content-center align-items-center">
                        <div class="nk-block-head-content">
                            <img height="100" width="auto" src="{{ asset('assets/images/bilan-comptable2.jpg') }}">
                        </div>
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Tableau de bord</h3>
                        </div>
                    </div>
                </div> --}}

                <div class="nk-block">
                    <div class="card" style="background: linear-gradient(to right, #87CEEB, #4682B4);">
                        <div class="card-inner">
                            <div class="card-title-group justify-content-center align-items-center">
                                <div class="card-title d-flex justify-content-center align-items-center d-flex flex-column">
                                    <img class="rounded-circle border border-2 mb-2" height="100" width="100" src="{{ asset('assets/images/caisse.jpg') }}">
                                    <h5 class="fw-bold mb-2 text-white" id="solde" style="display: none;" ></h5>
                                    <ul class="preview-list g-1 mb-2" id="chargement" style="display: none;">
                                        <li class="preview-item"> 
                                            <button class="btn btn-warning" type="button" disabled> 
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
                                                <span>Vérification en cours ...</span> 
                                            </button> 
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="nk-block" id="div_operation" style="display: none;"></div> --}}

                <div class="nk-block">
                    <div class="row g-gs mb-5" id="div_op">
                        <div class="col-12">
                            <div class="card"> 
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-3">
                                            <div class="card-title">
                                                <h6 class="title">Tendances des Opérations de caisse</h6>
                                            </div>
                                            <div class="card-tools">
                                                <select id="anne_op" class="form-select js-select2" data-search="on">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-title-group justify-content-center align-items-center" id="div_graph_op_message">
                                            <div class="card-title d-flex justify-content-center align-items-center">
                                                <div class="spinner-border text-warning me-1" role="status"></div>
                                                <h6 class="title text-warning">
                                                    Veuillez patienter s'il vous plaît ...
                                                </h6>
                                            </div>
                                        </div>
                                        <div id="contenu_graph_op" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card" style="background: linear-gradient(to right, #FF4500, #FFA500);"> 
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-3">
                                            <div class="card-title">
                                                <h6 class="title text-white">Evaluation des Ventes</h6>
                                            </div>
                                            <div class="card-tools">
                                                <select id="anne_eva_vente" class="form-select js-select2" data-search="on">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-title-group justify-content-center align-items-center" id="div_graph_eva_vente_message">
                                            <div class="card-title d-flex justify-content-center align-items-center">
                                                <div class="spinner-border text-white me-1" role="status"></div>
                                                <h6 class="title text-white">
                                                    Veuillez patienter s'il vous plaît ...
                                                </h6>
                                            </div>
                                        </div>
                                        <div id="contenu_graph_eva_vente" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-3">
                                            <div class="card-title">
                                                <h6 class="title">Tendances des ventes</h6>
                                            </div>
                                            <div class="card-tools">
                                                <select id="anne_vente" class="form-select js-select2" data-search="on">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-title-group justify-content-center align-items-center" id="div_vente_message">
                                            <div class="card-title d-flex justify-content-center align-items-center">
                                                <div class="spinner-border text-warning me-1" role="status"></div>
                                                <h6 class="title text-warning">
                                                    Veuillez patienter s'il vous plaît ...
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row g-gs" id="contenu_graph_vente" >
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="row g-gs" >
                                    <div class="col-12" >
                                        <div class="card-inner">
                                            <div class="card-title-group mb-3">
                                                <div class="card-title">
                                                    <h6 class="title">Estimation & Rapport des ventes</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <select id="magasin_estimation_vente" class="form-select js-select2" data-search="on" data-placeholder="Agence">
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12" >
                                        <div class="card-inner">
                                            <div class="card-title-group mb-3">
                                                <div class="card-title">
                                                    <h6 class="title">Estimation des ventes de l'année en cours 
                                                        (<script>
                                                        document.write(new Date().getFullYear())
                                                        </script>)
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="card-title-group justify-content-center align-items-center" id="div_vente_prevision_message1">
                                                <div class="card-title d-flex justify-content-center align-items-center">
                                                    <div class="spinner-border text-warning me-1" role="status"></div>
                                                    <h6 class="title text-warning">
                                                        Veuillez patienter s'il vous plaît ...
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="row g-gs mb-3" id="contenu_graph_vente_prevision1" ></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12" >
                                        <div class="card-inner">
                                            <div class="card-title-group mb-3">
                                                <div class="card-title">
                                                    <h6 class="title">Rapport des ventes de l'année en cours 
                                                        (<script>
                                                        document.write(new Date().getFullYear())
                                                        </script>)
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="card-title-group justify-content-center align-items-center" id="div_vente_prevision_message2">
                                                <div class="card-title d-flex justify-content-center align-items-center">
                                                    <div class="spinner-border text-warning me-1" role="status"></div>
                                                    <h6 class="title text-warning">
                                                        Veuillez patienter s'il vous plaît ...
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="row g-gs mb-3" id="contenu_graph_vente_prevision2" ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card" style="background: linear-gradient(to right, #4682B4, #3498DB);">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-3">
                                            <div class="card-title">
                                                <h6 class="title text-white">Statistique des nouveaux Clients</h6>
                                            </div>
                                            <div class="card-tools">
                                                <select id="anne_client" class="form-select js-select2" data-search="on">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-title-group justify-content-center align-items-center" id="div_client_message">
                                            <div class="card-title d-flex justify-content-center align-items-center">
                                                <div class="spinner-border text-white me-1" role="status"></div>
                                                <h6 class="title text-white">
                                                    Veuillez patienter s'il vous plaît ...
                                                </h6>
                                            </div>
                                        </div>
                                        <div id="contenu_graph_client" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs mb-5" >
                        <div class="col-12" >
                            <div class="card card-full">
                                <div class="nk-ecwg nk-ecwg8">
                                    <div class="card-inner">
                                        <div class="card-title-group justify-content-center align-items-center">
                                            <div class="card-title">
                                                <h6 class="title">Détails par périodes</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-inner">
                                        <div class="card-title-group d-flex flex-column justify-content-center align-items-center">
                                            <div class="d-flex mb-1">
                                                <div class="form-group me-3">
                                                    <select id="magasin_d_vente" class="form-select js-select2" data-search="on">
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="month" class="form-control" id="periode" max="{{ date('Y-m')}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a class="btn btn-dim btn-outline-warning" id="btn_search_vente_d">
                                                    <em class="icon ni ni-search" ></em>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs mb-5" id="div_d_vente"></div>
                    <div class="row g-gs mb-5" >
                        <div class="col-12" >
                            <div class="card card-full">
                                <div class="card-inner" style="margin-top: -50px;">
                                    <div id="formulaire_new_client" class="mt-5">
                                        <div class="card-inner">
                                            <div class="card-title-group justify-content-center align-items-center">
                                                <div class="card-title">
                                                    <h6 class="title">Lises de opérations de caisse par périodes</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-inner">
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
<script src="{{asset('assets/app/js/list/list_operation_G.js')}}"></script>
<script src="{{asset('assets/app/js/statistique/comptabilite/generale.js')}}"></script>

@endsection