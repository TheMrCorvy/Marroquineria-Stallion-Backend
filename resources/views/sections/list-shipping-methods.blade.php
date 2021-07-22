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