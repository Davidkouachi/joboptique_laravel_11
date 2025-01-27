@extends('app')

@section('titre', 'Prospects')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title fw-normal">jQuery Form Validation p</h4>
                                <div class="nk-block-des">
                                    <p>Validating your form, just add the class <code class="code-class">.form-validate</code> to any <code class="code-tag">&lt;form&gt;</code>, then it validate the form show error message.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <div class="card-title-group justify-content-center align-items-center">
                                    <div class="card-title d-flex justify-content-center align-items-center">
                                        <em class="icon ni ni-user-list h3 me-2"></em>
                                        <h3 class="title fw-normal">Nouveau Client</h3>
                                    </div>
                                </div>
                                <form id="formulaire_new_client" class="mt-5 m-5">
                                    <div class="row g-gs">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Nom
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-user"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="nom" placeholder="Saisie Obligatoire">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Prénoms
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-user"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="prenoms" placeholder="Saisie Obligatoire">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Né(e) le
                                                </label>
                                                <div class="form-control-wrap">
                                                    <input type="date" class="form-control" id="datenaissnce" placeholder="Saisie Obligatoire">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Civilité
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select id="civilite" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Société
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select id="societe" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Sondage
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select id="sondage" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Profession
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-article"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="profession" placeholder="Saisie Obligatoire">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Résidence
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-home"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="residence" placeholder="Saisie Obligatoire">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Contact 1
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-call"></em>
                                                    </div>
                                                    <input type="tel" class="form-control" id="tel1" placeholder="Saisie Obligatoire">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Contact 2
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-call"></em>
                                                    </div>
                                                    <input type="tel" class="form-control" id="tel2" placeholder="Facultatif">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Email
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-mail"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="email" placeholder="Facultatif">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Réseaux Sociaux
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-globe"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="reseau_sociaux" placeholder="Facultatif">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Matricule Assurance
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-scan"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="reseau_sociaux" placeholder="Facultatif">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Commercial
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select id="commercial" class="form-select js-select2" data-search="on" data-placeholder="Selectionnez">
                                                        <option value=""></option>
                                                        <option value="default_option">Default Option</option>
                                                        <option value="option_select_name">Option select name</option>
                                                        <option value="option_select_name">Option select name</option>
                                                        <option value="option_select_name">Option select name</option>
                                                        <option value="option_select_name">Option select name</option>
                                                        <option value="option_select_name">Option select name</option>
                                                        <option value="option_select_name">Option select name</option>
                                                        <option value="option_select_name">Option select name</option>
                                                        <option value="option_select_name">Option select name</option>
                                                        <option value="option_select_name">Option select name</option>
                                                        <option value="option_select_name">Option select name</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
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


@endsection