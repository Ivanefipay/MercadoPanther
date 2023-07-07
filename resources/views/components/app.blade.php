<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mercado Panther</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
	{{-- menu --}}

	<nav class="navbar navbar-expand-md navbar-light  shadow-sm  imgHome">
		<div class="container" >
			<a class="navbar-brand text-white fs-1" href="{{ url('/home') }}">Mercado Panther</a>
			{{-- haburguesa --}}
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- Left Side Of Navbar -->
				<ul class="navbar-nav me-auto">

				</ul>

				<!-- Right Side Of Navbar -->
				<ul class="navbar-nav ms-auto">
					<!-- Authentication Links -->
					@guest
						@if (Route::has('login'))
							<li class="nav-item ">
								<a class="nav-link text-white fs-5" href="{{ route('login') }}">{{ __('Login') }}</a>
							</li>
						@endif

						@if (Route::has('register'))
							<li class="nav-item">
								<a class="nav-link text-white fs-5" href="{{ route('register') }}">{{ __('Register') }}</a>
							</li>
						@endif
					@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle text-white fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								Bienvenido {{ Auth::user()->full_name }}
							</a>

							<div class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdown">
								@role('admin')
								<a class="dropdown-item fs-6" href="{{ route('users') }}">Usuarios</a>
								<a class="dropdown-item fs-6" href="{{ route('products') }}">Productos</a>
								@endrole
								<a class="dropdown-item fs-6 " href="{{ route('sales') }}">Ir a carrito
								</a>
								<a class="dropdown-item fs-6" href="{{ route('logout') }}"
								   onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
						</li>
					@endguest
				</ul>
			</div>
		</div>
	</nav>


	{{-- content --}}
	<main id="app">
	    {{$slot}}
		{{-- {{$sum}} --}}
    </main>

</body>
</html>
