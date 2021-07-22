<h3 class="text-center">Añadir una Zona de Envío</h3>
<form method="POST" action="{{route('shipping_zone.create')}}" class="row justify-content-around">
    @csrf
    <div class="col-md-4">
        <div class="form-group">
            <label for="shipping_method">Zona / Región de Alcance</label>
            <input 
                type="text" 
                class="form-control" 
                placeholder="Ej: Provincia San Luis, San Luis Capital"
                name="region"
                value="{{old('region')}}"
            >
            @error('region')
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
                <input name="price" type="number" class="form-control" value="{{old("price")}}">
            </div>
            @error('price')
            <small class="text-danger"> {{$message}} </small>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Método de Envío:</label>
            <select class="form-control" name="shipping_method_id">
                @foreach ($shipping_methods as $method)
                    <option value="{{$method['id']}}">{{$method['method']}}</option>
                @endforeach
            </select>
            @error('shipping_method_id')
                <small class="text-danger"> {{$message}} </small>
            @enderror
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="form-group">
            <label class="form-control-label">Tiempo Estimado de la Entrega:</label>
            <input name="delay" type="text" placeholder="Ej: De 1 a 3 días hábiles" class="form-control" value="{{old("delay")}}">
            @error('delay')
            <small class="text-danger"> {{$message}} </small>
            @enderror
        </div>
        <small>(Más o menos cuánto va a demorar en entregarse)</small>
    </div>
    <div class="col-md-12 text-center">
        <input type="submit" value="Añadir" class="btn btn-success">
    </div>
</form>