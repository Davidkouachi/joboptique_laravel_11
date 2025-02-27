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
                                        <img class="rounded-circle border border-2 mb-2" height="130" width="130" src="{{ asset('assets/images/sms.svg') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner">
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
                                    <a id="btn_sendSMSmultiple" class="btn btn-dim btn-sm btn-outline-warning mb-3 w-20" style="display:none;" data-bs-toggle="modal" data-bs-target="#sendSMSmultipleModal">
                                        <span>Envoyer un message</span>
                                        <em class="icon ni ni-send" ></em>
                                    </a>
                                </div>
                                <table class="datatable-init table table_client" data-auto-responsive="true" style="overflow-x: auto; font-size: 12px;" >
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col" >
                                            </th>
                                            <th class="nk-tb-col" >
                                                <span class="sub-text"></span>
                                            </th>
                                            <th class="nk-tb-col" >
                                                <span class="sub-text">Matricule</span>
                                            </th>
                                            <th class="nk-tb-col" >
                                                <span class="sub-text">Nom et Prénoms</span>
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
    </div>
</div>

<div class="modal fade" id="sendSMS" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white">
            {{-- <div class="modal-header">
                <h5 class="modal-title">Message</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div> --}}
            <div class="modal-body">
                <div class="form-validate is-alter">
                    <div class="form-group">
                        <label class="form-label">Nom et Prénoms</label>
                        <div class="form-control-wrap">
                            <input readonly type="text" class="form-control" id="ss_np">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contact</label>
                        <div class="form-control-wrap">
                            <input type="tel" class="form-control" id="ss_tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <div class="form-control-wrap">
                            <textarea class="form-control" id="ss_message" maxlength="100"></textarea>
                        </div>
                        <small id="char_count">0/100</small>
                    </div>
                    <div class="form-group text-center">
                        <a id="btn_sendSMS" class="btn btn-dim btn-lg btn-outline-warning">
                            <span>Envoyer</span>
                            <em class="icon ni ni-send" ></em>
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer bg-light"><span class="sub-text">Envoie d'sms</span></div> --}}
        </div>
    </div>
</div>

<div class="modal fade" id="sendSMSmultipleModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white">
            {{-- <div class="modal-header">
                <h5 class="modal-title">Message</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div> --}}
            <div class="modal-body">
                <div class="form-validate is-alter">
                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <div class="form-control-wrap">
                            <textarea class="form-control" id="sm_message" maxlength="100"></textarea>
                        </div>
                        <small id="char_count_muktiple">0/100</small>
                    </div>
                    <div class="form-group text-center">
                        <a id="btn_sendSMSMULTIPLE" class="btn btn-dim btn-lg btn-outline-warning">
                            <span>Envoyer</span>
                            <em class="icon ni ni-send" ></em>
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer bg-light"><span class="sub-text">Envoie d'sms</span></div> --}}
        </div>
    </div>
</div>

<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_user_sms.js')}}"></script>

@endsection