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
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$game->name}}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>


                </div>
                <div class="btn-group">
                    <a href="/view-details/{{$game->id}}" class="btn btn-primary mx-1 my-1">View details</a>
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

            </div>
        </div>
        @endforeach


    </div>
</div>
@endsection