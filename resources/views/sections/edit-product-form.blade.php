<form class="row justify-content-around" action="{{route('product.update', $product->id)}}">
	@csrf
	<div class="col-md-4">
		<div class="form-group">
			<label class="form-control-label">Nombre / Modelo del Producto:</label>
			<input type="text" class="form-control" name="title" placeholder='Ej: Shield 24" Rojo'
			value="{{$product->title}}" /> @error('title')
			<small class="text-danger"> {{$message}} </small>
			@enderror
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label>Tipo de Producto:</label>
			<select class="form-control" name="type">
				<option value="{{$product->type}}" class="text-capitalize">{{$product->type}}</option>
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
			<label class="form-control-label">Marca del Producto:</label>
			<input type="text" class="form-control" name="brand" placeholder='Ej: Samsonite'
			value="{{$product->brand}}" /> @error('brand')
			<small class="text-danger"> {{$message}} </small>
			@enderror
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="form-control-label">Precio:</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">$</span>
				</div>
				<input name="price" type="number" class="form-control" value="{{$product->price}}">
			</div>
			@error('price')
			<small class="text-danger"> {{$message}} </small>
			@enderror
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="form-control-label">Cantidad Disponible en Stock:</label>
			<div class="input-group">
				<input name="stock" type="number" class="form-control" value="{{$product->stock}}">
				<div class="input-group-append">
					<span class="input-group-text">Unidad/es</span>
				</div>
			</div>
			@error('stock')
			<small class="text-danger"> {{$message}} </small>
			@enderror
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label>Descuento por Oferta:</label>
			<select class="form-control" name="type">
				<option value="{{$product->sale}}">{{$product->sale ? $product->sale : 0}}%</option>
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
			<label class="form-control-label">Breve Descripción del Producto:</label>
			<textarea
				id="description"
				class="form-control"
				placeholder="Este campo es opcional"
				rows="3"
			>{{$product->description}}</textarea>
			@error('price')
			<small class="text-danger"> {{$message}} </small>
			@enderror
			<small class="text-primary" id="description-count"></small>
		</div>
	</div>
	<div class="col-md-4">
		<label class="form-control-label">Imagenes (al menos una):</label>
		<div class="custom-file">
			<input required type="file" class="form-control" name="images[]" placeholder="address" multiple>
		</div>
		<small class="text-danger">Las imágenes subidas reemplazarán a las que actualmente están online</small>
	</div>
	<div class="col-md-12 text-center mt-4">
		<input type="submit" value="Guardar Cambios" class="btn btn-success">
		<br>
		<br>
		<small>Al enviar el formulario, es posible que se demore un rato en procesar todo.</small>
	</div>
</form>
<script>
	window.addEventListener("load", () => {
		const description = document.getElementById("description")
		const descriptionCount = document.getElementById("description-count")

		descriptionCount.innerHTML = description.value.length + ' / 190'

		description.addEventListener("keyup", (e) => {
			descriptionCount.innerHTML = `${e.target.value.length} / 190`

			if (e.target.value.length >= 190) {
				descriptionCount.classList.remove("text-primary")
				descriptionCount.classList.add("text-danger")
			} else {
				descriptionCount.classList.add("text-primary")
				descriptionCount.classList.remove("text-danger")
			}
		})
	})
</script>