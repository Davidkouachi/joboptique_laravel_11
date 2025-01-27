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
                                <form id="formulaire_new_client" class="mt-5">
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
                                                        <input type="tel" class="form-control" id="tel1" placeholder="Saisie Obligatoire">
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
                                                    <div class="form-control-wrap">
                                                        <select id="Sphere_OD" class="form-select js-select2" data-search="on" data-placeholder="Sphère OD">
                                                        <option value=""></option>
                                                        <option value="default_option">
                                                            Option
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select id="Cylindre_OD" class="form-select js-select2" data-search="on" data-placeholder="Cylindre OD">
                                                        <option value=""></option>
                                                        <option value="default_option">
                                                            Option
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select id="Axe_OD" class="form-select js-select2" data-search="on" data-placeholder="Axe OD">
                                                        <option value=""></option>
                                                        <option value="default_option">
                                                            Option
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select id="Addition_OD" class="form-select js-select2" data-search="on" data-placeholder="Addition OD">
                                                        <option value=""></option>
                                                        <option value="default_option">
                                                            Option
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select id="Sphere_OG" class="form-select js-select2" data-search="on" data-placeholder="Sphère OG">
                                                        <option value=""></option>
                                                        <option value="default_option">
                                                            Option
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select id="Cylindre_OG" class="form-select js-select2" data-search="on" data-placeholder="Cylindre OG">
                                                        <option value=""></option>
                                                        <option value="default_option">
                                                            Option
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select id="Axe_OG" class="form-select js-select2" data-search="on" data-placeholder="Axe OG">
                                                        <option value=""></option>
                                                        <option value="default_option">
                                                            Option
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select id="Addition_OG" class="form-select js-select2" data-search="on" data-placeholder="Addition OG">
                                                        <option value=""></option>
                                                        <option value="default_option">
                                                            Option
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
                                                        <option value="option_select_name">
                                                            Option name
                                                        </option>
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
                                                    <a class="btn btn-md btn-outline-info">
                                                        <span>Ajouter</span>
                                                        <em class="icon ni ni-plus-circle"></em>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-inner border border-1 rounded mb-5">
                                                <div class="row g-gs">
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Désignation
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon ni ni-archived"></em>
                                                                </div>
                                                                <input type="text" class="form-control" id="designation" placeholder="Saisie Obligatoire">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Prix
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    Fcfa
                                                                </div>
                                                                <input type="tel" class="form-control" id="prix" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Quantité
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input type="tel" class="form-control" id="qte" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group text-center">
                                                            <a class="btn btn-md btn-outline-danger">
                                                                <em class="icon ni ni-trash"></em>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-inner mb-5">
                                        <div class="row g-gs ">
                                            <div class="col-12 ">
                                                <div class="row d-flex flex-row-reverse" >
                                                    <div class="col-md-3" >
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"> 
                                                                        <span class="input-group-text">
                                                                            Total
                                                                        </span> 
                                                                    </div> 
                                                                    <input readonly type="tel" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row d-flex flex-row-reverse" >
                                                    <div class="col-md-3" >
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <select id="remise" class="form-select js-select2" data-search="on" data-placeholder="Rémise">
                                                                    <option value=""></option>
                                                                    <option value="default_option">
                                                                        Remise 20%
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row d-flex flex-row-reverse" >
                                                    <div class="col-md-3" >
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"> 
                                                                        <span class="input-group-text">
                                                                            Net à payer
                                                                        </span> 
                                                                    </div> 
                                                                    <input readonly type="tel" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group text-center">
                                                    <a class="btn btn-lg btn-outline-success">
                                                        <span>Validé</span>
                                                        <em class="icon ni ni-printer"></em>
                                                    </a>
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

@endsection