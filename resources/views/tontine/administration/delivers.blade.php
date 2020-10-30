@extends('tontine.layouts.base',["title" => "Gestion des bonus parains"])

@section('app-content')
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Liste des bonus parains</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="false"></th>
                                        <th data-field="email" data-editable="false">Utilisateur</th>
                                        <th data-field="lien" data-editable="false">Montant</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($data as $gain)
                                            <tr>
                                                <td></td>
                                                <td>{{ "+".$gain->user->residence->indicatif ." ".$gain->user->contact1 }}</td>
                                                <td>{{ $gain->montant }}</td>
                                                <td>
                                                    <button id="{{ $gain->id }}" class="btn btn-success gain_id" data-toggle="modal" data-target="#valider">Valider comme donné</button>
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
<div class="modal" id="valider">
        <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <h4 class="modal-title w-100">Etes vous sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Voulez vous réelement effectuer cette action ? </p>
                 <div id="confirm-result" class="valide"></div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger ok">Valider</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
   <script>
        $(document).ready(function(){
            let gain_id = "";

            //lock or unlock
            $('.gain_id').click(function(e){
                gain_id = this.id;
            });

            $('#valider .ok').click(function(e){
                e.preventDefault();
                $.ajax({
                    url : "/bonus/administration/delivred/"+gain_id,
                    type : "GET",
                    success : function(data)
                    {
                        var html = "";
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('.valide').html(html);

                        setTimeout(function(){
                            location.reload()
                        },3000)
                    }
                });
            });
         })
   </script>
@endsection