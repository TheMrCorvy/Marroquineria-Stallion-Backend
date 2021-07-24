@error('password')
    <div class="alert alert-danger my-5" role="alert">
        <strong>Error:</strong> {{$message}}
    </div>
@enderror
@error('password_confirmation')
    <div class="alert alert-danger my-5" role="alert">
        <strong>Error:</strong> {{$message}}
    </div>
@enderror