@extends('tontine.layouts.base',["title" => "Gestion des abonnements"])


@section('app-content')
<div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sparkline13-list shadow-reset">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>Liste des demandes</h1>
                                    
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
                                    <tr>
                                            <th data-field="id">ID</th>
                                            <th data-field="user" data-editable="false">Utilisateur</th>
                                            <th data-field="demande" data-editable="false">Date de demande</th>
                                            <th data-field="paiement" data-editable="false">Date de paiement adhésion</th>
                                            <th data-field="action"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $adhesion)
                                        <tr>
                                            <td>{{ $adhesion->id }}</td>
                                            <td>{{ $adhesion->user->nom ." ". $adhesion->user->prenoms}}</td>
                                            <td>{{ $adhesion->date_demande }}</td>
                                            <td>{{ $adhesion->date_debut }}</td>
                                            <td>
                                                @if($adhesion->is_new)
                                                    <button id="{{$adhesion->id }}" data-toggle="modal" data-target="#treat" href="#treat"  class="btn btn-success tread_id">Traiter</button>
                                                @endif
                                                <button id="{{ $adhesion->id }}" class="btn btn-danger delete_id" data-toggle="modal" data-target="#delete" href="#delete">Supprimer</button>
                                            </td>
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
        <!-- Static Table End -->

        <!-- Data table area End-->
        <div class="modal" id="treat">
             <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <h4 class="modal-title w-100">Etes vous sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez vous réelement effectuer cette action ? </p>
                        <div id="confirm-result" class="treat"></div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger ok">Valider</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="delete">
             <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <h4 class="modal-title w-100">Etes vous sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez vous réelement supprimer cet utilisateur ? </p>
                        <div id="confirm-result" class="del"></div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger ok">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            let adhesion_id = "";
            $('#result-zone').hide();


            //treat or untreat
            $('.tread_id').click(function(e){
                //console.log(this.id)
                adhesion_id = this.id;
            });

            $('#treat .ok').click(function(e){
                e.preventDefault();
                console.log(adhesion_id)
                $.ajax({
                    url : "/abonnements/treat/"+adhesion_id,
                    type : "GET",
                    success : function(data)
                    {
                       var html = "";
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('.treat').html(html);
                        setTimeout(function(){
                            location.reload()
                        },3000)
                    }
                });
            });


            //delete
            $('.delete_id').click(function(e){
                adhesion_id = this.id;
            });

            $('#delete .ok').click(function(e){
                e.preventDefault();
                $.ajax({
                    url : "/abonnements/delete/"+adhesion_id,
                    type : "GET",
                    success : function(data)
                    {
                        var html = "";
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('.del').html(html);
                        setTimeout(function(){
                            location.reload()
                        },3000)
                    }
                });
            });


        })
    </script>
@endsection
