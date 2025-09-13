@extends('app')

@section('titre', 'Facture Proforma')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner" style="margin-top: -50px;">
                                <div id="formulaire_new_client" class="mt-5">
                                    <div class="card-inner">
                                        <ul class="nav nav-tabs nav-tabs-s2 mt-n3">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#liste">
                                                    <em class="icon ni ni-list"></em>
                                                    <span>Liste des factures</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#new">
                                                    <em class="icon ni ni-file"></em>
                                                    <span>Nouvelle Facture</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="new">
                                                <div class="card-title-group justify-content-center align-items-center mt-5">
                                                    <div class="card-title d-flex-column justify-content-center align-items-center text-center">
                                                        {{-- <img height="80px" width="80px" class="rounded-pill border border-1" src="{{ asset('assets/images/user8.png') }}" alt=""> --}}
                                                        <h4 class="title fw-normal">Formulaire</h4>
                                                    </div>
                                                </div>
                                                <form id="formulaire_proforma" class="mt-5">
                                                    <div class="card-inner mb-5">
                                                        <div class="row g-gs">
                                                            <div class="col-12" >
                                                                <div class="card-title-group">
                                                                    <div class="card-title">
                                                                        <h4 class="title fw-normal">Informations Client</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Nom & Prénoms
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-right">
                                                                            <em class="icon ni ni-user"></em>
                                                                        </div>
                                                                        <input type="text" class="form-control" id="nom" placeholder="Saisie Obligatoire">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Contact
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-right">
                                                                            <em class="icon ni ni-call"></em>
                                                                        </div>
                                                                        <input type="tel" class="form-control" id="tel" placeholder="Saisie Obligatoire">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Date
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="date" class="form-control" id="date" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-inner mb-5">
                                                        <div class="row g-gs">
                                                            <div class="col-12" >
                                                                <div class="card-title-group">
                                                                    <div class="card-title">
                                                                        <h4 class="title fw-normal">Préscriptions</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Sphère OD
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <select id="Sphere_OD" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Cylindre OD
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <select id="Cylindre_OD" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Axe OD
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <select id="Axe_OD" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Addition OD
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <select id="Addition_OD" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Sphère OG
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <select id="Sphere_OG" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Cylindre OG
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <select id="Cylindre_OG" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Axe OG
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <select id="Axe_OG" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Addition OG
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <select id="Addition_OG" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-inner mb-0">
                                                        <div class="row g-gs">
                                                            <div class="col-12" >
                                                                <div class="nk-block-between">
                                                                    <div class="nk-block-head-content">
                                                                        <div class="card-title">
                                                                            <h4 class="title fw-normal">Produit(s)</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="nk-block-head-content">
                                                                        <a class="btn btn-md btn-outline-primary" id="btn_ajouter">
                                                                            <span>Ajouter</span>
                                                                            <em class="icon ni ni-plus-circle"></em>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="contenu">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-inner mb-2">
                                                        <div class="row g-gs ">
                                                            <div class="col-12 ">
                                                                <div class="row d-flex flex-row-reverse" >
                                                                    <div class="col-md-5 col-lg-4" >
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend"> 
                                                                                        <span class="input-group-text">
                                                                                            Total
                                                                                        </span> 
                                                                                    </div> 
                                                                                    <input id="mTotal" readonly type="tel" class="form-control">
                                                                                    <div class="input-group-prepend"> 
                                                                                        <span class="input-group-text">
                                                                                            Fcfa
                                                                                        </span> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row d-flex flex-row-reverse" >
                                                                    <div class="col-md-5 col-lg-4" >
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <select id="remise" class="form-select js-select2" data-search="on" data-placeholder="Rémise">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row d-flex flex-row-reverse" >
                                                                    <div class="col-md-5 col-lg-4" >
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend"> 
                                                                                        <span class="input-group-text">
                                                                                            Net à payer
                                                                                        </span> 
                                                                                    </div> 
                                                                                    <input id="netPayer" readonly type="tel" class="form-control">
                                                                                    <div class="input-group-prepend"> 
                                                                                        <span class="input-group-text">
                                                                                            Fcfa
                                                                                        </span> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" id="div_btn" style="display: none;">
                                                                <div class="form-group text-center">
                                                                    <button type="submit" class="btn btn-md btn-outline-success">
                                                                        <span>Validé</span>
                                                                        <em class="icon ni ni-printer"></em>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane active" id="liste">
                                                {{-- <div class="card-title-group justify-content-center align-items-center mt-5">
                                                    <div class="card-title d-flex-column justify-content-center align-items-center text-center">
                                                        <img height="50px" width="50px" class="rounded-0 border border-0" src="{{ asset('assets/images/info_user.png') }}" alt="">
                                                        <h4 class="title fw-normal">Liste des Factures</h4>
                                                    </div>
                                                </div> --}}
                                                <div class="row g-gs mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Du
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input type="date" id="Date1" class="form-control me-1" value="{{ date('Y-m-d', strtotime('-3 months')) }}" max="{{ date('Y-m-d') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                au
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input type="date" id="Date2" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
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
                                                <div class="table-responsive datatable-wrap p-2 mt-5">
                                                    <table class="datatable-init table_proforma" data-auto-responsive="false" style="font-size:12px;" >
                                                        <thead>
                                                            <tr class="nk-tb-item nk-tb-head">
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text"></span>
                                                                </th>
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text">Code</span>
                                                                </th>
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text">Client</span>
                                                                </th>
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text">Contact</span>
                                                                </th>
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text">Valider</span>
                                                                </th>
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text">Date</span>
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

<script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

<script src="{{ asset('assets/app/plotly_3.1.0/dist/plotly.min.js') }}"></script>
<script src="{{ asset('assets/app/QRcode/qrcode.min.js') }}"></script>

<script src="{{asset('assets/app/jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('assets/app/jsPDF-AutoTable/dist/jspdf.plugin.autotable.min.js')}}"></script>
<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{asset('assets/app/js/select.js')}}"></script>
<script src="{{asset('assets/app/js/pdf/facture_proforma.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_proforma_all.js')}}"></script>
<script src="{{asset('assets/app/js/insert/facture_proforma.js')}}"></script>

@endsection