
<!--Esta etiqueta permite guardar foto grafias o archivos enctype="multipart/form-data" crear formulario-->
@extends('layouts.app')

@section('content')
<div class="container">
<title>Create</title>
<form action="{{ url('/empleado')}}" method="POST" enctype="multipart/form-data">
    @csrf
@include('empleado.form',['modo'=>'Crear'])
</form>

</div>
@endsection