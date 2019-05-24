@extends('layouts.template-height-auto-all-sizes')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="cole-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-light">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Date Requested</th>
                            <th>Total</th>
                            <th>Game</th>
                            <th>Week</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Rent Start Date</th>
                            <th>Rent End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $rent_request)
                        <tr>
                            <td>{{\App\User::find($rent_request->user_id)->email}}</td>
                            <td>{{$rent_request->created_at->diffForHumans()}}</td>
                            <td>{{number_format($rent_request->total, 2, ".", ".")}}</td>
                            <td>
                                @foreach($rent_request->games as $game)
                                <p>{{$game->name}}</p>
                                @endforeach
                            </td>
                            <td>@foreach($rent_request->games as $game)
                                <p>{{$game->pivot->week}}</p>
                                @endforeach
                            </td>
                            <td>
                                {{\App\Status::find($rent_request->status_id)->name}} @if($rent_request->on_rent): On
                                Rent
                                @endif
                            </td>
                            <td>
                                @if($rent_request->status_id == 1)
                                {{-- IF PENDING = Show Aprove and Decline buttons --}}
                                <form action="/cancel/{{$rent_request->id}}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Cancel</button>
                                </form>
                                @else
                                @endif
                            </td>
                            <td>
                                @if($rent_request->rent_start_date != null)
                                {{$rent_request->rent_start_date}}
                                @else
                                <p>N/A</p>
                                @endif
                            </td>
                            <td>
                                @if($rent_request->rent_end_date != null)
                                {{$rent_request->rent_end_date}}
                                @else
                                <p>N/A</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection