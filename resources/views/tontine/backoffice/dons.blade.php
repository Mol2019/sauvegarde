@extends('tontine.layouts.base',["title" => "Gestion des dons & fusions"])

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
                             <div class="sparkline13-outline-icon">
                                @if(!Auth::user()->is_locked)
                                    <span  style="cursor:pointer;" data-toggle="modal" data-target="#form"><i class="fa fa-plus"></i> Faire un don</span>
                                @else
                                    <span> 
                                        <a href="{{ route('abonnement.ask',Auth::user()->id) }}" class="btn btn-success">Faire votre abonnement</a>
                                    </span>    
                                @endif
                            </div> 
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="montant" data-editable="true">Montant</th>
                                        <th data-field="make">Fait le </th>
                                        <th data-field="sendto">Envoyé à </th>
                                        <th data-field="sendto">Téléphone </th>
                                        <th data-field="reference">Référence</th>
                                        <th data-field="action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->fusions as $fusion)
                                        <tr>
                                            <td>{{ $fusion->montant }}</td>
                                            <td>{{ $fusion->envoyeur->date_envoie }}</td>
                                            <td>{{ $fusion->receveur->nom ." ".$fusion->receveur->prenoms }}</td>
                                            <td>{{ "+".$fusion->receveur->residence->indicatif ." ".$fusion->receveur->contact1 }}</td>
                                            <td>{{ $fusion->reference ?? $fusion->references}}</td>
                                            <td>
                                                <button id="{{ $fusion->envoyeur->id }}" class="btn btn-info fusion_id" name="{{ $fusion->type }}" data-toggle="modal" data-target="#valideReferences">J'ai envoyé mon don</button>
                                                <button id="{{ $fusion->envoyeur->id }}" class="btn btn-danger delete_id" data-toggle="modal" data-target="#delete" href="#delete">Supprimer</button>
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
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Mes dons à l'administration</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                 <thead>
                                    <tr>
                                        <th data-field="montant" data-editable="true">Montant</th>
                                        <th data-field="sendto">Téléphone </th>
                                        <th data-field="reference">Référence</th>
                                        <th data-field="action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->bonus as $fusion)
                                        <tr>
                                            <td>{{ $fusion->montant }}</td>
                                            <td>{{ "+".$fusion->user->residence->indicatif ." ".$fusion->user->contact1 }}</td>
                                            <td>{{ $fusion->reference ?? $fusion->references}}</td>
                                            <td>
                                                <button id="{{ $fusion->id }}" class="btn btn-info bonus_id" data-toggle="modal" data-target="#valideBonusReferences">J'ai envoyé mon bonus</button>
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
<div class="modal" id="lock">
             <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <h4 class="modal-title w-100">Etes vous sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez vous réelement effectuer cette action ? </p>
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
            <h4 class="modal-title w-100">Modifier votre don</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
                    <div class="modal-body">
                            @csrf
                            <div id="form_result">

                            </div>
                            <div class="form-group">
                                <label for="pack">Choisir un pack : </label>
                                <select name="pack" id="pack" class="form-control">
                                    <option value="">Prendre un pack</option>
                                    @foreach($data->packs as $pack)
                                        <option value="{{ $pack->id }}">{{ $pack->titre ."-".$pack->montant }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="pack-error"> </span>
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
                                <label for="pack">Saisir la référence : </label>
                                <input type="text" name="reference" class="form-control">
                                <span class="text-danger" id="reference-error"> </span>
                            </div>
                            <input type="hidden" name="hidden_id" id="hidden_id" >
                            <input type="hidden" name="type" id="type" >

                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="reset" class="btn btn-default btn-reset" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal" id="valideBonusReferences">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post" id="valideB-form">
                        <div class="modal-header flex-column text-center bg-primary">
                            <h4 class="modal-title w-100">Veuillez fournir la référence de votre paiement</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div id="form_result"></div>
                            <div class="form-group">
                                <label for="pack">Saisir la référence : </label>
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
@section('form-modal')
    <form action="{{ route('don.add') }}" method="post" id="add-form">
        <div class="modal-header flex-column text-center bg-primary">
            <h4 class="modal-title w-100">Ajouter un nouveau don</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            @csrf
            <div id="form_result"></div>
            <div class="form-group">
                <label for="pack">Choisir un pack : </label>
                <select name="pack" id="pack" class="form-control">
                    <option value="">Prendre un pack</option>
                    @foreach($data->packs as $pack)
                        <option value="{{ $pack->id }}">{{ $pack->titre ."-".$pack->montant }}</option>
                    @endforeach
                </select>
                <span class="text-danger" id="pack-error"> </span>
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
            let don_id = "";
            let fusion_id = "";
            let bonus_id = "";

            $('.bonus_id').click(function(e){
                bonus_id = this.id;
                $('#valideB-form #hidden_id').val(this.id);
            })




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
                    url : "{{ route('don.valide') }}",
                    type : "POST",
                    data : $('#valide-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#valide-form #reference-error").text(data.errors[0]);
                        }
                        var html = '';

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

         //submit form
            $('#valideB-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('bonus.valide') }}",
                    type : "POST",
                    data : $('#valideB-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#valideB-form #reference-error").text(data.errors[0]);
                        }
                        var html = '';

                        if(data.success)
                        {
                            html = "";
                            $("#valideB-form #reference-error").text("");
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
