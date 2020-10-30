@extends('tontine.layouts.base',["title" => "Mon profile"])

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/back-office/css/form.css') }}">
@endsection

@section('app-content')
   <div class="login-form-area mg-t-30 mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3"></div>
                <form action="{{ route('user.update') }}" method="POST" class="adminpro-form">
                    @csrf
                    <div class="col-lg-6">
                        <div class="login-bg">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="logo">
                                        <a href="#"><img src="{{ asset('assets/back-office/img/logo/log.png') }}" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="login-title">
                                        <h1>Edition de profile</h1>
                                     @if($message = Session::get("success"))
                                        <div class="alert alert-success">
                                            {{ $message }}
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @csrf
                    <div class="col-12 col-md-6 col-lg-6">
                        <input type="hidden" name="hidden_id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="nom" class="required">NOM</label>
                            <input class="form-control" type="text" name="nom" id="nom" value="{{ $data->nom }}"/>
                            @error('nom')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="prenoms" class="required">Prénom(s)</label>
                            <input class="form-control" type="text" name="prenoms" id="prenoms" value="{{ $data->prenoms }}"/>
                            @error('prenoms')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date2naissance" class="required">Date de naissance</label>
                            <input class="form-control" type="date" name="date2naissance" id="date2naissance" value="{{ $data->date2naissance }}"/>
                            @error('date2naissance')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="required">Email</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{$data->email }}"/>
                            @error('email')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="label-flex">
                                <label for="residence" class="required">Pays de résidence</label>
                            </div>
                            <div class="select-list">
                                <select class="form-control" select="{{ $data->residence }}" name="residence" id="residence">
                                        <option value="">Selectionnez votre lieu de residence</option>
                                    @foreach($data->residences as $residence)

                                        <option value="{{ $residence->id }}" @if(Auth::user()->residence == $residence->id) selected @endif>{{ $residence->pays }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('residence')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5 col-md-4 col-lg-5">

                        <div class="form-group">
                            <label for="contact1" class="required">Numéro de téléphone 1 </label>
                            <input class="form-control" type="text" name="contact1" id="contact1" value="{{ $data->contact1 }}"/>
                            @error('contact1')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact2" class="required">Numéro de téléphone 2 </label>
                            <input class="form-control" type="text" name="contact2" id="contact2" value="{{ $data->contact2 }}"/>
                            @error('contact2')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="required">Mot de passe</label>
                            <input class="form-control" type="password" name="password" id="password" />
                            @error('password')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="password-confirm" class="required">Confirmation mot de passe</label>
                                <input class="form-control" id="password-confirm" type="password" name="password_confirmation" />
                            </div>
                        </div>
                    </div>
                    <div class="form-goup">
                        <button class="btn btn-block btn-primary">Mettre à jour</button>
                    </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>
    <!-- Order Form End-->
</div>
</div>
@endsection

@section('scripts')
     <!-- maskedinput JS
		============================================ -->
    <script src="{{ asset('assets/back-office/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/back-office/js/masking-active.js') }}"></script>
    <!-- datepicker JS
		============================================ -->
    <script src="{{ asset('assets/back-office/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/back-office/js/datepicker-active.js') }}"></script>
    <!-- form validate JS
		============================================ -->
    <script src="{{ asset('assets/back-office/js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('assets/back-office/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/back-office/js/form-active.js') }}"></script>
    <!-- main JS
@endsection