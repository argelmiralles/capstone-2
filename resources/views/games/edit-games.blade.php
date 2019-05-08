@extends("layouts.template-height-auto")

@section('content')
<div class="container">
    <div class="container mt-5 pt-3 pb-5" id="edit-item-form">
        <h1>Edit Item Form</h1>


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
                <form action="/edit/{{$game->id}}" method="POST">
                    @csrf
                    {{ method_field("PATCH") }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input value="{{$game->name}}" type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"
                            id="description">{{$game->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input value="{{$game->price}}" type="number" name="price" class="form-control" id="price">
                    </div>

                    <div class="form-group">
                        <label for="image">Image: </label>
                        <img src="{{$game->img_path}}" alt="">
                        <div><input type="file" name="image" id="image"></div>
                    </div>

                    <div class="form-group">
                        <label for="category">Category: </label>
                        <select name="category_id" id="category" class="form-control">

                            @foreach (\App\Category::all() as $category)
                            <option value="{{$category->id}}"
                                {{ $category->id == $game->category_id ? "selected" : ""}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="col-12 col-lg-6">

                <div class="form-group">
                    <label for="publisher">Published by: </label>
                    <input value="{{$game->published_by}}" type="text" name="published_by" class="form-control"
                        id="publisher">
                </div>

                <div class="form-group">
                    <label for="developer">Developed by: </label>
                    <input value="{{$game->developed_by}}" type="text" name="developed_by" class="form-control"
                        id="developer">
                </div>

                <div class="form-group">
                    <label for="quantity">Add copies</label>
                    <div class="alert alert-warning" role="alert">
                        <h6>IMPORTANT NOTE</h6>
                        <p>The value entered here will be the <strong>new number of
                                copies</strong>.
                            If there are no changes in the number of copies, leave this. If there are changes, add the
                            copies to the current number of copies and add it here.
                        </p>
                    </div>
                    <span></span>
                    <input value="{{$game->quantityTotal}}" type="number" name="quantityTotal" class="form-control"
                        id="quantity">
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
                    <input value="{{$game->review}}" type="number" name="review" class="form-control" id="score">
                </div>

                <button type="submit" class="btn btn-success">Edit Game</button>


                </form>
            </div>
        </div>

        @endsection