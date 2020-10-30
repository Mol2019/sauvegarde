@if(Auth::user()->role == "ad")
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link">
        <i class="fa big-icon fa-home"></i>
        <span class="mini-dn">Tableau de bord</span>
        <span class="indicator-right-menu mini-dn">
            <i class="fa indicator-mn fa-angle-left"></i>
        </span>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('service.index') }}" class="nav-link">
        <i class="fa big-icon fa-exchange"></i>
        <span class="mini-dn">Services</span>
        <span class="indicator-right-menu mini-dn">
            <i class="fa indicator-mn fa-angle-left"></i>
        </span>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('gestion.user.index') }}" class="nav-link">
        <i class="fa big-icon fa-users"></i>
        <span class="mini-dn">Utilisateurs</span>
        <span class="indicator-right-menu mini-dn">
            <i class="fa indicator-mn fa-angle-left"></i>
        </span>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route("folder.index") }}" class="nav-link">
        <i class="fa big-icon fa-folder"></i>
        <span class="mini-dn">Les repertoires</span>
        <span class="indicator-right-menu mini-dn">
            <i class="fa indicator-mn fa-angle-left"></i>
        </span>
    </a>
</li>
@else
<li class="nav-item">
    <a href="{{ route("folder.index") }}" class="nav-link">
        <i class="fa big-icon fa-folder"></i>
        <span class="mini-dn">{{ Auth::user()->service->name }}</span>
        <span class="indicator-right-menu mini-dn">
            <i class="fa indicator-mn fa-angle-left"></i>
        </span>
    </a>
</li>
@endif








