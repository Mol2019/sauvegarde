@extends('tontine.layouts.base',["title" => "Gestion des envoies de rsd"])

@section('app-content')
 <div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Liste des utilisateurs</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="false"></th>
                                        <th data-field="email" data-editable="false">Don</th>
                                        <th data-field="lien" data-editable="false">Montant</th>
                                        <th data-field="phone" data-editable="false">Fait par</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($data as $don)
                                            <tr>
                                                <td></td>
                                                <td>{{ $don->id }}</td>
                                                <td>{{ $don->pack->montant }}</td>
                                                <td>{{ $don->user->nom ." ".$don->user->prenoms }}</td>
                                                <td>
                                                    <button id="{{ $don->id }}" class="btn btn-success fusion_id" data-toggle="modal" data-target="#fusion" href="#fusion">Fusionner</button>
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
<div class="modal" id="fusion">
        <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <form action="{{ route("fusions.create") }}" method="post" id="add-form">
                <div class="modal-header flex-column text-center bg-primary">
                    <h4 class="modal-title w-100">Choix du destinataire</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="form-result"></div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="utilisateur">Numéro de téléphone ou Email : </label>
                        <input type="text" name="utilisateur" id="utilisateur" class="form-control">
                        <span class="text-danger" id="utilisateur-error"> </span>
                    </div>
                </div>
                <input type="hidden" name="don_id" id="don">
                <div class="modal-footer justify-content-center">
                    <button type="reset" class="btn btn-default btn-reset" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            var don_id = "";
            $('.fusion_id').click(function(){
                don_id = this.id;
                $('#add-form #don').val(don_id);
            })

            $('#add-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('fusions.create') }}",
                    type : "POST",
                    data : $('#add-form').serialize(),
                    success : function(data){
                        var html = "";

                        if(data.errors){
                            $("#utilisateur-error").text(data.errors[0]);
                        }

                        if(data.error){
                            html = '<div class="alert alert-danger">' + data.error + '</div>';
                            $('#fusion .form-result').html(html);
                        }


                        if(data.success){
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#fusion .form-result').html(html);
                            setTimeout(function(){
                                location.reload();
                            },3000)
                        }

                    }
                })
            })
        })
    </script>
@endsection
