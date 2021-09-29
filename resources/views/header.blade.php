 <!-- container section start -->
<header class="card-header">
  <a href="/"> Home </a>
  <div class="top-left">
  @if (Route::has('login'))
    @auth
    
     <a href="{{ url('/home')}}">Favorites</a>
</div>

    @else
     <a class="btn btn-info" href="{{ route('login') }}">Login</a>
      @endauth
    @endif
</header>

