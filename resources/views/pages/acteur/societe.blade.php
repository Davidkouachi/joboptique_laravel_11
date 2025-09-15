@extends('app')

@section('titre', 'Sociétés')

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
                                                    <span>Liste des Sociétés</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#new">
                                                    <em class="icon ni ni-home"></em>
                                                    <span>Nouvelle Sociétés</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="new">
                                                <div class="card-title-group justify-content-center align-items-center mt-5">
                                                    <div class="card-title d-flex-column justify-content-center align-items-center text-center">
                                                        {{-- <img height="80px" width="80px" class="rounded-pill border border-1" src="{{ asset('assets/images/user8.png') }}" alt=""> --}}
                                                        <h4 class="title fw-normal">Nouvelle Sociétés</h4>
                                                    </div>
                                                </div>
                                                <form id="formulaire_new_societe" class="mt-5">
                                                    <div class="row g-gs">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="form-label">
                                                                    Nom
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-home"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="nom" placeholder="Saisie Obligatoire">
                                                                </div>
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
                                                <div class="card-title-group justify-content-center align-items-center mt-5">
                                                    <div class="card-title d-flex-column justify-content-center align-items-center text-center">
                                                        {{-- <img height="50px" width="50px" class="rounded-0 border border-0" src="{{ asset('assets/images/info_user.png') }}" alt=""> --}}
                                                        <h4 class="title fw-normal">Liste des Sociétés</h4>
                                                    </div>
                                                </div>
                                                <div class="table-responsive datatable-wrap p-2 mt-5">
                                                    <table class="datatable-init table_societe" data-auto-responsive="false" style="font-size:12px;" >
                                                        <thead class="bg-azure" >
                                                            <tr class="nk-tb-item nk-tb-head">
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text text-white"></span>
                                                                </th>
                                                                <th class="nk-tb-col" >
                                                                    <span class="sub-text text-white">Sociétés</span>
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
        </div>
    </div>
</div>

<script src="{{asset('assets/app/js/Datatable/init.js')}}"></script>
<script src="{{asset('assets/app/js/list/list_societe_all.js')}}"></script>
<script src="{{asset('assets/app/js/insert/societe.js')}}"></script>

@endsection