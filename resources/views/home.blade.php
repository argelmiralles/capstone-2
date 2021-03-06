@extends('layouts.template-height-auto-all-sizes')

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
                <a href="/game-list" class="btn btn-block my-1 pt-2" id="games">
                    <h5>Available Games</h5>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="/basket" class="btn btn-block my-1 pt-2" id="basket">
                    <h5>Basket</h5>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="/rent_requests" class="btn btn-block my-1 pt-2" id="transactions">
                    <h5>Transactions</h5>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="/edit-profile" class="btn btn-block my-1 pt-2" id="edit-profile">
                    <h5>Edit Profile</h5>
                </a>
            </div>
        </div>
    </div>
</div>
@else
{{-- ADMIN SECTION --}}
<div class="container mt-5">
    <div class="container on-page-nav">
        <div class="row">
            <div class="col-12 col-lg-3">
                <a href="/game-list" class="btn btn-block my-1 pt-2" id="games">
                    <h5>Edit / Delete Games</h5>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="/all_requests" class="btn btn-block my-1 pt-2" id="basket">
                    <h5>User Requests</h5>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="/rent_requests" class="btn btn-block my-1 pt-2" id="transactions">
                    <h5>Add Games</h5>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="/edit-profile" class="btn btn-block my-1 pt-2" id="edit-profile">
                    <h5>Edit Profile</h5>
                </a>
            </div>
        </div>
    </div>
</div>


@endif


@endsection