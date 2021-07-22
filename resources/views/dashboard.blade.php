@extends('layout.app', ['class' => 'bg-secondary']) @section('content') @include('layout.navbar')
<div class="container-fluid mt-6">
	@if (Session::has('message'))
		<div class="alert alert-success my-5" role="alert">
			<strong>Éxito!</strong> {{Session::get('message')}}
		</div>
	@endif
	<div class="card mb-4">
		<div class="card-header">
			<h3 class="mb-0">Añadir un Producto</h3>
		</div>
		<div class="card-body">@include('sections.create-product-form')</div>
		<div class="card-footer">
			@include('sections.search-products')
		</div>
	</div>
	<div class="card mb-4">
		<div class="card-header">
			<h3 class="mb-0">Administrar Envíos</h3>
		</div>
		<div class="card-body">
			<div class="col-md-12 row justify-content-around">
				@include('sections.create-shipping-method-form')
				
				@include('sections.list-shipping-methods', ['shipping_methods' => $shipping_methods])
			</div>
		</div>
		<div class="card-footer">
			@include('sections.create-shipping-zone-form', ['shipping_methods' => $shipping_methods])
		</div>
	</div>
</div>
@endsection
