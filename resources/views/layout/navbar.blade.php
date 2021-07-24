<nav class="navbar navbar-expand-lg navbar-dark bg-default py-0 fixed-top">
	<div class="container">
		<a class="navbar-brand" href="{{route('home')}}">Inicio</a>
		<button
			class="navbar-toggler"
			type="button"
			data-toggle="collapse"
			data-target="#navbar-default"
			aria-controls="navbar-default"
			aria-expanded="false"
			aria-label="Toggle navigation"
		>
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar-default">
			<div class="navbar-collapse-header">
				<div class="row">
					<div class="col-6 collapse-brand">
						<a href="{{route('home')}}"> Inicio </a>
					</div>
					<div class="col-6 collapse-close">
						<button
							type="button"
							class="navbar-toggler"
							data-toggle="collapse"
							data-target="#navbar-default"
							aria-controls="navbar-default"
							aria-expanded="false"
							aria-label="Toggle navigation"
						>
							<span></span>
							<span></span>
						</button>
					</div>
				</div>
			</div>

			<ul class="navbar-nav ml-lg-auto">
				<li class="nav-item">
					<a
						class="nav-link nav-link-icon"
						href="{{route('review_sales')}}"
						data-toggle="tooltip"
						data-placement="bottom"
						title="Ver Ventas"
						data-container="body"
						data-animation="true"
					>
						<i class="ni ni-money-coins"></i>
						<span class="nav-link-inner--text">Ventas</span>
					</a>
				</li>
				<li class="nav-item">
					<a
						class="nav-link nav-link-icon"
						data-toggle="tooltip"
						data-placement="bottom"
						title="Cambiar Contraseña"
						data-container="body"
						data-animation="true"
						id="change-password-link"
					>
						<span class="nav-link-inner-text">Cambiar Contraseña</span>
					</a>
				</li>
				<li class="nav-item">
					<a
						class="nav-link nav-link-icon"
						href="{{route('logout')}}"
						data-toggle="tooltip"
						data-placement="bottom"
						title="Cerrar Sesión"
						data-container="body"
						data-animation="true"
					>
						<i class="ni ni-lock-circle-open"></i>
						<span class="nav-link-inner--text">Cerrar Sesión</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div
	class="modal fade"
	id="modal-form"
	tabindex="-1"
	role="dialog"
	aria-labelledby="modal-form"
	aria-hidden="true"
>
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-secondary shadow border-0 mb-0">
					<div class="card-body px-lg-5 py-lg-5">
						<div class="text-center text-muted mb-4">
							<h6>Cambiar Contraeña</h6>
						</div>
						<form role="form" action="{{route('change_password')}}" method="POST">
							@csrf
							<div class="form-group mb-3">
								<div class="input-group input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"
											><i class="ni ni-lock-circle-open"></i
										></span>
									</div>
									<input 
										class="form-control" 
										name="password" 
										placeholder="Nueva Contraseña" 
										type="password" 
									/>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"
											><i class="ni ni-lock-circle-open"></i
										></span>
									</div>
									<input
										class="form-control"
										placeholder="Repetir Contraseña"
										type="password"
										name="password_confirmation"
									/>
								</div>
							</div>
							<div class="text-center">
								<input type="submit" value="Guardar" class="btn btn-primary my-4" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	window.addEventListener('load', () => {
		document.getElementById('change-password-link').addEventListener('click', () => {
			$("#modal-form").modal("show")
		})
	})
</script>