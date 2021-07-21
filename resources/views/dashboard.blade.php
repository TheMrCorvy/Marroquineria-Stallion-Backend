@extends('layout.app', ['class' => 'bg-secondary']) @section('content') @include('layout.navbar')
<div class="container-fluid mt-6">
	<div class="card mb-4">
		<!-- Card header -->
		<div class="card-header">
			<h3 class="mb-0">Añadir un Producto</h3>
		</div>
		<!-- Card body -->
		<div class="card-body">
			<!-- Form groups used in grid -->
			<form class="row justify-content-around">
				@csrf
				<div class="col-md-4">
					<div class="form-group">
						<label class="form-control-label"
							>Nombre / Modelo del Producto:</label
						>
						<input
							type="text"
							class="form-control"
							name="name"
							placeholder='Ej: Shield 24" Rojo'
							value="{{old("name")}}"
						/>
						@error('name')
							<small class="text-danger">
								{{$message}}
							</small>
						@enderror
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label >Tipo de Producto:</label>
						<select class="form-control" name="type">
							<option value="mochilas">Mochilas</option>
							<option value="valijas">Valijas</option>
							<option value="bolsos">Bolsos</option>
							<option value="porta-notebooks">Porta-Notebooks</option>
							<option value="productos fabricados">Productos Fabricados</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="form-control-label"
							>Marca del Producto:</label
						>
						<input
							type="text"
							class="form-control"
							name="brand"
							placeholder='Ej: Samsonite'
							value="{{old("brand")}}"
						/>
						@error('brand')
							<small class="text-danger">
								{{$message}}
							</small>
						@enderror
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="form-control-label"
							>Precio:</label
						>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input name="price" type="number" class="form-control" value="{{old("price")}}">
						</div>
						@error('price')
							<small class="text-danger">
								{{$message}}
							</small>
						@enderror
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="form-control-label"
							>Cantidad Disponible en Stock:</label
						>
						<div class="input-group">
							<input name="stock" type="number" class="form-control" value="{{old("stock")}}">
							<div class="input-group-append">
								<span class="input-group-text">Unidad/es</span>
							</div>
						</div>
						@error('stock')
							<small class="text-danger">
								{{$message}}
							</small>
						@enderror
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label >Descuento por Oferta:</label>
						<select class="form-control" name="type">
							<option value="0">0%</option>
							<option value="1">1%</option>
							<option value="2">2%</option>
							<option value="3">3%</option>
							<option value="5">5%</option>
							<option value="7">7%</option>
							<option value="10">10%</option>
							<option value="15">15%</option>
							<option value="17">17%</option>
							<option value="20">20%</option>
							<option value="25">25%</option>
							<option value="30">30%</option>
							<option value="35">35%</option>
							<option value="40">40%</option>
							<option value="45">45%</option>
							<option value="50">50%</option>
							<option value="55">55%</option>
							<option value="60">60%</option>
							<option value="65">65%</option>
							<option value="70">70%</option>
							<option value="75">75%</option>
							<option value="80">80%</option>
							<option value="85">85%</option>
						</select>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label class="form-control-label"
							>Breve Descripción del Producto:</label
						>
						<textarea class="form-control" placeholder="Este campo es opcional" rows="3"></textarea>
						@error('price')
							<small class="text-danger">
								{{$message}}
							</small>
						@enderror
						<small class="text-primary">0 / 190</small>
					</div>
				</div>
			</form>
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