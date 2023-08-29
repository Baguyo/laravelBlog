<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Home</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a href={{ route('home') }} class="nav-link">{{ __('Home') }} </a>
                    </li>
                    <li class="nav-item">
                        <a href={{route('contact')}} class="nav-link">{{ __('Contact') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('posts.index') }} class="nav-link">{{ __('Blog Posts') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('posts.create')}}" class="nav-link">{{ __('Add') }}</a>
                    </li>

                    @guest

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{route('register')}}" class="nav-link">{{ __('Register') }}</a>
                            </li>    
                        @endif

                        <li class="nav-item">
                            <a href="{{route('login')}}" class="nav-link">{{ __('Login') }}</a>
                        </li>
                        
                    @else
                    
                        {{-- {{Auth::user()->id}} --}}
                        <li class="nav-item">
                            <a href="{{ route('logout')}}" class="nav-link" id="logoutBtn">{{ __('Logout') }} ( {{Auth::user()->name}} )  </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('users.show', ['user' => Auth::user()->id])}}" class="nav-link">{{ __('Profile') }}</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('users.edit', ['user' => Auth::user()->id])}}" class="nav-link"> {{ __('Edit') }}  {{ __('Profile') }}</a>
                        </li>

                        <form action="{{ route('logout') }}" method="post" id="formLogout" class="d-none" >

                        @csrf</form>
                    

                        
                    @endguest

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li> --}}
                </ul>
                {{-- <form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> --}}
            </div>
        </div>
        
    </nav>
    <div class="container mt-5">
        @yield('content')
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script>


        $('#logoutBtn').click(function (e) { 
            e.preventDefault();
            $('#formLogout').submit();
            
        });
    </script>
</body>
</html>