<div class="tm-row pt-4">
    <div class="tm-col-left">
        <div class="tm-site-header media">
            <i class="fas fa-umbrella-beach fa-3x mt-1 tm-logo"></i>
            <div class="media-body">
                <h1 class="tm-sitename text-uppercase">{{config("app.name")}}</h1>
                <p class="tm-slogon"> Contact :  (225) 56 973 695</p>
            </div>
        </div>
    </div>
    <div class="tm-col-right">
        <nav class="navbar navbar-expand-lg" id="tm-main-nav">
            <button class="navbar-toggler toggler-example mr-0 ml-auto" type="button"
                data-toggle="collapse" data-target="#navbar-nav"
                aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fas fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse tm-nav" id="navbar-nav">
                <ul class="navbar-nav text-uppercase">
                    <li class="nav-item active">
                        <a class="nav-link tm-nav-link" href="{{route('index')}}">ACCUEIL <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tm-nav-link" href="{{route('strategie')}}">STRATEGIE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tm-nav-link" href="{{route('home')}}">INVESTIR</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>