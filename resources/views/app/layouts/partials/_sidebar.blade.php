<div class="left-sidebar-pro">
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="#"><img src="{{ asset('assets/back-office/img/message/1.jpg') }}" alt="" />
            </a>
            <h3>{{ Auth::user()->nom }}</h3>
            @if(Auth::user()->role == "ad")
                <p>Administrateur</p>
            @elseif(Auth::user()->role == "cs")
                <p>Chef de service</p>
            @elseif(Auth::user()->role == "ge")
            <p>Gérant</p>
            @endif
            <strong>2M+</strong>
        </div>
        <div class="left-custom-menu-adp-wrap">
            <ul class="nav navbar-nav left-sidebar-menu-pro">
                @include('app.layouts.partials._menu')
            </ul>
        </div>
    </nav>
</div>
