@extends('layouts.template-height-auto-all-sizes')

@section('content')
<div class="container mt-5 p-5" style="background-color: #f2f2f2" ;>
    <div class="row">


    </div>
    <div class="row">
        <div class="col-lg-12">
            @if($basket_with_details !=null)
            <div class="container" style="overflow-x:auto;">
                <div class="table-responsive">
                    <table class="table table-striped table-light">
                        <thead>
                            <h1 class="my-2">Basket</h1>
                            @if(Session::has("basket_full"))
                            <div class="container">
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get("basket_full")}}
                                </div>
                            </div>
                            @endif
                            @if(Session::has("success_basket"))
                            <div class="container">
                                <div class="alert alert-success" role="alert">
                                    {{Session::get("success_basket")}}
                                </div>
                            </div>
                            @endif
                            <tr>
                                <th>Game</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Period</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($basket_with_details as $game)
                            <tr>
                                <td>{{$game->name}}</td>
                                {{-- <td>{{$item->quantity}}</td> --}}
                                <td>
                                    {{$game->quantity}}
                                </td>
                                <td>&#8369 {{$game->price}}</td>
                                <td>
                                    <form class="form-inline" method="POST" action="/basket/{{$game->id}}/editWeek">
                                        {{ csrf_field() }}
                                        {{ method_field("PATCH") }}
                                        <input class="form-control" type="number" name="week" id="week"
                                            value="{{$game->week}}" min="1">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Edit Week</button>
                                    </form>
                                </td>
                                <td>&#8369 {{number_format($game->subtotal)}}</td>
                                <td>
                                    <form action="/basket/{{$game->id}}/delete">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total: </td>
                                <td>{{$total}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <a href="/basket/clearBasket" class="btn btn-danger" style="float:right;">Clear Basket</a>
                <a href="/sendRequest" class="btn btn-primary">Checkout</a>
                @else
                <h2>Cart is empty</h2>
                @endif

                <a href="/game-list" class="btn btn-primary">Back to games</a>
            </div>
        </div>
    </div>
</div>
@endsection