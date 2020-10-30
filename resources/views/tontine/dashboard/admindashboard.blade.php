@extends('tontine.layouts.base',["title" => "Tableau de bord"])

@section('app-content')
 @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
<!-- income order visit user Start -->
    <div class="income-order-visit-user-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Mise à jour</h2>
                                    <p class="updating" style = "cursor:pointer;">Cliquez ici</p>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Demande d'abonnements</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3><span class="counter">{{ $data["AbonnementNrCount"] }}</span></h3>
                                </div>
                                <div class="price-graph">
                                    <span id="sparkline1"></span>
                                </div>
                            </div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Demande de bonus</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3>
                                        <span class="counter">
                                            {{$data["bonusAsksCount"]}}
                                        </span>
                                    </h3>
                                </div>
                                <div class="price-graph">
                                    <span id="sparkline6"></span>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Utilisateurs</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3><span class="counter">{{ $data["userCount"] }}</span></h3>
                                </div>
                                <div class="price-graph">
                                    <span id="sparkline2"></span>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Demande de rsd</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3>
                                        <span class="counter">
                                            {{$data['rdsAsksCount']}}
                                        </span>
                                    </h3>
                                </div>
                                <div class="price-graph">
                                    <span id="sparkline5"></span>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!-- income order visit user End -->
@endsection

@section('scripts')
    <script>
        $('.updating').click(function(e){
            $.ajax({
                method : "GET",
                url : "{{route('updating')}}",
                success : function(){
                    location.reload();
                }
            });
        })    
    </script>    
@endsection