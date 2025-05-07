@extends('app')

@section('titre', 'Recherche Facture')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">

                    <div class="nk-block">
                        <div class="card" style="background: linear-gradient(to right, #FF4500, #FF8C00);">
                            <div class="card-inner">
                                <div class="card-title-group justify-content-center align-items-center">
                                    <div class="card-title d-flex justify-content-center align-items-center d-flex flex-column">
                                        <img class="rounded-circle border border-2 mb-2" height="50" width="50" src="{{ asset('assets/images/list_facture.jpg') }}">
                                        <h5 class="nk-block-title text-white">Recherche</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner mb-0">
                                <div class="card-bordered card-preview">
                                    <div class="card-inner">
                                        <div class="row g-gs">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Type de facture
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <select id="rech_type" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
                                                            <option selected value="0">
                                                                Tout
                                                            </option>
                                                            <option value="1">
                                                                Soldées
                                                            </option>
                                                            <option value="2">
                                                                Non-Soldées
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Magasin
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <select id="rech_magasin" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Du
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <input type="date" class="form-control" id="rech_date1" max="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Au
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <input type="date" class="form-control" id="rech_date2" max="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group text-center">
                                                    <a id="btn_rech" class="btn btn-md btn-outline-success">
                                                        <em class="icon ni ni-search"></em>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner">
                                <div class="card-bordered card-preview">
                                    <div class="row g-gs justify-content-center align-items-center text-center mt-0" id="donnee">
                                        <div class="col-md-4">
                                            <span class="badge badge-md bg-warning" id="total"></span>
                                        </div>
                                        <div class="col-md-4">
                                            <span class="badge badge-md bg-primary" id="part_assurance"></span>
                                        </div>
                                        <div class="col-md-4">
                                            <span class="badge badge-md bg-primary" id="part_client"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="badge badge-md bg-success" id="payer"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="badge badge-md bg-danger" id="non_payer"></span>
                                        </div>
                                    </div>
                                    <div class="card-inner">
                                        <table class="datatable-init table table_rech_fac" data-auto-responsive="true" style="overflow-x: auto; font-size: 12px;" >
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text"></span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Code Vente</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Nom et Prénoms</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Total</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Part Assurance</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Net à Payer</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Montant Payer</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Montant Restant</span>
                                                    </th>
                                                    <th class="nk-tb-col" >
                                                        <span class="sub-text">Date de création</span>
                                                    </th>
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

<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{ asset('assets/app/js/select.js') }}"></script>
<script src="{{ asset('assets/app/js/recherche.js') }}"></script>

@endsection