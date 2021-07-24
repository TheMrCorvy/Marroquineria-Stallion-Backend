@extends('layout.app', ['class' => 'bg-secondary']) @section('content') @include('layout.navbar')
<div class="container-fluid mt-6 pb-6">
	@if (Session::has('message'))
		<div class="alert alert-success my-5" role="alert">
			<strong>Éxito!</strong> {{Session::get('message')}}
		</div>
	@endif
	@include('sections.password-validation-messages')
	<div class="card mb-4">
		<div class="card-header">
			<h3 class="mb-0">Historial de Ventas</h3>
		</div>
		<div class="card-body">

        </div>
	</div>
</div>
@endsection
