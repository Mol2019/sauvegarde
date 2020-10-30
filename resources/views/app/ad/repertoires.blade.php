@extends('app.layouts.base',["title" => "Gestion des repertoires"])

@section('app-content')
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Les repertoires</h1>
                             <div class="sparkline13-outline-icon">
                                <span  style="cursor:pointer;" class="add" data-toggle="modal" data-target="#form">
                                    <i class="fa fa-plus"></i> Ajouter un repertoire
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="nom" data-editable="true">Nom</th>
                                        <th data-field="chemin" data-editable="true">Chemin</th>
                                        <th data-field="action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $rep)
                                        <tr>
                                            <td>{{ $rep->nom }}</td>
                                            <td>{{ $rep->chemin }}</td>
                                            <td>
                                                <button id="{{ $rep->id }}" class="btn btn-info edit_id repertoire_id" data-toggle="modal" data-target="#edit">Modifier</button>
                                                <button id="{{ $rep->id  }}" class="btn btn-danger delete_id" data-toggle="modal" data-target="#delete">Supprimer</button>
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
<div class="modal" id="delete">
    <div class="modal-dialog modal-confirm">
       <div class="modal-content">
           <div class="modal-header flex-column">
               <h4 class="modal-title w-100">Etes vous sure?</h4>
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           </div>
           <div class="modal-body">
               <p>Voulez vous réelement supprimer ce rep ? </p>
           </div>
           <div class="modal-footer justify-content-center">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
               <button type="button" class="btn btn-danger ok">Valider</button>
           </div>
       </div>
   </div>
</div>
<!-- Data table area End-->
<div class="modal" id="edit">
   <div class="modal-dialog modal-confirm">
       <div class="modal-content">
           <form action="" method="post" id="update-form">
            <div class="modal-header flex-column text-center bg-primary">
                <h4 class="modal-title w-100">Modifier un rep</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                   @csrf
                   <div id="form_result">

                   </div>
                   <div class="form-group">
                    <label for="name">Nom du rep : </label>
                    <input name="nom" id="name" class="form-control">
                    <span class="text-danger" id="name-error"> </span>
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

@section('form-modal')
    <form method="post" id="add-form">
        <div class="modal-header flex-column text-center bg-primary">
            <h4 class="modal-title w-100">Ajouter un repertoire</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            @csrf
            <div id="form_result"></div>
            <div class="form-group">
                <label for="name">Nom du repetoire : </label>
                <input name="nom" id="name" class="form-control">
                <span class="text-danger" id="name-error"> </span>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="reset" class="btn btn-default btn-reset" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            let rep_id = "";

            $('.add').click(function(){
                $('#add-form #name').val('');
            });

            //delete
            $('.delete_id').click(function(e){
                rep_id = this.id;
            });

            $('#delete .ok').click(function(e){
                e.preventDefault();
                $.ajax({
                    url : "/repertoires/delete/"+rep_id,
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
                rep_id = this.id;
                $.ajax({
                    url : "/repertoires/edit/"+rep_id,
                    type : "GET",
                    success : function(data)
                    {
                        $("#edit #name").val(data.data.nom  );
                        $("#edit #hidden_id").val(data.data.id);
                    }
                });
            });

            //submit form
            $('#add-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('folder.create') }}",
                    type : "POST",
                    data : $('#add-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#add-form #name-error").text(data.errors[0]);
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
                            $('#add-form #name').val("");
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
                    url : "{{ route('folder.update') }}",
                    type : "POST",
                    data : $('#update-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#edit #name-error").text(data.errors[0]);
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
                            $("#edit #name-error").text("");
                            $("#edit #name").val("");
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#form_result').html(html);

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
