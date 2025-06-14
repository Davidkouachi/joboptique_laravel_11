@extends('app')

@section('titre', 'Facturation')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">

                    <div class="nk-block">
                        <div class="card" style="background: linear-gradient(to right, #4682B4, #87CEEB);">
                            <div class="card-inner">
                                <div class="card-title-group justify-content-center align-items-center">
                                    <div class="card-title d-flex justify-content-center align-items-center d-flex flex-column">
                                        <img class=" mb-1 p-0" height="50" width="50" src="{{ asset('assets/images/pdf2.png') }}">
                                        <h5 class="nk-block-title text-white">Facturations</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner">
                                {{-- <div class="card-title-group justify-content-center align-items-center mb-5">
                                    <div class="card-title d-flex flex-column justify-content-center align-items-center text-center">
                                        <img class="mb-2" height="130" width="130" src="{{ asset('assets/images/pdf2.png') }}">
                                        <h3 class="title">Facturation</h3>
                                    </div>
                                </div> --}}
                                <div class="card-inner card-bordered">
                                    <div class="row g-gs">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Facturation par
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select id="type" class="form-select js-select2">
                                                        <option selected value="assurance">Assurance</option>
                                                        <option value="client">Client</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6" id="div_assurance">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Assurance
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select id="assurance" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez une assurance">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6" id="div_client" style="display: none;">
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
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Du
                                                </label>
                                                <div class="form-control-wrap">
                                                    <input type="date" class="form-control" id="date1" max="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Au
                                                </label>
                                                <div class="form-control-wrap">
                                                    <input type="date" class="form-control" id="date2" max="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group text-center">
                                                <button id="btn_search" class="btn btn-md btn-outline-warning">
                                                    <em class="icon ni ni-search"></em>
                                                    <span>Rechercher</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive datatable-wrap p-2 mt-5" id="donnee" style="display: none;">
                                    <div class="d-flex justify-content-center align-items-center text-center">
                                        <span class="badge badge-md bg-warning" id="total"></span>
                                    </div>
                                    <table class="datatable-init table_facturation" data-auto-responsive="false" style="font-size:12px;" >
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text"></span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text">Nom & Prénoms</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text">Assurance</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text">Société</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text">Matricule assurance</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text">Part Assurance</span>
                                                </th>
                                                <th class="nk-tb-col" >
                                                    <span class="sub-text">Date de création</span>
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
<script src="{{asset('assets/app/js/pdf/facturation.js')}}"></script>
<script src="{{asset('assets/app/js/select.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_facturation_all.js')}}"></script>

@endsection