@extends('tontine.layouts.base',["title" => "Historique de mes dons"])

@section('app-content')
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
         @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Mes dons</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="montant" data-editable="true">Montant</th>
                                        <th data-field="make">Fait le </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $don)
                                        <tr>
                                            <td>{{ $don->pack->montant }}</td>
                                            <td>{{ $don->date_envoie }}</td>
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