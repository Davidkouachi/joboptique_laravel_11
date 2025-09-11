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

                    <div class="card card-bordered card-preview mb-4">
                        <div class="card-inner">
                            <div class="py-2">
                                <div id="div_nbre" class="slider-init" data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "infinite":true, "responsive":[ {"breakpoint": 1500,"settings":{"slidesToShow": 3}},{"breakpoint": 892,"settings":{"slidesToShow": 2}}, {"breakpoint": 582,"settings":{"slidesToShow": 1}} ]}'>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row g-gs mb-5" id="div_nbre"></div> --}}

                    <div class="row g-gs mb-5" >
                        <div class="col-12" >
                            <div class="card">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Rapport Proformas & Ventes 
                                                (<script>
                                                    document.write(new Date().getFullYear())
                                                </script>)
                                            </h6>
                                        </div>
                                        <div class="card-tools">
                                            <a class="btn btn-sm btn-icon btn-gray btn-dim mb-2" id="btn_refresh_stat_vente_proforma">
                                                <em class="icon ni ni-reload" ></em>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner d-flex justify-content-center align-items-center" style="height: 400px;" id="graph_vente_proforma_parent">
                                    <div class="mb-3" id="graph_vente_proforma"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-6" >
                            <div class="card">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Opérations de caisse (Semaine du {{ \Carbon\Carbon::now()->startOfWeek()->format('d/m/Y') }})</h6>
                                        </div>
                                        <div class="card-tools">
                                            <a class="btn btn-sm btn-icon btn-gray btn-dim mb-2" id="btn_refresh_stat_hisOp">
                                                <em class="icon ni ni-reload" ></em>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-title-group d-flex justify-content-center mb-n3">
                                        <a href="{{ route('operation') }}" class="btn btn-white btn-sm btn-warning btn-dim">
                                            Voir plus
                                        </a>
                                    </div>
                                </div>
                                <div class="card-inner" style="height: 377px;" data-simplebar="">
                                    <div class="timeline text-center" id="div_his_op"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-6" >
                            <div class="card">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Rapport caisse 
                                                (<script>
                                                    document.write(new Date().getFullYear())
                                                </script>)
                                            </h6>
                                        </div>
                                        <div class="card-tools">
                                            <a class="btn btn-sm btn-icon btn-gray btn-dim mb-2" id="btn_refresh_stat_raport_vente">
                                                <em class="icon ni ni-reload" ></em>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner d-flex justify-content-center align-items-center " style="height: 400px;">
                                    <div class="row g-gs mb-3" id="graph_rapport_caisse"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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
                    <div class="row g-gs mb-5" >
                        <div class="col-12">
                            <div class="card-full" id="div_table" ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script src="{{asset('assets/app/js/statistique/tableau_bord/script_day.js')}}"></script> --}}
<script src="{{asset('assets/app/js/statistique/tableau_bord/script_day_V2.js')}}"></script>

<script src="assets/js/charts/chart-analyticse1e3.js"></script>

@endsection