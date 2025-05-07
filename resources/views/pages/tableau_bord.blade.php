@extends('app')

@section('titre', 'Tableau de Bord')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs mb-2">
                        <div class="col-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between justify-content-center align-items-center border-bottom pb-2">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Statistique journalière</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs mb-5" id="div_day">
                        <div class="col-12" id="div_day_message">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group justify-content-center align-items-center">
                                            <div class="card-title d-flex justify-content-center align-items-center">
                                                <div class="spinner-border text-warning me-1" role="status"></div>
                                                <h6 class="title text-warning">
                                                    Veuillez patienter s'il vous plaît ...
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs mb-2">
                        <div class="col-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between justify-content-center align-items-center border-bottom pb-2">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Statistique globale</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs mb-5" id="div_nbre">
                        <div class="col-12" id="div_nbre_message">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group justify-content-center align-items-center">
                                            <div class="card-title d-flex justify-content-center align-items-center">
                                                <div class="spinner-border text-warning me-1" role="status"></div>
                                                <h6 class="title text-warning">
                                                    Veuillez patienter s'il vous plaît ...
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs mb-2">
                        <div class="col-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between justify-content-center align-items-center border-bottom pb-2">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Ventes récentes (10 dernières)</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs mb-5">
                        <div class="col-12">
                            <div class="card card-full">
                                <div class="card-inner mb-3" id="div_table_message">
                                    <div class="card-title-group justify-content-center align-items-center">
                                        <div class="card-title d-flex justify-content-center align-items-center">
                                            <div class="spinner-border text-warning me-1" role="status"></div>
                                            <h6 class="title text-warning">
                                                Veuillez patienter s'il vous plaît ...
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-list mt-2" id="div_table" style="display: none;">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col">
                                            <span>Code vente</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span>Client</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span>Date</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span>Montant Total</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="d-none d-sm-inline">Statut</span>
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

<script src="{{asset('assets/app/js/statistique/tableau_bord/script_day.js')}}"></script>

@endsection