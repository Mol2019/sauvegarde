@extends('tontine.layouts.base',["title" => "Gestion des bonus"])

@section('app-content')
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Liste des rsd</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="email" data-editable="false">Utilisateur</th>
                                        <th data-field="lien" data-editable="false">Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($data as $gain)
                                            <tr>
                                                <td>{{ $gain->don->user->nom ." ".$gain->don->user->prenoms }}</td>
                                                <td>{{ $gain->montant }}</td>
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