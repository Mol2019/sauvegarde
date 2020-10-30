@extends('tontine.layouts.base',["title" => "Tableau de bord"])

@section('app-content')
<!-- income order visit user Start -->
    <div class="income-order-visit-user-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Lien de parainage</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h4><span class="counter">{{ url("/")."/register/".$data["lienParainage"] }}</span></h4>
                                </div>
                                <div class="price-graph">
                                </div>
                            </div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Groupe télégramme</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3>
                                        <span class="counter">
                                           <a href="https://t.me/joinchat/SHu9hBs7gFSQPqf_lmhK7w">Intégrer le groupe télégramme</a>
                                        </span>
                                    </h3>
                                </div>
                                <div class="price-graph">
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Dernier investissement</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3><span class="counter">{{ $data["dernierI"] }}</span></h3>
                                </div>
                                <div class="price-graph">
                                    <span id="sparkline2"></span>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Total rsd en attente</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3><span class="counter">{{ $data["fullRsd"] }}</span></h3>
                                </div>
                                <div class="price-graph">
                                    <span id="sparkline2"></span>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Fusions en attente</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3><span class="counter">{{ $data["fusionCount"] }}</span></h3>
                                </div>
                                <div class="price-graph">
                                    <span id="sparkline2"></span>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="income-dashone-total shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Mes bonus parain</h2>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3>
                                        <span class="counter">
                                           {{ $data["leadersCount"] }}
                                        </span>
                                    </h3>
                                </div>
                                <div class="price-graph">
                                    <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#form" href="#form"  href="{{ route('bonus.reclame') }}">Je reclame mon bonus</a>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!-- income order visit user End -->
@endsection

@section('form-modal')
    <form action="" method="post" id="add-form">
        <div class="modal-header flex-column text-center bg-primary">
            <h4 class="modal-title w-100">Ajouter un nouveau don</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            @csrf
            <div id="form_result"></div>
            <div class="form-group">
                <label for="pack">Selectionnez un montant: </label>

                    <select name="montant" id="pack" class="form-control">
                        <option value="">Prendre un pack</option>
                    @foreach($data['packs'] as $pack)
                        @if($pack->montant < $data["leadersCount"])
                            <option value="{{ $pack->id }}">{{ $pack->montant }}</option>
                         @endif
                    @endforeach
                </select>
                <span class="text-danger" id="pack-error"> </span>
            </div>
            <input type="hidden" name="hidden_id" value="{{ Auth::user()->id }}" id="">
        </div>
        <div class="modal-footer justify-content-center">
            <button type="reset" class="btn btn-default btn-reset" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>
@endsection


@section('scripts')
<script>
    //submit form
    $('#add-form').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url : "{{ route('bonus.reclame') }}",
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
</script>
@endsection