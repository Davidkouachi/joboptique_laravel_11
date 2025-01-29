@extends('app')

@section('titre', 'Préscription')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block">
                        {{-- <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title fw-normal">jQuery Form Validation</h4>
                                <div class="nk-block-des">
                                    <p>Validating your form, just add the class <code class="code-class">.form-validate</code> to any <code class="code-tag">&lt;form&gt;</code>, then it validate the form show error message.</p>
                                </div>
                            </div>
                        </div> --}}
                        <div class="card">
                            <div class="card-inner">
                                <div class="card-title-group justify-content-center align-items-center">
                                    <div class="card-title d-flex justify-content-center align-items-center">
                                        <em class="icon ni ni-user-list h3 me-2"></em>
                                        <h4 class="title fw-normal">Préscription</h4>
                                    </div>
                                </div>
                                <form id="formulaire_prescription" class="mt-5 m-5">
                                    <div class="row g-gs">
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
                                    <div class="row g-gs mt-3" id="contenu">
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Traitement OD
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select id="Traitement_OD" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Type verre OD
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select id="Type_verre_OD" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Traitement OG
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select id="Traitement_OG" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Type verre OG
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select id="Type_verre_OG" class="form-select js-select2" data-search="on" data-placeholder="Selectionner">
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-gs mt-3">
                                        <div class="col-12">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-lg btn-outline-success">
                                                    <span>Validé</span>
                                                    <em class="icon ni ni-check"></em>
                                                </button>
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
<script src="{{asset('assets/app/js/insert/prescription.js')}}"></script>

@endsection