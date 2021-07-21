@extends('layout.app', ['class' => 'bg-secondary']) @section('content') @include('layout.navbar')
<div class="container-fluid mt-6">
	<div class="card mb-4">
		<div class="card-header">
			<h3 class="mb-0">Añadir un Producto</h3>
		</div>
		<div class="card-body">
			@include('sections.create-product-form')
		</div>
		<div class="card-footer">
			<h3 class="mt-0">Editar un Producto</h3>
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="form-group">
						<label class="form-control-label"
							>Buscar Producto:</label
						>
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder='Ej: Shield 24" Rojo'>

							<div class="input-group-append">
							  <button class="btn btn-outline-primary" type="button" id="button-addon2">Buscar</button>
							</div>
						  </div>
					</div>
				</div>
				<div class="col-md-12 text-center">
					<div class="spinner-border text-primary" role="status">
						<span class="sr-only">Cargando...</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection