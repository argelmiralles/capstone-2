@extends('layouts.template-height-auto')

@section('content')
<div class="container mt-5 pt-3 pb-5" id="add-item-form">
    <h1>Add Item Form</h1>


    <div class="row">
        @if(Session::has("message"))
        {{Session::get("message")}}
        @endif
        @if(count($errors)>0)
        @foreach ($errors as $error)
        <p>{{$error}}</p>
        @endforeach
        @endif
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <form action="/games" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Game Name (Ex. Uncharted 4, Horizon, The Last Of Us)</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle (Ex. A Thief's End, Zero Dawn, Remastered)</label>
                    <input type="text" name="subtitle" class="form-control" id="subtitle">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" id="price">
                </div>

                <div class="form-group">
                    <label for="image">Image: </label>
                    <div><input type="file" name="image" id="image"></div>
                </div>

                <div class="form-group">
                    <label for="category">Category: </label>
                    <select name="category_id" id="category" class="form-control">
                        <option disabled selected>Select Category</option>
                        @foreach (\App\Category::all() as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="trailer_link">Youtube ID: </label>
                    <div class="alert alert-warning" role="alert">
                        <h6>IMPORTANT NOTE</h6>
                        <p>(Copy everything after the <strong>"=" or equal sign</strong> in the Youtube
                            link. Example:<strong>"AaOWRvmtEFQ"</strong> from
                            https://www.youtube.com/watch?v=AaOWRvmtEFQ)
                        </p>
                    </div>
                    <input type="text" name="trailer_link" class="form-control" id="trailer_link">
                </div>
        </div>
        <div class="col-12 col-lg-6">

            <div class="form-group">
                <label for="publisher">Published by: </label>
                <input type="text" name="published_by" class="form-control" id="publisher">
            </div>

            <div class="form-group">
                <label for="developer">Developed by: </label>
                <input type="text" name="developed_by" class="form-control" id="developer">
            </div>

            <div class="form-group">
                <label for="quantity">Number of copies</label>
                <input type="number" name="quantityTotal" class="form-control" id="quantity">
            </div>
            <div class="form-group">
                <label for="year">Year of release: </label>
                <select name="releaseYear" id="year" class="form-control">
                    <option disabled selected>Year</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                </select>
            </div>
            <div class="form-group">
                <label for="score">Metacritic Score: </label>
                <input type="number" name="review" class="form-control" id="score">
            </div>

            <button type="submit" class="btn btn-success">Add Game</button>



            </form>
        </div>
    </div>

</div>
@endsection