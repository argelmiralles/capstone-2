@extends('layouts.template-height-auto-all-sizes')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="cole-lg-12">
            <table class="table table-striped table-light">
                <thead>
                    <tr>
                        <th>Requests</th>
                        <th>Total</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td>{{$request->created_at->diffForHumans()}}</td>
                        <td>{{number_format($request->total, 2, ".", ".")}}</td>
                        <td>
                            @foreach($request->games as $game)
                            <p>{{$game->name}} : {{$game->pivot->quantity}}</p>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection