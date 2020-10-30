@extends('app.layouts.base',["title" => "Gestion des utilisateurs"])

@section('app-content')
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Les utilisateurs</h1>
                             <div class="sparkline13-outline-icon">
                                <span  style="cursor:pointer;" class="add" data-toggle="modal" data-target="#form">
                                    <i class="fa fa-plus"></i> Ajouter un utilisateur
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
                                        <th data-field="email" data-editable="true">Email</th>
                                        <th data-field="service" data-editable="true">Service</th>
                                        <th data-field="role" data-editable="true">Role</th>
                                        <th data-field="action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->service->name }}</td>
                                            <td>
                                                @if($user->role=="ad")
                                                    Administrateur
                                                @elseif($user->role =="ge")
                                                    Gérant
                                                @elseif($user->role =="cs")
                                                    Chef de service
                                                @else
                                                    Simple employé
                                                @endif
                                            </td>
                                            <td>
                                                <button id="{{ $user->id }}" class="btn btn-primary attrib_id" data-toggle="modal" data-target="#attrib">Attribuer repertoire</button>
                                                <button id="{{ $user->id }}" class="btn btn-info edit_id service_id" data-toggle="modal" data-target="#edit">Modifier</button>
                                                <button id="{{ $user->id  }}" class="btn btn-danger delete_id" data-toggle="modal" data-target="#delete">Supprimer</button>
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
               <p>Voulez vous réelement supprimer ce service ? </p>
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
                <h4 class="modal-title w-100">Modifier un service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                @csrf
                <div id="form_result">

                </div>
                <div class="form-group">
                    <label for="name">Nom du service : </label>
                    <input name="name" id="name" class="form-control">
                    <span class="text-danger" id="name-error"> </span>
                </div>
                <div class="form-group">
                    <label for="email">Login : </label>
                    <input name="email" id="email" class="form-control">
                    <span class="text-danger" id="email-error"> </span>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe : </label>
                    <input name="password" id="password" class="form-control">
                    <span class="text-danger" id="password-error"> </span>
                </div>

                <div class="form-group">
                    <label for="Service">Service : </label>
                    <select name="service_id" id="service" class="form-control">
                        <option value="">Selectionnez le service</option>
                        @foreach($data->services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger" id="service-error"> </span>
                </div>

                <div class="form-group">
                    <label for="role">Service : </label>
                    <select name="role" id="role" class="form-control">
                        <option value="">Selectionnez le role</option>
                        <option value="ge">Gérant</option>
                        <option value="cs">Chef de service</option>
                        <option value="se">Employé ordinaire</option>
                    </select>
                    <span class="text-danger" id="role-error"> </span>
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

<div class="modal" id="attrib">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <form action="" method="post" id="attrib-form">
             <div class="modal-header flex-column text-center bg-primary">
                 <h4 class="modal-title w-100">Attribuer un repertoire</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>
             <div class="modal-body">
                 @csrf
                 <div id="form_result">

                 </div>
                 <div class="form-group">
                     <label for="repertoire">Repertoire : </label>
                     <select name="repertoire_id" id="repertoire" class="form-control">
                         <option value="">Selectionnez un repertoire</option>
                         @foreach($data->repertoires as $folder)
                             <option value="{{ $folder->id }}">{{ $folder->nom }}</option>
                         @endforeach
                     </select>
                     <span class="text-danger" id="repertoire-error"> </span>
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
    <form action="{{ route('user.create') }}" method="post" id="add-form">
        <div class="modal-header flex-column text-center bg-primary">
            <h4 class="modal-title w-100">Ajouter un utilisateur</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            @csrf
            <div id="form_result"></div>
            <div class="form-group">
                <label for="name">Nom : </label>
                <input name="name" id="name" class="form-control">
                <span class="text-danger" id="name-error"> </span>
            </div>
            <div class="form-group">
                <label for="email">Login : </label>
                <input name="email" id="email" class="form-control">
                <span class="text-danger" id="email-error"> </span>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe : </label>
                <input name="password" id="password" class="form-control">
                <span class="text-danger" id="password-error"> </span>
            </div>

            <div class="form-group">
                <label for="Service">Service : </label>
                <select name="service_id" id="service" class="form-control">
                    <option value="">Selectionnez le service</option>
                    @foreach($data->services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger" id="service-error"> </span>
            </div>

            <div class="form-group">
                <label for="role">Service : </label>
                <select name="role" id="role" class="form-control">
                    <option value="">Selectionnez le role</option>
                    <option value="ge">Gérant</option>
                    <option value="cs">Chef de service</option>
                    <option value="se">Employé ordinaire</option>
                </select>
                <span class="text-danger" id="role-error"> </span>
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
            let user_id = "";

            $('.add').click(function(){
                $('#add-form #name').val('');
            });

            //delete
            $('.delete_id').click(function(e){
                user_id = this.id;
            });

            $('#delete .ok').click(function(e){
                e.preventDefault();
                $.ajax({
                    url : "/utilisateurs/delete/"+user_id,
                    type : "GET",
                    success : function()
                    {
                        location.reload()
                    }
                });
            });

            $(".attrib_id").click(function(){
                $("#attrib #hidden_id").val(this.id);
            });



             //edit or unedit
             $('.edit_id').click(function(e){
                e.preventDefault();
                user_id = this.id;
                $.ajax({
                    url : "/utilisateurs/edit/"+user_id,
                    type : "GET",
                    success : function(data)
                    {
                        $("#edit #name").val(data.data.name);
                        $("#edit #email").val(data.data.email);
                        $("#edit #password").val(data.data.password);
                        $("#edit #service").val(data.data.service_id);
                        $("#edit #role").val(data.data.role !="ad" ? data.data.role : "");
                        $("#edit #hidden_id").val(data.data.id);
                    }
                });
            });

            $("#attrib-form").on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    method : "POST",
                    url : "{{ route('folder.attrib') }}",
                    data : $(this).serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#attrib-form #repertoire-error").text(data.errors[0]);
                        }
                        var html = '';

                        if (data.error) {
                            html = '<div class="alert alert-danger">';
                            html += '<p>' + data.error + '</p>';
                            html += '</div>';
                            $('#attrib-form #form_result').html(html);
                        }
                        if(data.success)
                        {
                            html = "";
                            $('error-disp').hide();
                            $("#attrib #repertoire-error").text("");
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#attrib-form #form_result').html(html);
                            $('#attrib-form #repertoire').val("");
                           setTimeout(function(){
                                location.reload();
                            }, 3000);
                        }
                    }
                });
            });

            //submit form
            $('#add-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('user.create') }}",
                    type : "POST",
                    data : $('#add-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#add-form #name-error").text(data.errors[0]);
                            $("#add-form #email-error").text(data.errors[1]);
                            $("#add-form #password-error").text(data.errors[2]);
                            $("#add-form #role-error").text(data.errors[3]);
                            $("#add-form #service-error").text(data.errors[4]);



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
                    url : "{{ route('user.update') }}",
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
