@extends('tontine.layouts.base',["title" => "Gestion des rsd"])

@section('app-content')
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Liste des demandes de rsd</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="receieveFrom" data-editable="true">Demandeur</th>
                                        <th data-field="reference_e">Téléphone</th>
                                        <th data-field="make">Montant </th>
                                        <th data-field="action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $rs)
                                        <tr>
                                            <td></td>
                                            <td>{{ $rs->demandeur->user->nom." ".$rs->demandeur->user->prenoms }}</td>
                                            <td>{{ "+".$rs->demandeur->user->residence->indicatif." ".$rs->demandeur->user->contact1 }}</td>
                                             <td>{{ $rs->montant }}</td>
   
                                            <td>
                                                <button id="{{ $rs->id }}" class="btn btn-success transaction_id" data-toggle="modal" data-target="#valideTransaction">Valider la transaction</button>
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
<div class="modal" id="valideTransaction">
             <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <h4 class="modal-title w-100">Etes vous sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                     <form action="" method="post" id="valide-form">
                        <div class="modal-header flex-column text-center bg-primary">
                            <h4 class="modal-title w-100">Veuillez fournir la référence de votre paiement</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div id="form_result"></div>
                            <div class="form-group">
                                <label for="reference">Saisir la référence : </label>
                                <input type="text" name="reference" class="form-control">
                                <span class="text-danger" id="reference-error"> </span>
                            </div>
                            <input type="hidden" name="hidden_id" id="hidden_id" >

                        </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        let transaction_id = "";

        
        $('.transaction_id').click(function(e){
            e.preventDefault();
            transaction_id = this.id;
            $('#valide-form #hidden_id').val(this.id);
            console.log($('#valide-form #hidden_id').val())
        });

         $('#valide-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('rsdvalide') }}",
                    type : "POST",
                    data : $('#valide-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#valide-form #reference-error").text(data.errors[0]);
                        }
                        var html = '';
                         if (data.error) {
                            html = '<div class="alert alert-danger">';
                            html += '<p>' + data.error + '</p>';
                            html += '</div>';
                            $('#form_result').html(html);
                        }
                        if(data.success)
                        {
                            html = "";
                            $("#valide-form #reference-error").text("");
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#valide-form #form_result').html(html);

                           setTimeout(function(){
                                location.reload();
                            }, 3000);
                        }
                    }
                })
            });

        /*$('#valideTransaction .ok').click(function(e){
            e.preventDefault();
            $.ajax({
                url : "rsds/rsd/valide/"+transaction_id,
                type : "GET",
                success : function(data)
                {
                    var html = "";
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('.valideT').html(html);

                        setTimeout(function(){
                            location.reload()
                        },3000)
                }
            });
        });*/
    })
</script>
@endsection
