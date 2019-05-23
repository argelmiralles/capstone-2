@extends('layouts.template-height-auto-all-sizes')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-3" id="game-list-banner">
            <img src="/images/gamelist1.png" class="img-fluid" alt="">
        </div>
    </div>
    <hr>

    <div class="row ">
        <div class="col-8 ">
            <a href="/game-list" class="btn btn-success mx-1 my-5">All</a>
            @foreach(\App\Category::all() as $category)
            <a href="/game-list/category/{{$category->id}}" class="btn btn-success mx-1 my-5"> {{$category->name}} </a>
            @endforeach
        </div>
        <div class="col-4">
            @include('layouts.includes.search-bar')
        </div>
    </div>
    <div class="row">

        @foreach ($games as $game)
        <div class="col-12 col-lg-3 my-2 d-flex align-items-stretch">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{$game->name}}</h5>
                    <h6>{{$game->subtitle}}</h6>
                </div>
                <div class="card-body">
                    <img class="card-img-bottom" src="/{{$game->img_path}}" alt="Card image cap">
                </div>
                @if(Auth::user() != null && Auth::user()->role_id == 2 )
                <h5>Copies remaining : {{$game->quantityInStock}}</h5>
                <div class="btn-group">
                    <button class="btn btn-primary mx-1 my-1" data-toggle="modal"
                        data-target="#viewDetails{{$game->id}}">View
                        Details</button>
                @if($game->quantityInStock==0)
                    <a href="#" class="btn btn-danger my-1 mr-1">Out of Stock</a>
                @else
                    <button class="btn btn-primary mr-1 my-1" data-toggle="modal"
                        data-target="#rent{{$game->id}}">Rent</button>
                </div>
                @endif
                @else
                <div class="btn-group">
                    <button class="btn btn-primary mx-1 my-1" data-toggle="modal"
                        data-target="#viewDetails{{$game->id}}">View
                        Details</button>


                    <a href="/edit-games/{{$game->id}}" class="btn btn-success mr-1 my-1">Edit</a>
                </div>
                <div class="btn-group">
                    <button class="btn btn-danger mx-1 mb-1" data-toggle="modal"
                        data-target="#confirmDelete{{$game->id}}">Delete</button>
                </div>
                @endif

            </div>
        </div>


        {{-- RENT MODAL --}}
        <div id="rent{{$game->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Adding {{$game->name}} to your basket?</h4>
                    </div>
                    <div class="modal-body">
                        <h5>{{$game->name}}</h5>
                        <h6>{{$game->subtitle}}</h6>
                        <h5>Price per week: &#8369 {{number_format($game->price,0,".",",")}}</h5>
                        <form action="/add-to-basket/{{$game->id}}" method="POST">
                            {{ csrf_field() }}
                            <p>Please enter how long (in weeks) you'll be renting this game.</p>
                            <div class="form-group">
                                <label for="week">Weeks</label>
                                <input value="1" type="number" name="week" id="week" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add to Basket</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- DELETE MODAL --}}
        <div id="confirmDelete{{$game->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Confirm Delete</h4>
                    </div>
                    <div class="modal-body">
                        <p>Do you want to delete the item?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="/delete-game/{{$game->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field("DELETE") }}
                            <button type="submit" class="btn btn-primary">Delete</button>
                            <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- VIEW DETAILS MODAL --}}
        <div id="viewDetails{{$game->id}}" class="modal fade bd-example-modal-lg" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="container my-5 p-5" id="view-details">
                    <div class="row">
                        <div class="col-6">
                            {{-- LEFT SIDE --}}
                            <h4>{{$game->name}}</h4>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe width="1280" height="720"
                                    src="https://www.youtube.com/embed/{{$game->trailer_link}}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            {{-- PUBLISHER/DEVELOPER --}}
                            <div class="row">
                                <div class="col-6">
                                    <p>Publisher: {{$game->published_by}}</p>
                                </div>
                                <div class="col-6">
                                    <p>Developer: {{$game->developed_by}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    Year Released: {{$game->releaseYear}}
                                </div>
                                <div class="col-6">
                                    Metacritic Score: {{$game->review}}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            {{-- RIGHT SIDE --}}
                            <p>{{$game->description}}</p>
                            @if($game->quantityInStock > 0)
                            <p>Game is Available for Rent</p>
                            @else
                            <p>Sorry, the game is not vailable for Rent</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

    </div>
</div>

@endsection