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
            <form>
                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label>Nombre de Usuario</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="text" class="form-control" name="nombre"
                                    value="{{ old('nombre', $user->name) }}" placeholder="">
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
                                    value="{{ old('email', $user->email) }}" placeholder="">
                            </div>

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
                                    value="{{ old('celular') }}">
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fecha de Nacimiento</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger btn-lg">Guardar</button>
                    {{-- <a class="btn btn-danger" href="{{route('trabajos.index')}}">Editar</a> --}}
                </div>

            </form>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
   
   
@stop

@section('js')

@stop
