<h3 class="text-center mt-5 pt-5">Editar Zonas de Envío</h3>
<div class="row justify-content-around">
    @foreach ($shipping_zones as $zone)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body mr-3">
                    <div class="row">
                        <div class="col-md-8 text-capitalize">
                            <h6>{{$zone['method']}}, {{$zone['region']}}</h6>
                        </div>
                        <div class="col-md-2">
                            <button
                                class="btn btn-icon btn-primary btn-sm"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="Editar Zona de Envío"
                                data-container="body"
                                data-animation="true"
                                onclick="update_zone_modal(
									'{{$zone['id']}}',
									'{{$zone['region']}}',
									'{{$zone['actual_price']}}',
									'{{$zone['shipping_method_id']}}',
									'{{$zone['method']}}',
									'{{$zone['delay']}}',
								)"
                            >
                            <i class="ni ni-ruler-pencil"></i>
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button
                                class="btn btn-icon btn-danger btn-sm"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="Eliminar Zona de Envío"
                                data-container="body"
                                data-animation="true"
                                onclick="delete_zone_modal({{$zone['id']}})"
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

<div
	class="modal fade"
	id="delete_shipping_zone_modal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="delete_shipping_zone_modal"
	aria-hidden="true"
>
	<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
		<div class="modal-content bg-gradient-danger">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-notification">
					Seguro deseas eliminar esta zona de envío?
				</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="py-3 text-center">
					<i class="ni ni-bell-55 ni-3x"></i>
					<p>
						Al hacer click en "Aceptar" se eliminará definitivamente la zona de envío seleccionada. Esta acción NO afecta al método de envío asociado.
					</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-white">Volver</button>
				<a
					href="/shippint_zone/delete/"
					id="link-delete-shipping-zone"
					class="btn btn-link text-white ml-auto btn-outline-secondary"
				>
					Aceptar
				</a>
			</div>
		</div>
	</div>
</div>

<div
	class="modal fade"
	id="update_shipping_zone_modal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="update_shipping_zone_modal"
	aria-hidden="true"
>
	<div class="modal-dialog modal-lg modal- modal-dialog-centered modal-" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-default">Editar Método de Envio</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body text-center">
				<form action="/shipping_zone/update/" class="row justifu-content-around" id="zone_update_form" method="post">
					@csrf
					<div class="col-md-6">
						<div class="form-group">
							<label for="shipping_method">Zona / Región de Alcance</label>
							<input 
								type="text" 
								class="form-control" 
								placeholder="Ej: Provincia San Luis, San Luis Capital"
								name="region"
								id="update_zone_region"
							>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Precio:</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input name="price" type="number" class="form-control" id="update_zone_price">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Método de Envío:</label>
							<select class="form-control" name="shipping_method_id" id="update_zone_method_id">
								@foreach ($shipping_methods as $method)
									<option value="{{$method['id']}}">{{$method['method']}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6 mb-4">
						<div class="form-group">
							<label class="form-control-label">Tiempo Estimado de la Entrega:</label>
							<input name="delay" type="text" placeholder="Ej: De 1 a 3 días hábiles" class="form-control" id="update_zone_delay">
						</div>
						<small>(Más o menos cuánto va a demorar en entregarse)</small>
					</div>
					<div class="col-md-12 text-center">
						<input type="submit" value="Guardar Cambios" class="btn btn-success">
					</div>
				</form>
			</div>

			<div class="modal-footer text-right">
				<button type="button" data-dismiss="modal" class="btn btn-primary">Volver</button>
			</div>
		</div>
	</div>
</div>

<script>
    const delete_zone_modal = (id) => {
		document
			.getElementById("link-delete-shipping-zone")
			.setAttribute("href", "/shipping_zone/delete/" + id)

		$("#delete_shipping_zone_modal").modal("show")
	}

	const update_zone_modal = (id, region, price, method_id, method, delay) => {
		
		const form = document.getElementById('zone_update_form')
		const regionInput = document.getElementById('update_zone_region')
		const priceInput = document.getElementById('update_zone_price')
		const methodInput = document.getElementById('update_zone_method_id')
		const delayInput = document.getElementById('update_zone_delay')

		form.setAttribute('action', '/shipping_zone/update/' + id)
		regionInput.setAttribute('value', region)
		priceInput.setAttribute('value', price)
		delayInput.setAttribute('value', delay)

		const option = document.createElement('option')
		option.setAttribute('value', method_id)
		option.innerHTML = method
		option.selected = 'selected'

		methodInput.prepend(option)

		$("#update_shipping_zone_modal").modal("show")
	}
</script>