@extends('tontine.layouts.base',["title" => "Gestion des rsd administration"])

@section('app-content')
 <div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Rsds reçu</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th>Envoyeur</th>
                                        <th>Numéro</th>
                                        <th>Montant</th>
                                        <th>Fait le </th>
                                        <th>Réfrérence</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $rs)
                                        <tr>
                                            <td>{{ $rs->envoyeur->user->prenoms." ".$rs->envoyeur->user->prenoms }}</td>
                                            <td>{{ "+".$rs->envoyeur->user->residence->indicatif." ".$rs->envoyeur->user->contact1 }}</td>
                                            <td>{{ $rs->montant }}</td>
                                            <td>{{ $rs->date_reception}}</td>
                                            <td>{{ $rs->references }}</td>
                                            <td>
                                                <button  id="{{ $rs->id }}" class="btn btn-success fusion_id" data-toggle="modal" data-target="#valideReferences">J'ai reçu mon don</button>
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
<div class="modal" id="valideReferences">
            <div class="modal-dialog">
                <div class="modal-content">
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
            let don_id = "";
            let fusion_id = "";

            //delete
            $('.delete_id').click(function(e){
                don_id = this.id;
            });

            $('.fusion_id').click(function(e){
                fusion_id = this.id;
                $('#valide-form #hidden_id').val(this.id);
                $('#valide-form #type').val($(this).attr('name'));

            })


            $('#delete .ok').click(function(e){
                e.preventDefault();
                $.ajax({
                    url : "/dons/delete/"+don_id,
                    type : "GET",
                    success : function()
                    {
                        location.reload()
                    }
                });
            });

             //edit or unedit
            $('.edit_id').click(function(e){
                e.preventDefault();
                don_id = this.id;
                $.ajax({
                    url : "/dons/edit/"+don_id,
                    type : "GET",
                    success : function(data)
                    {
                        $("#edit #pack").val(data.data.pack);
                        $("#edit #hidden_id").val(data.data.id);
                    }
                });
            });

            //submit form
            $('#add-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('don.add') }}",
                    type : "POST",
                    data : $('#add-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#add-form #pack-error").text(data.errors[0]);
                        }
                        var html = '';

                        if (data.error) {
                            html = '<div class="alert alert-danger">';
                            html += '<p>' + data.error + '</p>';
                            html += '</div>';
                            $('#add-form #form_result').html(html);
                        }
                        if(data.success)
                        {
                            html = "";
                            $('error-disp').hide();
                            $("#add-form #pack-error").text("");
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#add-form #form_result').html(html);

                           setTimeout(function(){
                                location.reload();
                            }, 3000);
                        }
                    }
                })
            });

             //submit form
            $('#update-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('don.update') }}",
                    type : "POST",
                    data : $('#update-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#edit #pack-error").text(data.errors[0]);
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
                            $('error-disp').hide();
                            $("#edit #pack-error").text("");
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#form_result').html(html);

                           setTimeout(function(){
                                location.reload();
                            }, 3000);
                        }
                    }
                })
            });


            //submit form
            $('#valide-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('rsd.changestate') }}",
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
        })
    </script>
@endsection
