
<h1>{{$modo,}} Empleado</h1> 

@if(count($errors)>0)
 <div class="alert alert-danger" role="alert">
     <ul>
 @foreach($errors->all() as $error);
    <li>
    {{$error}}
    </li>
    @endforeach
    </ul>
 </div> 
 @endif
<div class="form-group">
<label for="Nombre">Nombre</label>
<input type="text" class="form-control" name="Name" value="{{isset($empleado->Name)?$empleado->Name:old('Name')}}" id="Name" >
</div>
<div class="form-group">
<label for="lastname">Apellido</label> 
<input type="text" class="form-control" name="lastname" value="{{isset($empleado->lastname)?$empleado->lastname:old('lastname')}}" id="lastname">
</div>
<div class="form-group">
<label for="seclastname">Segundo apellido</label>
<input type="text" class="form-control"  name="seclastname" value="{{isset($empleado->seclastname)?$empleado->seclastname:old('seclastname')}}" id="seclastname">
</div>
<label for="Email">Email</label>
<input type="text" class="form-control"  name="Email" value="{{isset($empleado->Email)?$empleado->Email:old('Email')}}" id="Email">

<div class="form-group">
<label for="Foto"></label>
@if(isset($empleado->Foto))
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->Foto}}" alt="" width="250">
@endif
<input type="file" class="form-control"  name="Foto" value="" id="Foto">

</div>
<div class="pt-3">
<label for="Enviar"></label>
<input class="btn btn-success"type="submit" class="form-control"  value="{{$modo}} Datos">
<a class="btn btn-primary" href="{{url('empleado')}}">Regresar</a>
</div>