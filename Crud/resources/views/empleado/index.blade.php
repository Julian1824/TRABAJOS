@extends('layouts.app')
@section('content')
<div class="container display: flex; justify-content: space-between; align-items: center;"> 

@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{Session::get('mensaje')}}
    <button type="button" class="btn-close alert-dismissible fade show" data-bs-dismiss="alert" aria-label="Close">

    </button>
</div>
@endif  
<br>

<div class="d-flex justify-content-between">
<a class="btn btn-success" href="{{url('empleado/create')}}">Registrar usuario</a>
<a class="btn btn-primary" href="{{url('empleado/pdf')}}">PDF</a>
</div>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Segundo Apellido</th>
            <th>Correo</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
        <tr>
            <td>{{$empleado->id}}</td>
            <td>
            <img  class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->Foto}}"   alt="" width="150">
            </td>
            <td>{{$empleado->Name}}</td>
            <td>{{$empleado->lastname}}</td>
            <td>{{$empleado->seclastname}}</td>
            <td>{{$empleado->Email}}</td>
            <td>
            <a class="btn btn-warning" href="{{url('/empleado/'.$empleado->id.'/edit')}}">
                Editar
            </a>    
            |
                <form class="d-inline" action="{{url('/empleado/'.$empleado->id)}}" method="post">
                    @csrf
                    {{method_field('DELETE')}}
                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Deseas eliminar?');" value="Borrar">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
{!! $empleados->links(); !!}
</div>
</div>
@endsection