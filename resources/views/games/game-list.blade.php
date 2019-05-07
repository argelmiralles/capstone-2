@extends('layouts.template-height-auto')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mt-3" id="game-list-banner">
            <img src="/images/gamelist1.png" class="img-fluid" alt="">
        </div>
    </div>
    <div class="row">
        @foreach ($games as $game)
        <div class="col-12 col-lg-4 col-xl-3 mx-2 my-2">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    <h5 class="card-title">{{$game->name}}</h5>
                </div>
                <div class="card-body">
                <img class="card-img-bottom" src="{{$game->img_path}}" alt="Card image cap">
                </div>
                <div class="btn-group">
                  <button class="btn btn-primary mx-1 my-1" data-toggle="modal"
                  data-target="#viewDetails">View Details</button>
                  @if(Auth::user() != null && Auth::user()->role_id == 2 )
                  <a href="#" class="btn btn-success mr-1 my-1">Rent</a>
                  @else
                  <a href="/edit-games/{{$game->id}}" class="btn btn-success mr-1 my-1">Edit</a>
                  @endif
              </div>
              <div class="btn-group">
                <button class="btn btn-danger mx-1 mb-1" data-toggle="modal"
                data-target="#confirmDelete">Delete</button>
            </div>

            {{-- DELETE MODAL --}}
            <div id="confirmDelete" class="modal fade" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <modal class="modal-header">
                            <h4>Confirm Delete</h4>
                        </modal>
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
            <div id="viewDetails" class="modal fade bd-example-modal-lg" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="container my-5 p-5" id="view-details">
                        <div class="row">
                            <div class="col-6">
                                {{-- LEFT SIDE --}}
                                <h4>{{$game->name}}</h4>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe width="1280" height="720" src="https://www.youtube.com/embed/{{$game->trailer_link}}"
                                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
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
                                    <a href="#" class="btn btn-success mr-1 my-1">Rent</a>
                                    @else
                                    <p>Sorry, the game is not vailable for Rent</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
@endsection