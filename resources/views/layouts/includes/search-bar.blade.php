<div>
    <form class="form-inline active-pink-3 active-pink-4" action='/search' method="GET">
        @csrf
        <i class="fas fa-search" aria-hidden="true"></i>
        <input name="search" class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
            aria-label="Search" value="{{request()->input('search')}}">
    </form>
</div>