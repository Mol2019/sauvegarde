<div class="header-top-area">
    <div class="fixed-header-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                    <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="admin-logo logo-wrap-pro">
                        <a href="#"><img src="img/logo/log.png" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12">
                    <div class="header-top-menu tabl-d-n">
                        <ul class="nav navbar-nav mai-top-nav">
                            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">ACCUEIL</a></li>
                        </ul>

                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="header-right-info">
                        <ul class="nav navbar-nav mai-top-nav header-right-menu">
                            <li class="nav-item">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                    <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                    <span class="admin-name">{{ Auth::user()->name}}</span>
                                    <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                                </a>
                                <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                    <li>
                                        <a data-toggle="modal" data-target="#logout" href="#logout">
                                            <span class="adminpro-icon adminpro-locked author-log-ic"></span>
                                            Déconnexion
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
