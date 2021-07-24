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
									<a href="#" class="btn btn-link text-primary">
										Ver Datos
									</a>
								</td>
								<td>
									<a href="#" class="btn btn-link text-primary">
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
	</div>
</div>

@foreach ($sales as $sale)
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
								<td>
									{{$sale_detail['amount']}}
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
@endforeach
@endsection
