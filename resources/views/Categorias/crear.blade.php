@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Crear Categorias</h3>
        </div>

        <div class="card-body">
            <form action="{{route('categorias.insertar')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{old('nombre')}}" required>
                            @error('nombre')
                            <small>*{{ $message }}</small>
                            <br><br>
                             @enderror
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <input class="form-control" type="text" name="descripcion" id="descripcion" value="{{old('descripcion')}}" required>
                            @error('descripcion')
                            <small>*{{ $message }}</small>
                            <br><br>
                             @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-dark btn-lg">Crear</button>
                    <a class="btn btn-danger btn-lg" href="{{route('categorias.index')}}">Volver</a>
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
