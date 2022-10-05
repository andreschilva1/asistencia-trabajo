@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1></h1>
@stop

@section('content')

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Mi Perfil</h3>
        </div>

        <div class="card-body">
            <form action="{{route('perfil.update',$user)}}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label>Nombre de Usuario</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="text" class="form-control" name="nombre"
                                    value="{{ old('nombre', $user->name) }}" placeholder="" required>

                                @error('nombre')
                                <small>*{{ $message }}</small>
                                <br><br>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Correo Electronico</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $user->email) }}" placeholder="" required>
                            </div>
                                 @error('email')
                                <small>*{{ $message }}</small>
                                <br><br>
                                @enderror

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Celular</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="tel" class="form-control" name="celular" id="celular"
                                    value="{{ old('celular',$user->celular) }}">
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="fecha"  id="fecha" value="{{ old('fecha',$user->Fecha) }}">
                                
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Nueva  contraseña</label>
                            <input type="checkbox" name="activar-contraseña" id="check_password" onclick="cambiarEstado()" >
                                    <input type="password" name="password" class="form-control" value="{{old('password')}}" id="passwordInput" placeholder="Escriba la nueva contraseña" disabled>

                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-danger btn-lg">Guardar</button>
                </div>

            </form>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
   
   
@stop

@section('js')
<script>
    var contra = document.getElementById('passwordInput');
    function cambiarEstado(){
    if(contra.disabled == true){
        contra.disabled = false
    }else{
    if(contra.disabled == false){
        contra.disabled = true
        contra.value = ''
    }
    }

    
    }
   
</script>
@stop
