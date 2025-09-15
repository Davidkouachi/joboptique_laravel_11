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
                                        <img class="rounded-circle mb-1 p-0" height="50" width="50" src="{{ asset('assets/images/list_facture.jpg') }}">
                                        <h5 class="nk-block-title text-white">Historiques des factures</h5>
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
                                <div class="table-responsive datatable-wrap p-2 mt-5" id="donnee2" style="display: none;">
                                    <table class="datatable-init table_facture_client" data-auto-responsive="false" style="font-size:12px;" >
                                        <thead class="bg-azure" >
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text text-white"></span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text text-white">Code</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text text-white">Statut</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text text-white">Total</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text text-white">Part Assurance</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text text-white">Part Client</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text text-white">Taux réduction</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text text-white">Reste à payer</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text text-white">Date création</span>
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

<script src="{{asset('assets/app/jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('assets/app/jsPDF-AutoTable/dist/jspdf.plugin.autotable.min.js')}}"></script>
<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{asset('assets/app/js/select.js')}}"></script>
<script src="{{asset('assets/app/js/pdf/facture_vente.js')}}"></script>
<script src="{{asset('assets/app/js/pdf/recu_paiement.js')}}"></script>
<script src="{{asset('assets/app/js/his_facture.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_facture_client.js')}}"></script>

@endsection