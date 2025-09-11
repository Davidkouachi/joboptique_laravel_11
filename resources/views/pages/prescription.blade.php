@extends('app')

@section('titre', 'Préscription')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block">
                        <div class="nk-block-head d-flex justify-content-center align-items-center">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title fw-normal">Préscription</h4>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                {{-- <div class="card-title-group justify-content-center align-items-center">
                                    <div class="card-title d-flex justify-content-center align-items-center">
                                        <em class="icon ni ni-user-list h3 me-2"></em>
                                        <h4 class="title fw-normal">Préscription</h4>
                                    </div>
                                </div> --}}
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
                                    <div class="row g-gs mt-3" id="contenu" style="display: none;">
                                        
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