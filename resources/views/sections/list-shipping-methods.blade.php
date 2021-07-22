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
                            title="Editar Método de Envó"
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
                            title="Eliminar Método de Envío"
                            data-container="body"
                            data-animation="true"
                            onclick="delete_method_modal({{$method['id']}})"
                        >
                            <i class="ni ni-fat-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div
	class="modal fade"
	id="delete_shipping_method_modal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="delete_shipping_method_modal"
	aria-hidden="true"
>
	<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
		<div class="modal-content bg-gradient-danger">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-notification">
					Seguro deseas eliminar este método de envío?
				</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="py-3 text-center">
					<i class="ni ni-bell-55 ni-3x"></i>
					<p>
						Al hacer click en "Aceptar" se eliminarán definitivamente el método de envío seleccionado, junto con todas las zonas de envío a las que estaba asociado.
					</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white">Volver</button>
				<a href="/shippint_method/delete/" id="link-delete-shipping-method" class="btn btn-link text-white ml-auto btn-outline-secondary">
					Aceptar
				</a>
			</div>
		</div>
	</div>
</div>

<script>
const delete_method_modal = (id) => {

    document.getElementById('link-delete-shipping-method').setAttribute('href', '/shipping_method/delete/' + id)

    $('#delete_shipping_method_modal').modal('show');
}
</script>