@extends('app')

@section('titre', 'Tableau de Bord')

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
                                    <img class="rounded-circle border border-2 mb-2" height="130" width="130" src="{{ asset('assets/images/caisse.jpg') }}">
                                    <h5 class="fw-bold mb-2 text-white" id="solde" style="display: none;" ></h5>
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
                                    <div class="col-xxl-6 col-12" >
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
                                    <div class="col-xxl-6 col-12" >
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
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/app/js/operation.js')}}"></script>
<script src="{{asset('assets/app/js/statistique/comptabilite/bilan.js')}}"></script>

@endsection