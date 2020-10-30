<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>TOP INVESTISSEMENT | INSCRIPTION</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="{{asset('assets/register/fonts/linearicons/style.css')}}">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="{{ asset('assets/register/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="{{ asset('assets/register/vendor/date-picker/css/datepicker.min.css') }}">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="{{ asset('assets/register/css/style.css') }}">
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">
				<form action="{{route('register')}}" method="POST">
                    @csrf
                    <h3>ESPACE INSCRIPTION</h3>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="nom">Nom *</label>
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom">
                            @error('nom')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="form-wrapper">
							<label for="nom">Prénom(s) *</label>
                            <input id="prenoms" name="prenoms" type="text" class="form-control" placeholder="Prénom(s)">
                            @error('prenoms')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
                    </div>
                    <div class="form-row">
						<div class="form-wrapper">
							<label for="dp1">Date de naissance *</label>
							<input name="date2naissance" type="date" class="form-control" data-date-format="dd M yyyy">
                            @error('date2naissance')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="form-wrapper">
							<label for="residence">Pays de résidence *</label>
							<select name="residence" id="residence" class="form-control">
                                    <option value="">Lieu de residence</option>
                                    @foreach($data as $residence)
                                        <option value="{{ $residence->id }}">{{ $residence->pays }}</option>
                                    @endforeach
							</select>
                            <i class="zmdi zmdi-chevron-down"></i>
                            @error('residence')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
                    </div>
                    <div class="form-row">
						<div class="form-wrapper">
							<label for="contact1">Contact 1 *</label>
                            <input name="contact1" id="contact1" type="text" class="form-control" placeholder="Contact 1">
                            @error('contact1')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="form-wrapper">
							<label for="contact 2">Contact 2</label>
                            <input name="contact2" type="text" class="form-control" placeholder="Contact 2">
                            @error('contact2')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
                    </div>
                    <div class="form-row">
						<div class="form-wrapper">
							<label for="email">Email *</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="form-wrapper">
							<label for="password">Mot de passe *</label>
							<input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe">
                            @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
						<div class="form-wrapper">
							<label for="password-confirm">Confirmation *</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmer mot de passe">
						</div>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox"> J'accepte les <a href="{{route('strategie')}}"> conditions de système. </a>
							<span class="checkmark"></span>
						</label>
                    </div>
                    <input type="hidden" name="lien_parainage" value="{{ $data->link ?? "" }}">
                            <button type="submit" data-text="INSCRIPTION">
                                <span>INSCRIPTION</span>
                            </button>
                            <span>Dejà un compte ?</span>
                            <a href="{{url("/login")}}">
                                CONNEXION
                            </a>
                 </form>

           </div>
		</div>

		<script src="{{ asset('assets/register/js/jquery-3.3.1.min.js') }}"></script>

		<!-- DATE-PICKER -->
		<script src="{{ asset('assets/register/vendor/date-picker/js/datepicker.js') }}"></script>

		<script src="{{ asset("assets/register/js/main.js") }}"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
