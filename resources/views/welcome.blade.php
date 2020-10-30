@extends('layouts.index')

@section("content")
    <div class="tm-row">
        <div class="tm-col-left"></div>
        <main class="tm-col-right">
            <section class="tm-content">
                <h2 class="mb-5 tm-content-title">TOP INVESTISSEMENT</h2>
                <p class="mb-5">Notre communauté d'entraide Topinvestissement est un système d'entraide participatif qui permettra à ses membres en quête de revenu pour réaliser leur projet de pouvoir les atteindre.</p>
                <hr class="mb-5">
                <a href="{{url('/login')}}" class="btn btn-primary">Participer...</a>
            </section>
        </main>
    </div>
@endsection    
