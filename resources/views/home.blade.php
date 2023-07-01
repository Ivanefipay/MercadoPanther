{{-- @extends('layouts.app')

@section('content')
@endsection --}}


<x-app title="Mercado Panther" {{--:sum="2+5" --}}>
	<section class="container">
		<products-list/>
	</section>
	{{-- @foreach ($products as $product)

	    <div class="card" style="width: 18rem;">
		    <img src="..." class="card-img-top" alt="...">
		    <div class="card-body">
			    <h5 class="card-title">{{$product->name}}</h5>
			    <p class="card-text">{{$product->value}}</p>
			    <a href="#" class="btn btn-primary">Go somewhere</a>
		    </div>
	    </div>
	@endforeach --}}
</x-app>

