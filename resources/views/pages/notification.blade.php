@extends('app')

@section('titre', 'Envoi d\'sms')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">

                    <div class="nk-block">
                        <div class="card" style="background: linear-gradient(to right, #006400, #32CD32);">
                            <div class="card-inner">
                                <div class="card-title-group justify-content-center align-items-center">
                                    <div class="card-title d-flex justify-content-center align-items-center d-flex flex-column">
                                        <img class="rounded-circle border border-2 mb-2" height="50" width="50" src="{{ asset('assets/images/sms.svg') }}">
                                        <h5 class="nk-block-title text-white">Envoi d'sms</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner">
                                <ul class="nav nav-tabs nav-tabs-s2 mt-n3">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#liste">
                                            <em class="icon ni ni-list"></em>
                                            <span>Envoi d'sms</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#new">
                                            <em class="icon ni ni-setting"></em>
                                            <span>Parametre</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="new">
                                        <div class="card-title-group justify-content-center align-items-center mt-5">
                                            <div class="card-title d-flex-column justify-content-center align-items-center text-center">
                                                <h4 class="title fw-normal">Nouveau type de message</h4>
                                            </div>
                                        </div>
                                        <form id="formulaire_type_message" class="mt-5">
                                            <div class="row g-gs">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Type
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-file"></em>
                                                            </div>
                                                            <input type="text" class="form-control" id="type_nom" placeholder="Saisie Obligatoire">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Message</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control" id="type_message" maxlength="100"></textarea>
                                                        </div>
                                                        <small id="char_count_type">0/100</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-gs mt-1">
                                                <div class="col-md-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-md btn-outline-success">
                                                            <span>Validé</span>
                                                            <em class="icon ni ni-check"></em>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane active" id="liste">
                                        <div class="table-responsive datatable-wrap p-2 mt-5">
                                            <div class="d-flex flex-column " >
                                                <p id="selectionStatus" style="display:none;">
                                                    Éléments sélectionnés : 
                                                    <span id="selectedCount">0</span> / <span id="totalCount">0</span>
                                                </p>
                                                <div id="selectionStatusCheckbox" class="custom-control custom-control-sm custom-checkbox mb-3" style="display:none;">
                                                    <input type="checkbox" class="custom-control-input" id="pid-all">
                                                    <label class="custom-control-label" for="pid-all">
                                                        Tout selectionnés
                                                    </label>
                                                </div>
                                                <a id="btn_sendSMSmultiple" class="btn btn-dim btn-sm btn-outline-warning mb-3 w-20" style="display:none;">
                                                    <span>Envoyer un message</span>
                                                    <em class="icon ni ni-send" ></em>
                                                </a>
                                            </div>
                                            <table class="datatable-init table_client" data-auto-responsive="false" style="font-size:12px;" >
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th class="nk-tb-col" >
                                                        </th>
                                                        <th class="nk-tb-col" >
                                                            <span class="sub-text"></span>
                                                        </th>
                                                        <th class="nk-tb-col" >
                                                            <span class="sub-text">Client</span>
                                                        </th>
                                                        <th class="nk-tb-col" >
                                                            <span class="sub-text">Contact</span>
                                                        </th><th class="nk-tb-col" >
                                                            <span class="sub-text">Date d'enregistrement</span>
                                                        </th>
                                                        <th class="nk-tb-col" >
                                                            <span class="sub-text">Membre depuis</span>
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

                    <div class="nk-block mt-5">
                        <div class="row g-gs mb-2">
                            <div class="col-12">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Listes des types de message</h5>
                                        </div>
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle"><a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li class="nk-block-tools-opt">
                                                            <a id="reloader_liste_type" class="btn btn-sm btn-icon btn-gray btn-dim">
                                                                <em class="icon ni ni-reload"></em>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row g-gs" id="div_contenu_message"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_user_sms.js')}}"></script>
<script src="{{asset('assets/app/js/insert/type_message.js')}}"></script>
<script src="{{asset('assets/app/js/list/type_message.js')}}"></script>

@endsection