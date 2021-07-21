@extends('layout.app', ['class' => 'bg-secondary']) @section('content') @include('layout.navbar')
<div class="container-fluid mt-6">
	<div class="card mb-4">
		<div class="card-header">
			<h3 class="mb-0">Añadir un Producto</h3>
		</div>
		<div class="card-body">@include('sections.create-product-form')</div>
		<div class="card-footer">
			@include('sections.search-products')
		</div>
	</div>
</div>
@endsection
