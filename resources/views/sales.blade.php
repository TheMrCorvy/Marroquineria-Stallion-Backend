@extends('layout.app', ['class' => 'bg-secondary']) @section('content') @include('layout.navbar')
<div class="container-fluid mt-6 pb-6">
	@if (Session::has('message'))
	<div class="alert alert-success my-5" role="alert">
		<strong>Éxito!</strong> {{Session::get('message')}}
	</div>
	@endif @include('sections.password-validation-messages')
	<div class="card mb-4">
		<div class="card-header">
			<h3 class="mb-0">Historial de Ventas</h3>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div>
					<table class="table align-items-center">
						<thead class="thead-light">
							<tr>
								<th scope="col">Código de Venta</th>
								<th scope="col">
									Fecha
									<br>
									<small>(Año-Mes-Día)</small>
								</th>
								<th scope="col">Forma de Pago</th>
								<th scope="col">Monto Total</th>
								<th scope="col">Datos de Facturación</th>
								<th scope="col">Datos de Envío</th>
								<th scope="col">Detalle de Venta</th>
							</tr>
						</thead>
						<tbody class="list">
							@foreach ($sales as $sale)
							<tr>
								<td class="text-warning">
									<strong>ST-MR-{{$sale['id']}}</strong>
								</td>
								<td>
									{{$sale['date']}}
								</td>
								<td>
									{{$sale['payment_method']}}
								</td>
								<td class="text-success">
									<strong>$ {{number_format($sale['total_price'], 2, ',', '.')}}</strong>
								</td>
								<td>
									<a href="#" class="btn btn-link text-primary" data-toggle="modal" data-target="#detalleFacturacion-{{$sale['id']}}">
										Ver Datos
									</a>
								</td>
								<td>
									<a href="#" class="btn btn-link text-primary" data-toggle="modal" data-target="#detalleEnvio-{{$sale['id']}}">
										Ver Datos
									</a>
								</td>
								<td>
									<a href="#" class="btn btn-link text-primary" data-toggle="modal" data-target="#detalleVenta-{{$sale['id']}}">
										Ver Detalle
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="card-footer">
			{{$sales->links()}}
		</div>
	</div>
</div>

@foreach ($sales as $sale)

	@php
		$shipping_info = json_decode($sale['shipping_info']);

		$billing_info = json_decode($sale['billing_info']);
	@endphp

	<div class="modal fade" id="detalleVenta-{{$sale['id']}}" tabindex="-1" role="dialog" aria-labelledby="detalleVentaLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="detalleVentaLabel">Detalle de Venta</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table align-items-center">
						<thead class="thead-light">
							<tr>
								<th scope="col">Producto</th>
								<th scope="col">Precio Unitario</th>
								<th scope="col">Cantidad Comprada</th>
								<th scope="col">Subtotal</th>
								<th scope="col">Detalles Producto</th>
							</tr>
						</thead>
						<tbody class="list">
							@foreach ($sale->sales as $sale_detail)
							<tr>
								<td class="text-capitalize">
									{{$sale_detail['title']}}
								</td>
								<td class="text-success">
									<strong>$ {{number_format($sale_detail['unit_price'], 2, ',', '.')}}</strong>
								</td>
								<td class="text-warning">
									<strong>{{$sale_detail['amount']}}</strong>
								</td>
								<td class="text-warning">
									<strong>$ 
										{{number_format(
											$sale_detail['amount'] * $sale_detail['unit_price'], 
											2, 
											',', 
											'.'
										)}}
									</strong>
								</td>
								<td>
									<a 
										href="https://stallionmarroquineria.com/producto/{{$sale_detail['product_id']}}" 
										class="btn btn-link text-primary" 
										target="_blank"
									>
										Ver Producto
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Volver</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="detalleEnvio-{{$sale['id']}}" tabindex="-1" role="dialog" aria-labelledby="detalleEnvioLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="detalleEnvioLabel">Detalle del Envío</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row justify-content-around">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="name" class="form-control-label">Nombre:</label>
								<input class="form-control text-capitalize" type="text" disabled id="name" value="{{$shipping_info->name}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="email" class="form-control-label">Email:</label>
								<input class="form-control" type="text" disabled id="email" value="{{$shipping_info->email}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="phone_number" class="form-control-label">Número de Teléfono:</label>
								<input class="form-control" type="text" disabled id="phone_number" value="{{$shipping_info->phone_number}}">
							</div>
						</div>
						<div class="col-lg-12">
							<h5 class="text-center mt-3">Opción de Envío Elegida:</h5>
						</div>

						@if (!$shipping_info->send)
							<div class="col-lg-12 mt-3">
								<h5 class="text-center text-warning">Lo retirará en persona en el local.</h5>
							</div>
						@else
							<div class="col-lg-4">
								<div class="form-group">
									<label for="method" class="form-control-label">Método de Envío:</label>
									<input 
										class="form-control text-capitalize" 
										type="text" 
										disabled 
										id="method" 
										value="{{$shipping_info->shipping_option->method}}"
									>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="region" class="form-control-label">Zona / Región de Envío:</label>
									<input 
										class="form-control text-capitalize" 
										type="text" 
										disabled 
										id="region" 
										value="{{$shipping_info->shipping_option->region}}"
									>
								</div>
							</div>
							<div class="col-lg-12">
								<h5 class="text-center mt-3">Datos del Domicilio:</h5>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="streetOne" class="form-control-label">Calle Primaria:</label>
									<textarea
										class="form-control"
										rows="5"
										name="streetOne"
										disabled
									>{{$shipping_info->shipping_address->streetOne}}</textarea>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="streetTwo" class="form-control-label">Calle Secundaria:</label>
									<input 
										class="form-control text-capitalize" 
										type="text" 
										disabled 
										id="streetTwo" 
										value="{{$shipping_info->shipping_address->streetTwo}}"
									>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="number" class="form-control-label">Altura:</label>
									<input 
										class="form-control text-capitalize" 
										type="text" 
										disabled 
										id="number"
										value="{{$shipping_info->shipping_address->number}}"
									>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="postalCode" class="form-control-label">Código Postal:</label>
									<input 
										class="form-control text-capitalize" 
										type="text" 
										disabled 
										id="postalCode"
										value="{{$shipping_info->shipping_address->postalCode}}"
									>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="state" class="form-control-label">Provincia:</label>
									<input 
										class="form-control text-capitalize" 
										type="text" 
										disabled 
										id="state"
										value="{{$shipping_info->shipping_address->state}}"
									>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="city" class="form-control-label">Ciudad:</label>
									<input 
										class="form-control text-capitalize" 
										type="text" 
										disabled 
										id="city"
										value="{{$shipping_info->shipping_address->city}}"
									>
								</div>
							</div>
							
							@if ($shipping_info->shipping_address->town)
								<div class="col-lg-4">
									<div class="form-group">
										<label for="town" class="form-control-label">Localidad / Barrio:</label>
										<input 
											class="form-control text-capitalize" 
											type="text" 
											disabled 
											id="town"
											value="{{$shipping_info->shipping_address->town}}"
										>
									</div>
								</div>
							@endif
						@endif
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Volver</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="detalleFacturacion-{{$sale['id']}}" tabindex="-1" role="dialog" aria-labelledby="detalleFacturacionLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="detalleFacturacionLabel">Detalle de Facturación</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row justify-content-around">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="name" class="form-control-label">Nombre:</label>
								<input 
									class="form-control text-capitalize" 
									type="text" 
									disabled 
									id="name"
									value="{{$billing_info->name}}"
								>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="email" class="form-control-label">Email:</label>
								<input 
									class="form-control" 
									type="text" 
									disabled 
									id="email"
									value="{{$billing_info->email}}"
								>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="dni_or_cuil" class="form-control-label">DNI o CUIL:</label>
								@php
									$dniOrCuil = 0;

									if(is_numeric($billing_info->dni_or_cuil)) {
										$dniOrCuil = number_format($billing_info->dni_or_cuil, 0, ',', '.');
									} else {
										$dniOrCuil = $billing_info->dni_or_cuil;
									}
								@endphp
								<input 
									class="form-control text-capitalize" 
									type="text" 
									disabled 
									id="dni_or_cuil"
									value="{{$dniOrCuil}}"
								>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="streetOne" class="form-control-label">Calle Principal:</label>
								<textarea
										class="form-control"
										rows="5"
										name="streetOne"
										disabled
									>{{$billing_info->billing_address->streetOne}}</textarea>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="streetTwo" class="form-control-label">Calle Secundaria:</label>
								<input 
									class="form-control text-capitalize" 
									type="text" 
									disabled 
									id="streetTwo"
									value="{{$billing_info->billing_address->streetTwo}}"
								>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="number" class="form-control-label">Altura:</label>
								<input 
									class="form-control text-capitalize" 
									type="text" 
									disabled 
									id="number"
									value="{{$billing_info->billing_address->number}}"
								>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="postalCode" class="form-control-label">Código Postal:</label>
								<input 
									class="form-control text-capitalize" 
									type="text" 
									disabled 
									id="postalCode"
									value="{{$billing_info->billing_address->postalCode}}"
								>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="state" class="form-control-label">Provincia:</label>
								<input 
									class="form-control text-capitalize" 
									type="text" 
									disabled 
									id="state"
									value="{{$billing_info->billing_address->state}}"
								>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="city" class="form-control-label">Ciudad:</label>
								<input 
									class="form-control text-capitalize" 
									type="text" 
									disabled 
									id="city"
									value="{{$billing_info->billing_address->city}}"
								>
							</div>
						</div>
						@if ($billing_info->billing_address->town)
							<div class="col-lg-4">
								<div class="form-group">
									<label for="town" class="form-control-label">Barrio / Localidad:</label>
									<input 
										class="form-control text-capitalize" 
										type="text" 
										disabled 
										id="town"
										value="{{$billing_info->billing_address->town}}"
									>
								</div>
							</div>
						@endif
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Volver</button>
				</div>
			</div>
		</div>
	</div>
@endforeach
@endsection
