<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <span class="navbar-brand">
      <h3 id="nav-brand">
        <i class="far fa-square square"></i> squareshare
      </h3>
    </span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/game-list">Games</a>
        </li>
        @if(Auth::user() != null && Auth::user()->role_id == 2 )
        <li class="nav-item">
          <a class="nav-link" href="/rent_requests">Rent Requests</a>
        </li>
        @else
        <li class="nav-item">
          <a href="/all_requests" class="nav-link">Requests</a>
        </li>
        @endif
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>