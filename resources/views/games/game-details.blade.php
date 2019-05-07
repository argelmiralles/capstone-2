@extends('layouts.template')

@section('content')
<div class="container my-5 p-2" id="view-details">
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


@endsection