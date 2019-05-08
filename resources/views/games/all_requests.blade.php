@extends('layouts.template-height-auto-all-sizes')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-light">
                @if(Session::has("out_of_stock"))
                <div class="container">
                    <div class="alert alert-danger" role="alert">
                        {{Session::get("out_of_stock")}}
                    </div>
                </div>
                @endif
                <thead>
                    <tr>
                        <th>Requester</th>
                        <th>Username</th>
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
                        <td>
                            {{\App\User::find($rent_request->user_id)->first_name}}
                            {{\App\User::find($rent_request->user_id)->last_name}}
                        </td>
                        <td>
                            {{\App\User::find($rent_request->user_id)->username}}
                        </td>
                        <td>
                            {{\App\User::find($rent_request->user_id)->email}}
                        </td>
                        <td>{{$rent_request->created_at}}</td>
                        <td>{{number_format($rent_request->total, 2, ".", ".")}}</td>
                        <td>
                            @foreach($rent_request->games as $game)
                            <p>{{$game->name}}</p>
                            @endforeach
                        </td>
                        <td>
                            @foreach($rent_request->games as $game)
                            <p>{{$game->pivot->week}}</p>
                            @endforeach

                        </td>
                        <td>
                            {{\App\Status::find($rent_request->status_id)->name}} @if($rent_request->on_rent): On Rent
                            @endif
                        </td>
                        <td>
                            @if($rent_request->status_id == 1)
                            {{-- IF PENDING = Show Aprove and Decline buttons --}}
                            <form action="/approval/{{$rent_request->id}}" method="POST">
                                @csrf
                                <input type="hidden" name="game" value='{{$game->id}}'>
                                <input type="hidden" name="week" value='{{$game->pivot->week}}'>
                                <button class="btn btn-success" type="submit">Approve - start rent</button>
                            </form>
                            <form action="/disapproval/{{$rent_request->id}}" method="POST">
                                @csrf
                                <button class="btn btn-danger" type="submit">Disapprove</button>
                            </form>
                            @endif
                            {{-- IF APPROVED = Show Returned button--}}
                            @if($rent_request->status_id == 2)
                            <form action="/returned/{{$rent_request->id}}" method="POST">
                                @csrf
                                <button class="btn btn-primary" type="submit">Returned?</button>
                            </form>
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
                            @if(Carbon\Carbon::now() < $rent_request->rent_end_date)
                                Less
                                @else
                                Overdue
                                @endif

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
@endsection