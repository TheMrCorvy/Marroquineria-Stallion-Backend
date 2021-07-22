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
                                onclick="update_zone_modal({{$zone['id']}}, '{{$zone['method']}}')"
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
				<button type="button" class="btn btn-white">Volver</button>
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

<script>
    const delete_zone_modal = (id) => {
		document
			.getElementById("link-delete-shipping-zone")
			.setAttribute("href", "/shipping_zone/delete/" + id)

		$("#delete_shipping_zone_modal").modal("show")
	}

	const update_zone_modal = (id, zone) => {
		document
			.getElementById("zone_update_form")
			.setAttribute("action", "/shipping_zone/update/" + id)

		document
			.getElementById('zone_update_input')
			.setAttribute('value', zone)

		$("#update_shipping_zone_modal").modal("show")
	}
</script>