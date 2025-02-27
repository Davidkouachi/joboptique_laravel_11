@extends('app')

@section('titre', 'Facture Vente')

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
                                                <a class="nav-link active" data-bs-toggle="tab" href="#new">
                                                    <em class="icon ni ni-file"></em>
                                                    <span>Nouvelle Vente</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#liste">
                                                    <em class="icon ni ni-list"></em>
                                                    <span>Liste des Ventes</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="new">
                                                <div class="card-title-group justify-content-center align-items-center mt-5">
                                                    <div class="card-title d-flex-column justify-content-center align-items-center text-center">
                                                        {{-- <img height="80px" width="80px" class="rounded-pill border border-1" src="{{ asset('assets/images/user8.png') }}" alt=""> --}}
                                                        <h4 class="title fw-normal">Vente</h4>
                                                    </div>
                                                </div>
                                                <form id="formulaire_vente" class="mt-5">
                                                    <div class="card-inner border border-1 rounded mb-5">
                                                        <div class="row g-gs">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Nom & Prénoms
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-control-wrap">
                                                                            <select id="client" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez un client">
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Taux couverture
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" id="taux" readonly>
                                                                            <div class="input-group-prepend"> 
                                                                                <span class="input-group-text">
                                                                                    %
                                                                                </span> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Utiliser l'assurance ?
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <select id="choix_assurance" class="form-select js-select2">
                                                                            <option selected value="0">
                                                                                Non
                                                                            </option>
                                                                            <option value="1">
                                                                                Oui
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">
                                                                        Date de la facture
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="date" class="form-control" id="date" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-inner border border-1 rounded mb-5">
                                                        <div class="card-title-group justify-content-center align-items-center">
                                                            <div class="card-title d-flex justify-content-center align-items-center">
                                                                <h4 class="title fw-blod">Prescriptions du client</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row g-gs mt-0">
                                                            <div class="col-12">
                                                                <table class="table table-bordered text-center">
                                                                    <thead >
                                                                        <tr>
                                                                            <th class="bg-info text-white"></th>
                                                                            <th class="bg-info text-white">
                                                                                SPHERE
                                                                            </th>
                                                                            <th class="bg-info text-white">
                                                                                CYLINDRE
                                                                            </th>
                                                                            <th class="bg-info text-white">
                                                                                AXE (°)
                                                                            </th>
                                                                            <th class="bg-info text-white">
                                                                                ADDITION
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th class="bg-info text-white">
                                                                                OEIL DROIT
                                                                            </th>
                                                                            <td id="sphere_OD"></td>
                                                                            <td id="cylindre_OD"></td>
                                                                            <td id="axe_OD"></td>
                                                                            <td id="addition_OD"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="bg-info text-white">
                                                                                OEIL GAUCHE
                                                                            </th>
                                                                            <td id="sphere_OG"></td>
                                                                            <td id="cylindre_OG"></td>
                                                                            <td id="axe_OG"></td>
                                                                            <td id="addition_OG"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-inner border border-1 rounded mb-5">
                                                        <div class="row g-gs">
                                                            <div class="col-12">
                                                                <div class="form-group text-center">
                                                                    <a class="btn btn-md btn-outline-info" id="btn_ajouter">
                                                                        <span>Ajouter</span>
                                                                        <em class="icon ni ni-plus-circle"></em>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div id="contenu">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-inner mb-5">
                                                        <div class="row g-gs ">
                                                            <div class="col-12 ">
                                                                <div class="row d-flex flex-row-reverse" >
                                                                    <div class="col-md-5 col-lg-4" >
                                                                        <div class="form-group">
                                                                            <label class="form-label d-flex">
                                                                                <span class="me-1">Code Proforma</span>
                                                                                <span class="badge bg-info">
                                                                                    Si une proforma a été délivrée
                                                                                </span>
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <select id="code_proforma" class="form-select js-select2" data-search="on">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                                                    <input id="mTotal" readonly type="tel" class="form-control" value="0">
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
                                                                                            Assurance
                                                                                        </span> 
                                                                                    </div> 
                                                                                    <input id="netAssurance" readonly type="tel" class="form-control" value="0">
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
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend"> 
                                                                                        <span class="input-group-text">
                                                                                            Net à payer
                                                                                        </span> 
                                                                                    </div> 
                                                                                    <input id="netPayer" readonly type="tel" class="form-control" value="0">
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
                                                                    <button type="submit" class="btn btn-lg btn-outline-success">
                                                                        <span>Validé</span>
                                                                        <em class="icon ni ni-printer"></em>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="liste">
                                                <div class="card-title-group justify-content-center align-items-center mt-5">
                                                    <div class="card-title d-flex-column justify-content-center align-items-center text-center">
                                                        {{-- <img height="50px" width="50px" class="rounded-0 border border-0" src="{{ asset('assets/images/info_user.png') }}" alt=""> --}}
                                                        <h4 class="title fw-normal">Liste des Ventes</h4>
                                                    </div>
                                                </div>
                                                <div class="card-bordered card-preview mt-5">
                                                    <div class="card-inner">
                                                        <table class="datatable-init table table_vente" data-auto-responsive="true" style="overflow-x: auto; font-size: 12px;" >
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
                                                                        <span class="sub-text">Réglé ?</span>
                                                                    </th>
                                                                    <th class="nk-tb-col" >
                                                                        <span class="sub-text">Total</span>
                                                                    </th>
                                                                    <th class="nk-tb-col" >
                                                                        <span class="sub-text">Part Assurance</span>
                                                                    </th>
                                                                    <th class="nk-tb-col" >
                                                                        <span class="sub-text">Net à payer</span>
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
</div>

<script src="{{asset('assets/app/jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('assets/app/jsPDF-AutoTable/dist/jspdf.plugin.autotable.min.js')}}"></script>
<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{asset('assets/app/js/select.js')}}"></script>
<script src="{{asset('assets/app/js/pdf/facture_vente.js')}}"></script>
<script src="{{asset('assets/app/js/insert/facture_vente.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_vente_all.js')}}"></script>

@endsection