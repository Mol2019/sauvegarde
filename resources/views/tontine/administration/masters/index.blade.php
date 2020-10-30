@extends('tontine.layouts.base',["title" => "Gestion des tops leaders"])

@section('app-content')
 <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sparkline13-list shadow-reset">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>Liste des tops masters</h1>
                                    
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">

                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="email" data-editable="true">Email</th>
                                                <th data-field="lien" data-editable="true">Lien de parrainage</th>
                                                <th data-field="phone" data-editable="true">Contact</th>
                                                <th data-field="nr" data-editable="false">Nombre de jour restant</th>
                                                <th data-field="sr" data-editable="false">Statut rsd</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $admin)
                                                <tr>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->lien_parainage }}</td>
                                                    <td>{{ "+".$admin->residence->indicatif ." ".$admin->contact1 }}</td>
                                                    <td>
                                                        @if($admin->date_expiration)
                                                            @if($admin->nr > 0)
                                                                {{ $admin->nr }}
                                                            @else
                                                                {{ "Abonnement terminé bloqué utilisateur" }}
                                                            @endif
                                                        @else
                                                            {{ "Non encore adhéré" }}
                                                        @endif
                                                    </td>
                                                    
                                                    <td>
                                                        {{ $admin->sr }}
                                                    </td>

                                                    <td>
                                                        <a class="btn btn-info btn-sm text-white" href="{{ url('/parains/list-filleules/'.$admin->lien_parainage) }}">Filleules</a>
                                                        @if($admin->is_locked)
                                                            <button id="{{ $admin->id }}" data-toggle="modal" data-target="#lock" href="#lock" class="btn btn-success btn-sm lock_id">Débloquer</button>
                                                        @else
                                                            <button id="{{ $admin->id }}" class="btn btn-sm btn-warning lock_id" data-toggle="modal" data-target="#lock" href="#lock">Bloquer</button>
                                                        @endif
                                                        <button id="{{ $admin->id }}" class="btn btn-sm btn-danger delete_id" data-toggle="modal" data-target="#delete" href="#delete">Supprimer</button>
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
        <div class="modal" id="lock">
            <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <h4 class="modal-title w-100">Etes vous sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Voulez vous réelement effectuer cette action ? </p>
                    <div id="confirm-result" class="locke"></div>
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
    </div>
</div>
@endsection


@section('form-modal')
    <form action="{{ route('gestion.parain.create') }}" method="post" id="add-form">
        <div class="modal-header flex-column text-center bg-primary">
            <h4 class="modal-title w-100">Ajouter un nouveau master</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            @csrf
            <div id="form_result"></div>
            <div class="form-group">
                <label for="nom">Nom : </label>
                <input type="text" name="nom" id="nom" class="form-control">
                <span class="text-danger" id="nom-error"> </span>
            </div>
            <div class="form-group">
                <label for="prenoms">Prénom(s) : </label>
                <input type="text" name="prenoms" id="prenoms" class="form-control">
                <span class="text-danger" id="prenoms-error"> </span>
            </div>
            <div class="form-group">
                <label for="email">Email : </label>
                <input type="email" name="email" id="email" class="form-control">
                <span class="text-danger" id="email-error"> </span>
            </div>
            <div class="form-group">
                <label for="contact">Contact : </label>
                <input type="number" name="contact1" id="contact" class="form-control">
                <span class="text-danger" id="contact-error"> </span>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe : </label>
                <input type="password" name="password" id="password" class="form-control">
                <span class="text-danger" id="password-error"> </span>
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
            $('#result-zone').hide();
            $('.btn-reset').click(function(e){
                e.preventDefault();
                $("#nom-error").text("");
                $("#prenoms-error").text("");
                $("#contact-error").text("");
                $("#password-error").text("");
                $("#form").hide();
            });

            //lock or unlock
            $('.lock_id').click(function(e){
                user_id = this.id;
            });

            $('#lock .ok').click(function(e){
                e.preventDefault();
                $.ajax({
                    url : "/user/"+user_id+"/lou/",
                    type : "GET",
                    success : function(data)
                    {

                        var html = "";
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('.locke').html(html);
                        setTimeout(function(){
                            location.reload()
                        },3000)
                    }
                });
            });


            //delete
            $('.delete_id').click(function(e){
                user_id = this.id;
            });

            $('#delete .ok').click(function(e){
                e.preventDefault();
                $.ajax({
                    url : "/user/"+user_id+"/delete/",
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

            //submit form
            $('#add-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('gestion.parain.create') }}",
                    type : "POST",
                    data : $('#add-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#nom-error").text(data.errors[0]);
                            $("#prenoms-error").text(data.errors[1]);
                            $("#contact-error").text(data.errors[2]);
                            $("#password-error").text(data.errors[3]);
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
                            $("#nom-error").text("");
                            $("#prenoms-error").text("");
                            $("#contact-error").text("");
                            $("#password-error").text("");
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
