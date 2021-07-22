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
				<div class="col-md-12 text-center mb-5 pb-5">
					<h3 class="mb-0">Crear un Método de Envío</h3>
					<form action="{{route('shipping_method.create')}}" method="post">
						@csrf
						<div class="form-group">
							<label for="shipping_method">Nuevo Método</label>
							<input 
								type="text" 
								class="form-control" 
								id="shipping_method" 
								placeholder="Ej: Correo Andreani"
								name="method"
								value="{{old('method')}}"
							>
							@error('method')
								<small class="text-danger"> {{$message}} </small>
							@enderror
						</div>
						<input type="submit" value="Añadir" class="btn btn-success">
					</form>
				</div>
				<div class="col-md-12 text-center mb-3">
					<h3 class="mb-0">Administrar Métodos de Envío</h3>
					<small>La opción de retiro en el local no es editable.</small>
					<br>
				</div>
				@foreach ($shipping_methods as $method)
					<div class="col-md-4">
						<div class="card">
							<div class="card-body mr-3">
								<div class="row">
									<div class="col-md-8 text-capitalize">
										<h6>{{$method['method']}}</h6>
									</div>
									<div class="col-md-2">
										<a
											class="btn btn-icon btn-primary btn-sm"
											data-toggle="tooltip"
											data-placement="bottom"
											title="Editar Producto"
											data-container="body"
											data-animation="true"
											href="/product/edit/${product.id}"
										>
											<i class="ni ni-ruler-pencil"></i>
										</a>
									</div>
									<div class="col-md-2">
										<button
											class="btn btn-icon btn-danger btn-sm"
											data-toggle="tooltip"
											data-placement="bottom"
											title="Eliminar Producto"
											data-container="body"
											data-animation="true"
											onclick="showModal(${product.id})"
										>
											<i class="ni ni-fat-remove"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
