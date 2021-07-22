<div class="col-md-12 text-center mb-5 pb-5">
    <h3 class="mb-0">Crear un Método de Envío</h3>
    <form action="{{route('shipping_method.create')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="shipping_method">Nuevo Método</label>
            <input 
                type="text" 
                class="form-control" 
                id="shipping_method" 
                placeholder="Ej: Correo Andreani"
                name="method"
                value="{{old('method')}}"
            >
            @error('method')
                <small class="text-danger"> {{$message}} </small>
            @enderror
        </div>
        <input type="submit" value="Añadir" class="btn btn-success">
    </form>
</div>