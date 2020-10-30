@extends('app.layouts.base',["title" => "Tableau de bord"])

@section('app-content')
<!-- income order visit user Start -->
    <div class="income-order-visit-user-area">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Les utilisateurs</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3><span class="counter">{{ $data->count_users - 1 }}</span></h3>
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
                                <h2>Les repertoires</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3>
                                        <span class="counter">
                                            {{ $data->rep_count }}
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

            </div>
        </div>
    </div>

    <div class="data-table-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sparkline13-list shadow-reset">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd">
                                <h1>Historique des actions</h1>
                            </div>
                        </div>
                        <div class="sparkline13-graph">
                            <div class="datatable-dashv1-list custom-datatable-overright">

                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            <th data-field="email" data-editable="false">Utilisateur</th>
                                            <th data-field="action" data-editable="false">Action</th>
                                            <th data-field="date" data-editable="false">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->traces as $trace)
                                            <tr>
                                                    <td>{{ $trace->user->name }}</td>
                                                    <td>{{ $trace->action }}</td>
                                                    <td>{{ $trace->created_at }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
