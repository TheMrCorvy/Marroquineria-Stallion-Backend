@extends('layout.app', ['class' => 'bg-secondary']) @section('content') @include('layout.navbar')
<div class="container-fluid mt-6">
	<div class="card mb-4">
		<div class="card-header">
			<h3 class="mb-0">Añadir un Producto</h3>
		</div>
		<div class="card-body">@include('sections.create-product-form')</div>
		<div class="card-footer">
			<h3 class="mt-0">Editar un Producto</h3>
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="form-group">
						<label class="form-control-label">Buscar Producto:</label>
						<div class="input-group mb-3">
							<input
								type="text"
								id="search-input"
								class="form-control"
								placeholder='Ej: Shield 24" Rojo'
							/>

							<div class="input-group-append">
								<button
									class="btn btn-outline-primary"
									id="search-bar"
									type="button"
									id="button-addon2"
								>
									Buscar
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 text-center d-none" id="spinner">
					<div class="spinner-border text-primary" role="status">
						<span class="sr-only">Cargando...</span>
					</div>
				</div>
				<div class="col-md-12 row" id="list-products"></div>
			</div>
		</div>
	</div>
</div>
<div
	class="modal fade"
	id="modal-notification"
	tabindex="-1"
	role="dialog"
	aria-labelledby="modal-notification"
	aria-hidden="true"
>
	<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
		<div class="modal-content bg-gradient-danger">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-notification">
					Seguro deseas eliminar este producto?
				</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="py-3 text-center">
					<i class="ni ni-bell-55 ni-3x"></i>
					<p>
						Al hacer click en "Aceptar" el producto será completamente eliminado de la base de datos, esto también incluye las imágenes de dicho producto.
					</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white">Volver</button>
				<a href="/product/delete/" id="link-delete" type="button" class="btn btn-link text-white ml-auto btn-outline-secondary" data-dismiss="modal">
					Aceptar
				</a>
			</div>
		</div>
	</div>
</div>
<script>
	window.addEventListener("load", () => {
		const searchBar = document.getElementById("search-bar")

		searchBar.addEventListener("click", (e) => {
			getProducts(e.target.value)
		})
	})

	const getProducts = async (query) => {
		const spinner = document.getElementById("spinner")
		const searchInput = document.getElementById("search-input")

		spinner.classList.remove("d-none")

		const res = await fetch("/api/search-products/no-pagination", {
			body: JSON.stringify({
				query: searchInput.value,
			}),
			method: "POST",
			headers: {
				Accept: "application/json",
				"Content-Type": "application/json",
			},
		})

		const data = await res.json()

		spinner.classList.add("d-none")

		if (!data.products || data.products.length === 0) {
			document.getElementById("list-products").innerHTML = `
				<h4>No se encontró ningún producto...</h4>
			`
		} else {
			document.getElementById("list-products").innerHTML = data.products.map(
				(product) =>
					`
					<div class="card">
						<div class="card-body mr-3">
							<div class="row">
								<div class="col-md-8">
									<h5>${product.title}</h5>
								</div>
								<div class="col-md-2 px-3">
									<a
										class="btn btn-icon btn-primary"
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
										class="btn btn-icon btn-danger"
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
				`
			)
		}
	}

	const showModal = (id) => {

		document.getElementById('link-delete').setAttribute('href', '/product/delete/' + id)

		$('#modal-notification').modal('show');
	}
</script>
@endsection
