@extends('layout.app', ['class' => 'register-page'])

@section('content')
    <div class="wrapper">
        <div class="page-header bg-default">
            <div class="page-header-image" style="background-image: url('{{asset('argon')}}/img/register_bg.png');"></div>
                <div class="container" id="container">
                    <div class="form-container sign-in-container">
                        <form method="POST" action="{{route('login.form')}}" role="form">
                            @csrf
                            <div class="w-100 justify-center text-center mt-4">
                                <h2>Ingresar</h2>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" name="email" placeholder="Email" type="email" value="{{old('email')}}">
                                </div>
                                @error('email')
                                    <small class="text-danger">
                                        {{$message}}
                                    </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" name="password" placeholder="Contraseña" type="password" value="{{old('password')}}">
                                </div>
                            </div>

                            @error('password')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror

                            <button class="btn btn-outline-success btn-block mt-3" type="submit">Ingresar</button>
                        </form>
                    </div>
                    <div class="overlay-container">
                        <div class="overlay">
                            <div class="overlay-panel overlay-right">
                                <h1 class="text-white">Hola!</h1>
                                <p>
                                    Solo los administradores del sitio pueden entrar aquí.
                                </p>
                                <a href="https://stallionmarroquineria.com">
                                    <button type="button" class="btn btn-outline-info">Volver a Stallion Marroquinería</button>
                                </a>

                                @if (Session::has('error'))
                                    <div class="alert alert-danger mt-5" role="alert">
                                        <strong>Error!</strong> {{Session::get('error')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                {{-- here's a div that has been closed before --}}
            </div>
        </div>
    </div>
@endsection