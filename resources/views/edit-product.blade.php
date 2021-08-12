@extends('layout.app', ['class' => 'bg-secondary']) @section('content') @include('layout.navbar')
<div class="container-fluid mt-6">
	<div class="card mb-4">
		<div class="card-header">
			<h3 class="mb-0 text-capitalize">Editando: {{$product->title}}</h3>
		</div>
		<div class="card-body">@include('sections.edit-product-form', ['product' => $product, 'categories' => $categories])</div>
	</div>
</div>
@endsection