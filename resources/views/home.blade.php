@extends('layouts.template')

@section('content')
@if(Auth::user()->role_id == 2)
{{-- MEMBER SECTION --}}
<div class="container">
    <div class="jumbotron mt-5" id="home-member">
        <div class="row mt-5">
            <div class="col-12 jumbo-contents mt-5">
                <h1 id="jumbo-brand">
                    <i class="far fa-square square"></i> squareshare
                </h1>
                <h4 class="sub-brand"><span id="rent">RENT</span> | <span id="play">PLAY</span> | <span
                        id="repeat">REPEAT</span> </h4>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="container on-page-nav">
        <div class="row">
            <div class="col-12 col-lg-3">
                <a href="#" class="btn btn-block my-1" id="games">
                    <h5>Available Games</h5>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="#" class="btn btn-block my-1" id="basket">
                    <h5>Basket</h5>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="#" class="btn btn-block my-1" id="transactions">
                    <h5>Transactions</h5>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="#" class="btn btn-block my-1" id="edit-profile">
                    <h5>Edit Profile</h5>
                </a>
            </div>
        </div>
    </div>
</div>
@else
{{-- ADMIN SECTION --}}



@endif


@endsection