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
                                <div class="card-title-group mb-3 border-bottom">
                                    <div class="card-title">
                                        <h5 class="nk-block-title">Statistique journalière</h5>
                                    </div>
                                    <div class="card-tools">
                                        <a class="btn btn-sm btn-icon btn-gray btn-dim mb-2" id="btn_refresh_stat_day">
                                            <em class="icon ni ni-reload" ></em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs mb-5 d-flex justify-content-center align-items-center" id="div_day"></div>
                    
                    <div class="row g-gs mb-2">
                        <div class="col-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="card-title-group mb-3 border-bottom">
                                    <div class="card-title">
                                        <h5 class="nk-block-title">Statistique globale</h5>
                                    </div>
                                    <div class="card-tools">
                                        <a class="btn btn-sm btn-icon btn-gray btn-dim mb-2" id="btn_refresh_stat_nbre">
                                            <em class="icon ni ni-reload" ></em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs mb-5" id="div_nbre"></div>

                    <div class="row g-gs mb-2">
                        <div class="col-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="card-title-group mb-3 border-bottom">
                                    <div class="card-title">
                                        <h5 class="nk-block-title">Ventes récentes (10 dernières)</h5>
                                    </div>
                                    <div class="card-tools">
                                        <a class="btn btn-sm btn-icon btn-gray btn-dim mb-2" id="btn_refresh_stat_table">
                                            <em class="icon ni ni-reload" ></em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs mb-5">
                        <div class="col-12">
                            <div class="card card-full" id="div_table" ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/app/js/statistique/tableau_bord/script_day.js')}}"></script>

@endsection