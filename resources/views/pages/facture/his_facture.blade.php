@extends('app')

@section('titre', 'Historiques des factures')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">

                    <div class="nk-block">
                        <div class="card" style="background: linear-gradient(to right, #87CEEB, #4682B4);">
                            <div class="card-inner">
                                <div class="card-title-group justify-content-center align-items-center">
                                    <div class="card-title d-flex justify-content-center align-items-center d-flex flex-column">
                                        <img class="rounded-circle mb-1 p-0" height="130" width="130" src="{{ asset('assets/images/list_facture.jpg') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner">
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
                                <div class="row g-gs justify-content-center align-items-center text-center" id="donnee" style="display: none;">
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
                                <div class="card-preview mt-5" id="donnee2" style="display: none;">
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

<script src="{{asset('assets/app/jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('assets/app/jsPDF-AutoTable/dist/jspdf.plugin.autotable.min.js')}}"></script>
<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{asset('assets/app/js/select.js')}}"></script>
<script src="{{asset('assets/app/js/pdf/facture_vente.js')}}"></script>
<script src="{{asset('assets/app/js/pdf/recu_paiement.js')}}"></script>
<script src="{{asset('assets/app/js/his_facture.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_facture_client.js')}}"></script>

@endsection