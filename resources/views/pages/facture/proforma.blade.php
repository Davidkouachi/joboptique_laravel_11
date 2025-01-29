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
                            <div class="card-inner">
                                <div class="card-title-group justify-content-center align-items-center">
                                    <div class="card-title d-flex justify-content-center align-items-center">
                                        <em class="icon ni ni-file-text h3 me-2"></em>
                                        <h3 class="title fw-normal">FACTURE PROFORMA</h3>
                                    </div>
                                </div>
                                <form id="formulaire_proforma" class="mt-5">
                                    <div class="card-inner border border-1 rounded mb-5">
                                        <div class="row g-gs">
                                            <div class="col-md-7">
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
                                            <div class="col-md-3">
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
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Date
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <input type="date" class="form-control" id="date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-inner border border-1 rounded mb-5">
                                        <div class="row g-gs">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/app/js/select.js')}}"></script>
<script src="{{asset('assets/app/js/insert/facture_proforma.js')}}"></script>

@endsection